<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PettyCashReceiptVouchers Controller
 *
 * @property \App\Model\Table\PettyCashReceiptVouchersTable $PettyCashReceiptVouchers
 */
class PettyCashReceiptVouchersController extends AppController
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
            'contain' => ['ReceivedFroms', 'BankCashes']
        ];
		$session = $this->request->session();
		$st_company_id = $session->read('st_company_id');
        $pettyCashReceiptVouchers = $this->paginate($this->PettyCashReceiptVouchers->find()->where(['PettyCashReceiptVouchers.company_id'=>$st_company_id])->order(['transaction_date' => 'DESC']));
		$this->set(compact('pettyCashReceiptVouchers'));
        $this->set('_serialize', ['pettyCashReceiptVouchers']);
    }

    /**
     * View method
     *
     * @param string|null $id Petty Cash Receipt Voucher id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		
		$this->viewBuilder()->layout('index_layout');
        $pettyCashReceiptVoucher = $this->PettyCashReceiptVouchers->get($id, [
            'contain' => ['ReceivedFroms', 'BankCashes','Companies','Creator']
        ]);

        $this->set('pettyCashReceiptVoucher', $pettyCashReceiptVoucher);
        $this->set('_serialize', ['pettyCashReceiptVoucher']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('index_layout');
        $pettyCashReceiptVoucher = $this->PettyCashReceiptVouchers->newEntity();
		$s_employee_id=$this->viewVars['s_employee_id'];
		$session = $this->request->session();
		$st_company_id = $session->read('st_company_id');
        $st_year_id = $session->read('st_year_id');
		$financial_year = $this->PettyCashReceiptVouchers->FinancialYears->find()->where(['id'=>$st_year_id])->first();
    
        if ($this->request->is('post')) {
			$last_ref_no=$this->PettyCashReceiptVouchers->find()->select(['voucher_no'])->where(['company_id' => $st_company_id])->order(['voucher_no' => 'DESC'])->first();
			if($last_ref_no){
				$pettyCashReceiptVoucher->voucher_no=$last_ref_no->voucher_no+1;
			}else{
				$pettyCashReceiptVoucher->voucher_no=1;
			}
            $pettyCashReceiptVoucher = $this->PettyCashReceiptVouchers->patchEntity($pettyCashReceiptVoucher, $this->request->data);
			$pettyCashReceiptVoucher->created_by=$s_employee_id;
			$pettyCashReceiptVoucher->transaction_date=date("Y-m-d",strtotime($pettyCashReceiptVoucher->transaction_date));
			$pettyCashReceiptVoucher->created_on=date("Y-m-d");
			$pettyCashReceiptVoucher->company_id=$st_company_id;
			//pr($pettyCashReceiptVoucher); exit;
			if ($this->PettyCashReceiptVouchers->save($pettyCashReceiptVoucher)) 
			{
				$ledger = $this->PettyCashReceiptVouchers->Ledgers->newEntity();
				$ledger->company_id=$st_company_id;
				$ledger->ledger_account_id = $pettyCashReceiptVoucher->bank_cash_id;
				$ledger->debit = $pettyCashReceiptVoucher->amount;
				$ledger->credit = 0;
				$ledger->voucher_id = $pettyCashReceiptVoucher->id;
				$ledger->voucher_source = 'PettyCashReceipt Voucher';
				$ledger->transaction_date = $pettyCashReceiptVoucher->transaction_date;
				$this->PettyCashReceiptVouchers->Ledgers->save($ledger);
				//Ledger posting for bankcash
				$ledger = $this->PettyCashReceiptVouchers->Ledgers->newEntity();
				$ledger->company_id=$st_company_id;
				$ledger->ledger_account_id = $pettyCashReceiptVoucher->received_from_id;
				$ledger->debit = 0;
				$ledger->credit = $pettyCashReceiptVoucher->amount;;
				$ledger->voucher_id = $pettyCashReceiptVoucher->id;
				$ledger->voucher_source = 'PettyCashReceipt Voucher';
				$ledger->transaction_date = $pettyCashReceiptVoucher->transaction_date;
				$this->PettyCashReceiptVouchers->Ledgers->save($ledger);
				$this->Flash->success(__('The Petty Cash-Voucher:'.str_pad($pettyCashReceiptVoucher->voucher_no, 4, '0', STR_PAD_LEFT)).' has been genereted.');
				return $this->redirect(['action' => 'view/'.$pettyCashReceiptVoucher->id]);
            } 
			else 
			{
                $this->Flash->error(__('The petty cash receipt voucher could not be saved. Please, try again.'));
            }
        }
		$vr=$this->PettyCashReceiptVouchers->VouchersReferences->find()->where(['company_id'=>$st_company_id,'module'=>'Petty Cash Receipt','sub_entity'=>'Received From'])->first();
		$PettyCashReceiptVouchersReceived=$vr->id;
		$vouchersReferences = $this->PettyCashReceiptVouchers->VouchersReferences->get($vr->id, [
            'contain' => ['VoucherLedgerAccounts']
        ]);
		
		$where=[];
		foreach($vouchersReferences->voucher_ledger_accounts as $data){
			$where[]=$data->ledger_account_id;
		}
		if(sizeof($where)>0){
			$receivedFroms = $this->PettyCashReceiptVouchers->ReceivedFroms->find('list',
				['keyField' => function ($row) {
					return $row['id'];
				},
				'valueField' => function ($row) {
					if(!empty($row['alias'])){
						return  $row['name'] . ' (' . $row['alias'] . ')';
					}else{
						return $row['name'];
					}
					
				}])->where(['ReceivedFroms.id IN' => $where]);
		}
		else{
			$ErrorreceivedFroms='true';
		}
		$vr=$this->PettyCashReceiptVouchers->VouchersReferences->find()->where(['company_id'=>$st_company_id,'module'=>'Petty Cash Receipt','sub_entity'=>'Cash/Bank'])->first();
		$PettyCashReceiptVouchersCashBank=$vr->id;
		$vouchersReferences = $this->PettyCashReceiptVouchers->VouchersReferences->get($vr->id, [
            'contain' => ['VoucherLedgerAccounts']
        ]);
		$where=[];
		foreach($vouchersReferences->voucher_ledger_accounts as $data){
			  $where[]=$data->ledger_account_id;
			
		}
		if(sizeof($where)>0){
			$bankCashes = $this->PettyCashReceiptVouchers->BankCashes->find('list',
				['keyField' => function ($row) {
					return $row['id'];
				},
				'valueField' => function ($row) {
					if(!empty($row['alias'])){
						return  $row['name'] . ' (' . $row['alias'] . ')';
					}else{
						return $row['name'];
					}
					
				}])->where(['BankCashes.id IN' => $where]);
		}
		else{
			$ErrorbankCashes='true';
		}
	 $companies = $this->PettyCashReceiptVouchers->Companies->find('all');
        $this->set(compact('pettyCashReceiptVoucher', 'receivedFroms', 'bankCashes','companies','ErrorbankCashes','ErrorreceivedFroms','financial_year','PettyCashReceiptVouchersReceived'));
        $this->set('_serialize', ['pettyCashReceiptVoucher']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Petty Cash Receipt Voucher id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		
		$this->viewBuilder()->layout('index_layout');
		$s_employee_id=$this->viewVars['s_employee_id'];
		$session = $this->request->session();
		$st_company_id = $session->read('st_company_id');
        $st_year_id = $session->read('st_year_id');
		$financial_year = $this->PettyCashReceiptVouchers->FinancialYears->find()->where(['id'=>$st_year_id])->first();
    
        $pettyCashReceiptVoucher = $this->PettyCashReceiptVouchers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pettyCashReceiptVoucher = $this->PettyCashReceiptVouchers->patchEntity($pettyCashReceiptVoucher, $this->request->data);
			$pettyCashReceiptVoucher->edited_by=$s_employee_id;
			$pettyCashReceiptVoucher->transaction_date=date("Y-m-d",strtotime($pettyCashReceiptVoucher->transaction_date));
			$pettyCashReceiptVoucher->edited_on=date("Y-m-d");
			$pettyCashReceiptVoucher->company_id=$st_company_id;
			
            if ($this->PettyCashReceiptVouchers->save($pettyCashReceiptVoucher)) {
				$this->PettyCashReceiptVouchers->Ledgers->deleteAll(['voucher_id' => $pettyCashReceiptVoucher->id, 'voucher_source' => 'PettyCashReceipt Voucher']);
				
				$ledger = $this->PettyCashReceiptVouchers->Ledgers->newEntity();
				$ledger->company_id=$st_company_id;
				$ledger->ledger_account_id = $pettyCashReceiptVoucher->bank_cash_id;
				$ledger->debit = $pettyCashReceiptVoucher->amount;
				$ledger->credit = 0;
				$ledger->voucher_id = $pettyCashReceiptVoucher->id;
				$ledger->voucher_source = 'PettyCashReceipt Voucher';
				$ledger->transaction_date = $pettyCashReceiptVoucher->transaction_date;
				$this->PettyCashReceiptVouchers->Ledgers->save($ledger);
				//Ledger posting for bankcash
				$ledger = $this->PettyCashReceiptVouchers->Ledgers->newEntity();
				$ledger->company_id=$st_company_id;
				$ledger->ledger_account_id = $pettyCashReceiptVoucher->received_from_id;
				$ledger->debit = 0;
				$ledger->credit = $pettyCashReceiptVoucher->amount;;
				$ledger->voucher_id = $pettyCashReceiptVoucher->id;
				$ledger->voucher_source = 'PettyCashReceipt Voucher';
				$ledger->transaction_date = $pettyCashReceiptVoucher->transaction_date;
				$this->PettyCashReceiptVouchers->Ledgers->save($ledger);
                
				$this->Flash->success(__('The petty cash receipt voucher has been saved.'));
				return $this->redirect(['action' => 'view/'.$pettyCashReceiptVoucher->id]);
           } else {
                $this->Flash->error(__('The petty cash receipt voucher could not be saved. Please, try again.'));
            }
        }
		
		$vr=$this->PettyCashReceiptVouchers->VouchersReferences->find()->where(['company_id'=>$st_company_id,'module'=>'Petty Cash Receipt','sub_entity'=>'Received From'])->first();
		$vouchersReferences = $this->PettyCashReceiptVouchers->VouchersReferences->get($vr->id, [
            'contain' => ['VoucherLedgerAccounts']
        ]);
		
		$where=[];
		foreach($vouchersReferences->voucher_ledger_accounts as $data){
			$where[]=$data->ledger_account_id;
		}

		$receivedFroms = $this->PettyCashReceiptVouchers->ReceivedFroms->find('list',
				['keyField' => function ($row) {
					return $row['id'];
				},
				'valueField' => function ($row) {
					if(!empty($row['alias'])){
						return  $row['name'] . ' (' . $row['alias'] . ')';
					}else{
						return $row['name'];
					}
					
				}])->where(['ReceivedFroms.id IN' => $where]);
		$vr=$this->PettyCashReceiptVouchers->VouchersReferences->find()->where(['company_id'=>$st_company_id,'module'=>'Petty Cash Receipt','sub_entity'=>'Cash/Bank'])->first();
		$vouchersReferences = $this->PettyCashReceiptVouchers->VouchersReferences->get($vr->id, [
            'contain' => ['VoucherLedgerAccounts']
        ]);
		$where=[];
		foreach($vouchersReferences->voucher_ledger_accounts as $data){
			  $where[]=$data->ledger_account_id;
			
		}
		$bankCashes = $this->PettyCashReceiptVouchers->BankCashes->find('list',
				['keyField' => function ($row) {
					return $row['id'];
				},
				'valueField' => function ($row) {
					if(!empty($row['alias'])){
						return  $row['name'] . ' (' . $row['alias'] . ')';
					}else{
						return $row['name'];
					}
					
				}])->where(['BankCashes.id IN' => $where]);
		$companies = $this->PettyCashReceiptVouchers->Companies->find('all');
        $this->set(compact('pettyCashReceiptVoucher', 'receivedFroms', 'bankCashes','companies','financial_year'));
        $this->set('_serialize', ['pettyCashReceiptVoucher']);
 
    }

    /**
     * Delete method
     *
     * @param string|null $id Petty Cash Receipt Voucher id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pettyCashReceiptVoucher = $this->PettyCashReceiptVouchers->get($id);
        if ($this->PettyCashReceiptVouchers->delete($pettyCashReceiptVoucher)) {
            $this->Flash->success(__('The petty cash receipt voucher has been deleted.'));
        } else {
            $this->Flash->error(__('The petty cash receipt voucher could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
