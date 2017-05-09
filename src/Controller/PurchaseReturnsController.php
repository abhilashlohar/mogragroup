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
		//pr($invoiceBookings); exit;
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
	//pr($purchaseReturn); exit;
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
                $this->Flash->success(__('The purchase return has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else { pr($purchaseReturn); exit;
                $this->Flash->error(__('The purchase return could not be saved. Please, try again.'));
            }
        }
       // $invoiceBookings = $this->PurchaseReturns->InvoiceBookings->find('list', ['limit' => 200]);
		$Em = new FinancialYearsController;
	    $financial_year_data = $Em->checkFinancialYear($invoiceBooking->created_on);
        $companies = $this->PurchaseReturns->Companies->find('list', ['limit' => 200]);
        $this->set(compact('purchaseReturn', 'invoiceBooking', 'companies','financial_year_data'));
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
}
