<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;

/**
 * InventoryTransferVouchers Controller
 *
 * @property \App\Model\Table\InventoryTransferVouchersTable $InventoryTransferVouchers
 */
class InventoryTransferVouchersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		$this->viewBuilder()->layout('index_layout');
		$session = $this->request->session();
		$st_company_id = $session->read('st_company_id');
		$where = [];
        $vouch_no = $this->request->query('vouch_no');
		$From = $this->request->query('From');
		$To = $this->request->query('To');
		//pr($vouch_no);exit;
		
		$this->set(compact('vouch_no','From','To'));
		
		if(!empty($vouch_no)){
			$where['InventoryTransferVouchers.voucher_no LIKE']=$vouch_no;
		}
		
		if(!empty($From)){
			$From=date("Y-m-d",strtotime($this->request->query('From')));
			$where['InventoryTransferVouchers.transaction_date >=']=$From;
		}
		if(!empty($To)){
			$To=date("Y-m-d",strtotime($this->request->query('To')));
			$where['InventoryTransferVouchers.transaction_date <=']=$To;
		}
		
		$inventory_transfer_vouchs = $this->InventoryTransferVouchers->find()->where($where);
		//pr($inventory_transfer_vouchs->toArray());exit;
		
		
		$this->paginate = [
            'contain' => ['Companies']
        ];
        $inventoryTransferVouchers = $this->paginate($this->InventoryTransferVouchers);

        $this->set(compact('inventoryTransferVouchers','inventory_transfer_vouchs'));
        $this->set('_serialize', ['inventoryTransferVouchers']);
    }

    /**
     * View method
     *
     * @param string|null $id Inventory Transfer Voucher id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $inventoryTransferVoucher = $this->InventoryTransferVouchers->get($id, [
            'contain' => ['Companies', 'InventoryTransferVoucherRows']
        ]);

        $this->set('inventoryTransferVoucher', $inventoryTransferVoucher);
        $this->set('_serialize', ['inventoryTransferVoucher']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('index_layout');
		$session = $this->request->session();
		$st_company_id = $session->read('st_company_id');
		$s_employee_id=$this->viewVars['s_employee_id'];
		$display_items = $this->InventoryTransferVouchers->Items->find()->contain(['ItemSerialNumbers'])->toArray();
		
		
		
		$inventory_vouchers = [$this->request->data['inventory_transfer_voucher_rows']];
	  
		//pr($inventory_vouchers);exit;
	  
		$inventory_voucher_data = [];
	
		$obj_out = (object)$inventory_vouchers[0]['out'];
		
		foreach($obj_out as $out_data)
		{
			$out_data['status'] = 'Out';
			$inventory_voucher_data[] = $out_data;
		}

		$obj_in = (object)$inventory_vouchers[0]['in'];
		
		foreach($obj_in as $out_data)
		{
			$out_data['status'] = 'In';
			$inventory_voucher_data[] = $out_data;
		}		
		
		//pr($inventory_voucher_data);
			
		$inventoryTransferVoucher = $this->InventoryTransferVouchers->newEntity();
		
		$inventory_vouchers = [];
        if ($this->request->is('post')) {
			$inventoryTransferVoucher = $this->InventoryTransferVouchers->patchEntity($inventoryTransferVoucher, $this->request->data);
			$inventoryTransferVoucher->transaction_date=date("Y-m-d",strtotime($inventoryTransferVoucher->transaction_date));
			$inventoryTransferVoucher->created_on=date("Y-m-d");
			
			$last_voucher_no=$this->InventoryTransferVouchers->find()->select(['voucher_no'])->where(['company_id' => $st_company_id])->order(['voucher_no' => 'DESC'])->first();
			if($last_voucher_no){
				$inventoryTransferVoucher->voucher_no=$last_voucher_no->voucher_no+1;
			}else{
				$inventoryTransferVoucher->voucher_no=1;
			}
			$inventoryTransferVoucher->company_id=$st_company_id;
			$inventoryTransferVoucher->created_by=$s_employee_id;
			pr($inventoryTransferVoucher); exit;
			if ($this->InventoryTransferVouchers->save($inventoryTransferVoucher)) {
							
			foreach($inventory_voucher_data as $inventory_voucher_out){
					if($inventory_voucher_out['status'] == "Out" ){
						$Itemledgers = $this->InventoryTransferVouchers->ItemLedgers->find()->where(['item_id'=>$inventory_voucher_out['item_id'],'in_out'=>'In']);
						
						$j=0; $qty_total=0; $total_amount=0;
						foreach($Itemledgers as $Itemledger){
							$Itemledger_qty = $Itemledger->quantity;
							$Itemledger_rate = $Itemledger->rate;
							$total_amount = $total_amount+($Itemledger_qty * $Itemledger_rate);
							$qty_total=$qty_total+$Itemledger_qty;
							$j++;
						}
						
						//echo $inventory_voucher_out['status'].'<br>';
						$per_unit_cost=$total_amount/$qty_total;
						$InventoryTransferVoucherRow = $this->InventoryTransferVouchers->InventoryTransferVoucherRows->newEntity();
						$InventoryTransferVoucherRow->item_id = $inventory_voucher_out['item_id'];
						$InventoryTransferVoucherRow->quantity = $inventory_voucher_out['quantity'];
						$InventoryTransferVoucherRow->status = $inventory_voucher_out['status'];	$InventoryTransferVoucherRow->amount = $per_unit_cost*$inventory_voucher_out['quantity'];
						$InventoryTransferVoucherRow->inventory_transfer_voucher_id = $inventoryTransferVoucher->id;
						
						//$this->InventoryTransferVouchers->InventoryTransferVoucherRows->save($InventoryTransferVoucherRow);
								
							
						}else{
							//echo $inventory_voucher_out['status'].'<br>';
							$InventoryTransferVoucherRow = $this->InventoryTransferVouchers->InventoryTransferVoucherRows->newEntity();
					
								$InventoryTransferVoucherRow->item_id = $inventory_voucher_out['item_id_in'];
								//pr($InventoryTransferVoucherRow->item_id);exit;
								$InventoryTransferVoucherRow->quantity = $inventory_voucher_out['quantity_in'];
								$InventoryTransferVoucherRow->status = $inventory_voucher_out['status'];
								$InventoryTransferVoucherRow->created_on = date("Y-m-d");
								$InventoryTransferVoucherRow->transaction_date = $inventoryTransferVoucher->transaction_date;
								$InventoryTransferVoucherRow->amount = $inventory_voucher_out['amount'];
								$InventoryTransferVoucherRow->inventory_transfer_voucher_id = $inventoryTransferVoucher->id;

								//   $this->InventoryTransferVouchers->InventoryTransferVoucherRows->save($InventoryTransferVoucherRow);
						}

							
								
				}
				
			$this->Flash->success(__('The inventory transfer voucher has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else { 
                $this->Flash->error(__('The inventory transfer voucher could not be saved. Please, try again.'));
            }
        }
        $companies = $this->InventoryTransferVouchers->Companies->find('list', ['limit' => 200]);
        $this->set(compact('inventoryTransferVoucher', 'companies','display_items','options'));
        $this->set('_serialize', ['inventoryTransferVoucher']);
        $this->set('_serialize', ['inventoryTransferVoucher']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Inventory Transfer Voucher id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
	 public function ItemSerialNumber($select_item_id = null)
    {
		$this->viewBuilder()->layout('');
		$session = $this->request->session();
		$st_company_id = $session->read('st_company_id');
		$flag=0; 
		$Item = $this->InventoryTransferVouchers->Items->get($select_item_id, [
            'contain' => ['ItemCompanies'=>function($q) use($st_company_id){
				return $q->where(['company_id'=>$st_company_id]);
			}]
        ]);
		//pr($Item->item_companies[0]->serial_number_enable);
		if($Item->item_companies[0]->serial_number_enable=="1"){
			$SerialNumbers=$this->InventoryTransferVouchers->Items->ItemSerialNumbers->find()->where(['item_id'=>$select_item_id,'status'=>'In','company_id'=>$st_company_id]);
			
			$selectedSerialNumbers=$this->InventoryTransferVouchers->Items->ItemSerialNumbers->find()->where(['item_id'=>$select_item_id,'status'=>'Out','company_id'=>$st_company_id]);
			
			//pr($selectedSerialNumbers);exit;
			$flag=1;
		}
		$this->set(compact('SerialNumbers','flag','select_item_id','selectedSerialNumbers'));
    }


    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
		$session = $this->request->session();
		$st_company_id = $session->read('st_company_id');
		$display_items = $this->InventoryTransferVouchers->Items->find()->contain(['ItemSerialNumbers'])->toArray();
	
        $inventoryTransferVouchersout = $this->InventoryTransferVouchers->get($id, [
            'contain' => ['InventoryTransferVoucherRows'=>
						 function($q) use($st_company_id,$id){
											return $q->where(['inventory_transfer_voucher_id'=>$id,'status'=>'Out'])->contain(['Items'=>['ItemCompanies','ItemLedgers','ItemSerialNumbers']]);
				 }]
				
        ]);
		//pr()
		
		$inventoryTransferVoucher = $this->InventoryTransferVouchers->get($id, [
            'contain' => ['InventoryTransferVoucherRows']
        ]);
		
		$inventoryTransferVouchersins = $this->InventoryTransferVouchers->get($id, [
            'contain' => ['InventoryTransferVoucherRows'=>
						 function($q) use($st_company_id,$id){
											return $q->where(['inventory_transfer_voucher_id'=>$id,'status'=>'In'])->contain(['Items'=>['ItemCompanies','ItemLedgers','ItemSerialNumbers']]);
				 }]
				
        ]);		
		
		
		 if ($this->request->is(['patch', 'post', 'put'])) {
            $inventoryTransferVoucher = $this->InventoryTransferVouchers->patchEntity($inventoryTransferVoucher, $this->request->data);
			//pr($inventoryTransferVoucher);exit;
			$inventory_voucher_outs = $this->request->data['inventory_transfer_voucher_rows']['out'];
			$inventory_voucher_ins = $this->request->data['inventory_transfer_voucher_rows']['in'];
			
			//pr($this->request->data);exit;
			
			foreach($inventory_voucher_outs as $inventory_voucher_out){
				//pr($inventory_voucher_out['item_id']); exit;
				$query_in = $this->InventoryTransferVouchers->Items->ItemSerialNumbers->query();
				$query_in->update()
						 ->set(['status' => 'In'])
						 ->where(['inventory_transfer_voucher_id' => $id,'item_id'=>$inventory_voucher_out['item_id'],'status'=>'Out'])
						 ->execute();
						 
				$serial_data=0;
				$serial_data=sizeof(@$inventory_voucher_out['serial_number_data']);
				if($serial_data>0){
					$serial_number_datas=$inventory_voucher_out['serial_number_data'];
					foreach($serial_number_datas as $key=>$serial_number_data){
						$query2 = $this->InventoryTransferVouchers->Items->ItemSerialNumbers->query();
						$query2->update()
							->set(['inventory_transfer_voucher_id' => $inventoryTransferVoucher->id,'status' => 'Out'])
							->where(['id' => $serial_number_data])
							->execute();
					}
				}
				
			$Itemledgers = $this->InventoryTransferVouchers->ItemLedgers->find()->where(['item_id'=>$inventory_voucher_out['item_id'],'in_out'=>'In']);
			//pr($Itemledgers->toArray());exit;
				
				$j=0; $qty_total=0; $total_amount=0;
				foreach($Itemledgers as $Itemledger){
					$Itemledger_qty = $Itemledger->quantity;
					$Itemledger_rate = $Itemledger->rate;
					$total_amount = $total_amount+($Itemledger_qty * $Itemledger_rate);
					$qty_total=$qty_total+$Itemledger_qty;
					$j++;
				}
				
				$per_unit_cost=$total_amount/$qty_total;
				$today_date =  Time::now();
				//pr($today_date);exit;
				$query= $this->InventoryTransferVouchers->ItemLedgers->query();
						$query->insert(['item_id','quantity' ,'rate', 'in_out','source_model','processed_on','company_id','source_id'])
							   ->values([
											'item_id' => $inventory_voucher_out['item_id'],
											'quantity' => $inventory_voucher_out['quantity'],
											'rate' => $per_unit_cost,
											'source_model' => 'Inventory Transfer Voucher',
											'processed_on' => date("Y-m-d",strtotime($inventoryTransferVoucher->transaction_date)),
											'in_out'=>'Out',
											'company_id'=>$st_company_id,
											'source_id'=>$id
										])
					     ->execute();		
			
							
				
						
			} //exit;
			
			

	
			
			
            if ($this->InventoryTransferVouchers->save($inventoryTransferVoucher)) {
                $this->Flash->success(__('The inventory transfer voucher has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The inventory transfer voucher could not be saved. Please, try again.'));
            }
        }
        $companies = $this->InventoryTransferVouchers->Companies->find('list', ['limit' => 200]);
        $this->set(compact('inventoryTransferVoucher', 'companies','inventoryTransferVouchersout','inventoryTransferVouchersins','id','display_items'));
        $this->set('_serialize', ['inventoryTransferVoucher']);
    }

	function DeleteSerialNumbers($id=null,$in_id=null,$in_voucher_id=null,$item_id=null){
		//pr($in_id);
		//pr($in_voucher_id);exit;
		$session = $this->request->session();
		$st_company_id = $session->read('st_company_id');
		$ItemLedger=$this->InventoryTransferVouchers->InventoryTransferVoucherRows->Items->ItemLedgers->find()->where(['source_id'=>$in_voucher_id,'item_id'=>$item_id,'in_out'=>'In','source_model'=>'Inventory Transfer Voucher'])->first();
		//pr($ItemLedger);exit;
		
		$ItemSerialNumber = $this->InventoryTransferVouchers->ItemSerialNumbers->get($id);
		$InventoryTransferVoucherRows = $this->InventoryTransferVouchers->InventoryTransferVoucherRows->get($in_id);
		//pr($InventoryTransferVoucherRows);exit;
		
		if($ItemSerialNumber->status=='In'){
			$ItemQuantity = $ItemLedger->quantity-1;
			//pr($ItemQuantity);exit;
			if($ItemQuantity == 0){
				$this->InventoryTransferVouchers->ItemLedgers->delete($ItemLedger);
				$this->InventoryTransferVouchers->InventoryTransferVoucherRows->delete($InventoryTransferVoucherRows);
				$this->Flash->success(__('The Item has been deleted.'));
				return $this->redirect(['action' => 'Opening-Balance']);
				
			}else{
				
			$query_in = $this->InventoryTransferVouchers->InventoryTransferVoucherRows->query();
			
			$query_in->update()
				->set(['quantity' => $InventoryTransferVoucherRows->quantity-1])
				->where(['inventory_transfer_voucher_id' => $in_voucher_id,'item_id'=>$item_id,'status'=>'In'])
				->execute();	
				
			$query = $this->InventoryTransferVouchers->InventoryTransferVoucherRows->Items->ItemLedgers->query();
			$query->update()
				->set(['quantity' => $ItemLedger->quantity-1])
				->where(['item_id'=>$item_id,'company_id'=>$st_company_id,'source_model'=>'Inventory Transfer Voucher','in_out'=>'In'])
				->execute();
					
			$this->InventoryTransferVouchers->ItemSerialNumbers->delete($ItemSerialNumber);
			$this->Flash->success(__('The Serial Number has been deleted.'));
			 }
		}
		return $this->redirect(['action' => 'edit/'.$in_voucher_id]);
	}
    /**
     * Delete method
     *
     * @param string|null $id Inventory Transfer Voucher id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $inventoryTransferVoucher = $this->InventoryTransferVouchers->get($id);
        if ($this->InventoryTransferVouchers->delete($inventoryTransferVoucher)) {
            $this->Flash->success(__('The inventory transfer voucher has been deleted.'));
        } else {
            $this->Flash->error(__('The inventory transfer voucher could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
