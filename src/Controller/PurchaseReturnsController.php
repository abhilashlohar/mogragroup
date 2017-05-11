<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PurchaseReturns Controller
 *
 * @property \App\Model\Table\PurchaseReturnsTable $PurchaseReturns
 */
class PurchaseReturnsController extends AppController
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
        $this->paginate = [
            'contain' => ['InvoiceBookings', 'Companies']
        ];
        $purchaseReturns = $this->paginate($this->PurchaseReturns);

        $this->set(compact('purchaseReturns'));
        $this->set('_serialize', ['purchaseReturns']);
    }

    /**
     * View method
     *
     * @param string|null $id Purchase Return id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $purchaseReturn = $this->PurchaseReturns->get($id, [
            'contain' => ['InvoiceBookings', 'Companies']
        ]);

        $this->set('purchaseReturn', $purchaseReturn);
        $this->set('_serialize', ['purchaseReturn']);
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
        $purchaseReturn = $this->PurchaseReturns->newEntity();
		$invoice_booking_id=@(int)$this->request->query('invoiceBooking');
		$invoiceBooking = $this->PurchaseReturns->InvoiceBookings->get($invoice_booking_id, [
            'contain' => ['InvoiceBookingRows' => ['Items'],'Grns'=>['Companies','Vendors','GrnRows'=>['Items'],'PurchaseOrders'=>['PurchaseOrderRows']]]
        ]);
		
		$v_LedgerAccount=$this->PurchaseReturns->LedgerAccounts->find()->where(['company_id'=>$st_company_id,'source_model'=>'Vendors','source_id'=>$invoiceBooking->vendor_id])->first();
		
		 if ($this->request->is('post')) {
			$ref_rows=$this->request->data['ref_rows'];
			$purchaseReturn = $this->PurchaseReturns->patchEntity($purchaseReturn, $this->request->data);
			$purchaseReturn->company_id=$st_company_id;
			$purchaseReturn->created_on= date("Y-m-d");
			$purchaseReturn->created_by=$s_employee_id;
			$last_pr_no=$this->PurchaseReturns->find()->select(['voucher_no'])->where(['company_id' => $st_company_id])->order(['voucher_no' => 'DESC'])->first();
			if($last_pr_no){
				$purchaseReturn->voucher_no=$last_pr_no->voucher_no+1;
			}else{
				$purchaseReturn->voucher_no=1;
			}
			 if ($this->PurchaseReturns->save($purchaseReturn)) {   
				foreach($purchaseReturn->purchase_return_rows as $purchase_return_row){
					$results=$this->PurchaseReturns->ItemLedgers->find()->where(['ItemLedgers.item_id' => $purchase_return_row->item_id,'ItemLedgers.in_out' => 'In','rate_updated' => 'Yes','company_id' => $st_company_id])->first();
					$itemLedger = $this->PurchaseReturns->ItemLedgers->newEntity();
					$itemLedger->item_id = $purchase_return_row->item_id;
					$itemLedger->source_model = 'Purchase Return';
					$itemLedger->source_id = $purchaseReturn->id;
					$itemLedger->in_out = 'Out';
					$itemLedger->rate = $results->rate;
					$itemLedger->company_id = $invoiceBooking->company_id;
					$itemLedger->processed_on = date("Y-m-d");
					$this->PurchaseReturns->ItemLedgers->save($itemLedger);
				}
				$vat_amounts=[]; $total_amounts=[];
				foreach($invoiceBooking->invoice_booking_rows as $invoice_booking_row){
					$amount=$invoice_booking_row->unit_rate_from_po*$invoice_booking_row->quantity;

					$amount=$amount+$invoice_booking_row->misc;
					if($invoice_booking_row->discount_per==1){
						$amount=$amount*((100-$invoice_booking_row->discount)/100);
					}else{
						$amount=$amount-$invoice_booking_row->discount;
					}

					if($invoice_booking_row->pnf_per==1){
						$amount=$amount*((100+$invoice_booking_row->pnf)/100);
					}else{
						$amount=$amount+$invoice_booking_row->pnf;
					}

					$amount=$amount*((100+	$invoice_booking_row->excise_duty)/100);
					$amountofVAT=($amount*$invoice_booking_row->sale_tax)/100;
					$amount=$amount*((100+$invoice_booking_row->sale_tax)/100);

					$vat_amounts[$invoice_booking_row->item_id]=$amountofVAT/$invoice_booking_row->quantity;
					$amount=$amount+$invoice_booking_row->other_charges;
					$total_amounts[$invoice_booking_row->item_id]=$amount/$invoice_booking_row->quantity;
				}
//pr($total_amounts); exit;
				$total_vat_item=0;
				$total_amounts_item=0;
				foreach($purchaseReturn->purchase_return_rows as $purchase_return_row){
					$total_vat=$vat_amounts[$purchase_return_row->item_id]*$purchase_return_row->quantity;
					$total_vat_item=$total_vat_item+$total_vat;
					
					$total_amt=$total_amounts[$purchase_return_row->item_id]*$purchase_return_row->quantity;
					$total_amounts_item=$total_amounts_item+$total_amt;

				}

				foreach($purchaseReturn->purchase_return_rows as $purchase_return_row){
						$query = $this->PurchaseReturns->InvoiceBookings->InvoiceBookingRows->query();
						$query->update()
							->set(['purchase_return_quantity'=>$purchase_return_row->quantity])
							->where(['invoice_booking_id' => $invoiceBooking->id,'item_id'=>$purchase_return_row->item_id])
							->execute();
				}
						
						$query = $this->PurchaseReturns->InvoiceBookings->query();
						$query->update()
						->set(['purchase_return_status' => 'Yes','purchase_return_id'=>$purchaseReturn->id])
						->where(['id' => $invoiceBooking->id])
						->execute();

						$query = $this->PurchaseReturns->query();
						$query->update()
						->set(['invoice_booking_id'=>$invoiceBooking->id])
						->where(['id' => $purchaseReturn->id])
						->execute();
					
				
				if($invoiceBooking->purchase_ledger_account==35){
					//ledger posting for PURCHASE ACCOUNT
					$ledger = $this->PurchaseReturns->Ledgers->newEntity();
					$ledger->ledger_account_id = $invoiceBooking->purchase_ledger_account;
					$ledger->debit = 0;
					$ledger->credit = $total_amounts_item;
					$ledger->voucher_id = $purchaseReturn->id;
					$ledger->company_id = $st_company_id;
					$ledger->voucher_source = 'Purchase Return';
					$ledger->transaction_date = date("Y-m-d");
					$this->PurchaseReturns->Ledgers->save($ledger);
				}else{
					//ledger posting for PURCHASE ACCOUNT
					$ledger = $this->PurchaseReturns->Ledgers->newEntity();
					$ledger->ledger_account_id = $invoiceBooking->purchase_ledger_account;
					$ledger->debit = 0;
					$ledger->credit = $total_amounts_item-$total_vat_item;
					$ledger->voucher_id = $purchaseReturn->id;
					$ledger->company_id = $st_company_id;
					$ledger->voucher_source = 'Purchase Return';
					$ledger->transaction_date = date("Y-m-d");
					$this->PurchaseReturns->Ledgers->save($ledger);
					
					//ledger posting for PURCHASE ACCOUNT
					$ledger = $this->PurchaseReturns->Ledgers->newEntity();
					$ledger->ledger_account_id = $invoiceBooking->ledger_account_for_vat;
					$ledger->debit = 0;
					$ledger->credit = $total_vat_item;
					$ledger->voucher_id = $purchaseReturn->id;
					$ledger->company_id = $st_company_id;
					$ledger->voucher_source = 'Purchase Return';
					$ledger->transaction_date = date("Y-m-d");
					$this->PurchaseReturns->Ledgers->save($ledger);
				}

				$v_LedgerAccount=$this->PurchaseReturns->LedgerAccounts->find()->where(['company_id'=>$st_company_id,'source_model'=>'Vendors','source_id'=>$invoiceBooking->vendor_id])->first();
				$ledger = $this->PurchaseReturns->Ledgers->newEntity();
				$ledger->ledger_account_id = $v_LedgerAccount->id;
				$ledger->debit = $total_amounts_item;
				$ledger->credit =0;
				$ledger->voucher_id = $purchaseReturn->id;
				$ledger->company_id = $invoiceBooking->company_id;
				$ledger->transaction_date = date("Y-m-d");
				$ledger->voucher_source = 'Purchase Return';
				$this->PurchaseReturns->Ledgers->save($ledger);

					if(sizeof(@$ref_rows)>0){
						
						foreach($ref_rows as $ref_row){ 
							$ref_row=(object)$ref_row;
							if($ref_row->ref_type=='New Reference' or $ref_row->ref_type=='Advance Reference'){
								$query = $this->PurchaseReturns->ReferenceBalances->query();
								
								$query->insert(['ledger_account_id', 'reference_no', 'credit', 'debit'])
								->values([
									'ledger_account_id' => $v_LedgerAccount->id,
									'reference_no' => $ref_row->ref_no,
									'credit' => 0,
									'debit' => $ref_row->ref_amount
								]);
								$query->execute();
							}else{
								$ReferenceBalance=$this->PurchaseReturns->ReferenceBalances->find()->where(['ledger_account_id'=>$v_LedgerAccount->id,'reference_no'=>$ref_row->ref_no])->first();
								$ReferenceBalance=$this->PurchaseReturns->ReferenceBalances->get($ReferenceBalance->id);
								$ReferenceBalance->debit=$ReferenceBalance->debit+$ref_row->ref_amount;
								
								$this->PurchaseReturns->ReferenceBalances->save($ReferenceBalance);
							}
							
							$query = $this->PurchaseReturns->ReferenceDetails->query();
							$query->insert(['ledger_account_id', 'purchase_return_id', 'reference_no', 'credit', 'debit', 'reference_type'])
							->values([
								'ledger_account_id' => $v_LedgerAccount->id,
								'purchase_return_id' => $purchaseReturn->id,
								'reference_no' => $ref_row->ref_no,
								'credit' =>  0,
								'debit' =>$ref_row->ref_amount,
								'reference_type' => $ref_row->ref_type
							]);
						
							$query->execute();
						}
					}
				
				$this->Flash->success(__('The purchase return has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {// pr($purchaseReturn); exit;
                $this->Flash->error(__('The purchase return could not be saved. Please, try again.'));
            }
        }
       // $invoiceBookings = $this->PurchaseReturns->InvoiceBookings->find('list', ['limit' => 200]);
		$Em = new FinancialYearsController;
	    $financial_year_data = $Em->checkFinancialYear($invoiceBooking->created_on);
        $companies = $this->PurchaseReturns->Companies->find('list', ['limit' => 200]);
        $this->set(compact('purchaseReturn', 'invoiceBooking', 'companies','financial_year_data','v_LedgerAccount'));
        $this->set('_serialize', ['purchaseReturn']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Purchase Return id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $purchaseReturn = $this->PurchaseReturns->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchaseReturn = $this->PurchaseReturns->patchEntity($purchaseReturn, $this->request->data);
            if ($this->PurchaseReturns->save($purchaseReturn)) {
                $this->Flash->success(__('The purchase return has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The purchase return could not be saved. Please, try again.'));
            }
        }
        $invoiceBookings = $this->PurchaseReturns->InvoiceBookings->find('list', ['limit' => 200]);
        $companies = $this->PurchaseReturns->Companies->find('list', ['limit' => 200]);
        $this->set(compact('purchaseReturn', 'invoiceBookings', 'companies'));
        $this->set('_serialize', ['purchaseReturn']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchase Return id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $purchaseReturn = $this->PurchaseReturns->get($id);
        if ($this->PurchaseReturns->delete($purchaseReturn)) {
            $this->Flash->success(__('The purchase return has been deleted.'));
        } else {
            $this->Flash->error(__('The purchase return could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	public function fetchRefNumbers($ledger_account_id){
		$this->viewBuilder()->layout('');
		$ReferenceBalances=$this->PurchaseReturns->ReferenceBalances->find()->where(['ledger_account_id'=>$ledger_account_id]);
		$this->set(compact('ReferenceBalances','cr_dr'));
	}
	function checkRefNumberUnique($received_from_id,$i){
		$reference_no=$this->request->query['ref_rows'][$i]['ref_no'];
		$ReferenceBalances=$this->PurchaseReturns->ReferenceBalances->find()->where(['ledger_account_id'=>$received_from_id,'reference_no'=>$reference_no]);
		if($ReferenceBalances->count()==0){
			echo 'true';
		}else{
			echo 'false';
		}
		exit;
	}
}
