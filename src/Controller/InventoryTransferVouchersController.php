<?php
namespace App\Controller;

use App\Controller\AppController;

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
        $this->paginate = [
            'contain' => ['Companies']
        ];
        $inventoryTransferVouchers = $this->paginate($this->InventoryTransferVouchers);

        $this->set(compact('inventoryTransferVouchers'));
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
		
		
		//pr($options);exit;	
		$inventoryTransferVoucher = $this->InventoryTransferVouchers->newEntity();
	
        if ($this->request->is('post')) {
            $inventoryTransferVoucher = $this->InventoryTransferVouchers->patchEntity($inventoryTransferVoucher, $this->request->data);
			//pr($inventoryTransferVoucher);exit;
			
			$last_voucher_no=$this->InventoryTransferVouchers->find()->select(['voucher_no'])->where(['company_id' => $st_company_id])->order(['voucher_no' => 'DESC'])->first();
			if($last_voucher_no){
				$inventoryTransferVoucher->voucher_no=$last_voucher_no->voucher_no+1;
			}else{
				$inventoryTransferVoucher->voucher_no=1;
			}
			$inventoryTransferVoucher->company_id=$st_company_id;
			$inventoryTransferVoucher->created_by=$s_employee_id;

			
			
			$inventory_voucher_outs = $this->request->data['inventory_transfer_voucher_rows']['out'];
			$inventory_voucher_ins = $this->request->data['inventory_transfer_voucher_rows']['in'];
			//pr($inventory_voucher_ins);exit;
			//$serial_data=sizeof(@$inventory_voucher_outs[0]['serial_number_data']);
			
			if ($this->InventoryTransferVouchers->save($inventoryTransferVoucher)) {
			
			foreach($inventory_voucher_outs as $inventory_voucher_out){
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
				
				$j=0; $qty_total=0; $total_amount=0;
				foreach($Itemledgers as $Itemledger){
					$Itemledger_qty = $Itemledger->quantity;
					$Itemledger_rate = $Itemledger->rate;
					$total_amount = $total_amount+($Itemledger_qty * $Itemledger_rate);
					$qty_total=$qty_total+$Itemledger_qty;
					$j++;
				}
				
				$per_unit_cost=$total_amount/$qty_total;
				$query= $this->InventoryTransferVouchers->ItemLedgers->query();
						$query->insert(['item_id','quantity' ,'rate', 'in_out','source_model','company_id','source_id'])
							   ->values([
											'item_id' => $inventory_voucher_out['item_id'],
											'quantity' => $inventory_voucher_out['quantity'],
											'rate' => $per_unit_cost,
											'source_model' => 'Inventory Transfer Voucher',
											'in_out'=>'Out',
											'company_id'=>$st_company_id,
											'source_id'=>$inventoryTransferVoucher->id
										])
					     ->execute();		
			$InventoryTransferVoucherRow = $this->InventoryTransferVouchers->InventoryTransferVoucherRows->newEntity();
						$InventoryTransferVoucherRow->item_id = $inventory_voucher_out['item_id'];
						$InventoryTransferVoucherRow->quantity = $inventory_voucher_out['quantity'];
						$InventoryTransferVoucherRow->status = 'Out';
						$InventoryTransferVoucherRow->amount = $per_unit_cost*$inventory_voucher_out['quantity'];
						$InventoryTransferVoucherRow->inventory_transfer_voucher_id = $inventoryTransferVoucher->id;
						$this->InventoryTransferVouchers->InventoryTransferVoucherRows->save($InventoryTransferVoucherRow);
			
							
				}
			foreach($inventory_voucher_ins as $inventory_voucher_in){
				
				$serial_data=0;
				$serial_data=sizeof(@$inventory_voucher_in['sr_no']);
				if($serial_data>0){
					$serial_number_datas=$inventory_voucher_in['sr_no'];
					foreach($serial_number_datas as $key=>$serial_number_data){
						$query2 = $this->InventoryTransferVouchers->Items->ItemSerialNumbers->query();
						$query2->insert(['item_id','serial_no','status','company_id','inventory_transfer_voucher_id'])
							->values([
										'item_id' =>$inventory_voucher_in['item_id_in'],
										'serial_no'=>$serial_number_data,
										'status'=>'In',
										'company_id'=>$st_company_id,
										'inventory_transfer_voucher_id'=>$inventoryTransferVoucher->id
										])
							->execute();
					}
				}
			$Itemledgers = $this->InventoryTransferVouchers->ItemLedgers->find()->where(['item_id'=>$inventory_voucher_in['item_id_in'],'in_out'=>'In']);
				
				
				$query= $this->InventoryTransferVouchers->ItemLedgers->query();
						$query->insert(['item_id','quantity' ,'rate', 'in_out','source_model','company_id','source_id'])
							   ->values([
											'item_id' => $inventory_voucher_in['item_id_in'],
											'quantity' => $inventory_voucher_in['quantity_in'],
											'rate' =>$inventory_voucher_in['amount'],
											'source_model' => 'Inventory Transfer Voucher',
											'in_out'=>'In',
											'company_id'=>$st_company_id,
											'source_id'=>$inventoryTransferVoucher->id
										])
					     ->execute();	
						
			$InventoryTransferVoucherRow = $this->InventoryTransferVouchers->InventoryTransferVoucherRows->newEntity();
						$InventoryTransferVoucherRow->item_id = $inventory_voucher_in['item_id_in'];
						$InventoryTransferVoucherRow->quantity = $inventory_voucher_in['quantity_in'];
						$InventoryTransferVoucherRow->status = 'In';
						$InventoryTransferVoucherRow->amount = $inventory_voucher_in['amount'];
						$InventoryTransferVoucherRow->inventory_transfer_voucher_id = $inventoryTransferVoucher->id;
						$this->InventoryTransferVouchers->InventoryTransferVoucherRows->save($InventoryTransferVoucherRow); 
				}
			
				
			$this->Flash->success(__('The inventory transfer voucher has been saved.'));

                return $this->redirect(['action' => 'add']);
            } else { 
                $this->Flash->error(__('The inventory transfer voucher could not be saved. Please, try again.'));
            }
        }
        $companies = $this->InventoryTransferVouchers->Companies->find('list', ['limit' => 200]);
        $this->set(compact('inventoryTransferVoucher', 'companies','display_items','options'));
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
			$flag=1;
		}
		$this->set(compact('SerialNumbers','flag','select_item_id','selectedSerialNumbers'));
    }


    public function edit($id = null)
    {
        $inventoryTransferVoucher = $this->InventoryTransferVouchers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $inventoryTransferVoucher = $this->InventoryTransferVouchers->patchEntity($inventoryTransferVoucher, $this->request->data);
            if ($this->InventoryTransferVouchers->save($inventoryTransferVoucher)) {
                $this->Flash->success(__('The inventory transfer voucher has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The inventory transfer voucher could not be saved. Please, try again.'));
            }
        }
        $companies = $this->InventoryTransferVouchers->Companies->find('list', ['limit' => 200]);
        $this->set(compact('inventoryTransferVoucher', 'companies'));
        $this->set('_serialize', ['inventoryTransferVoucher']);
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
