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
				$totalVAT=0; $total_amount=0;
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
					
					$totalVAT=$totalVAT+$amountofVAT;
					
					$amount=$amount+$invoice_booking_row->other_charges;
					$total_amount=$total_amount+$amount;
				}
				
				echo $totalVAT;
				echo '<br/>';
				echo $total_amount;
				
				posing for supplier
				$total_amount
				
				posting for purchase acc
				$total_amount-$totalVAT
				
				posting for VAT acc
				$totalVAT
				exit;
				
				
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
