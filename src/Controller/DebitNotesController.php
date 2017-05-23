<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * DebitNotes Controller
 *
 * @property \App\Model\Table\DebitNotesTable $DebitNotes
 */
class DebitNotesController extends AppController
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
            'contain' => ['SalesAccs', 'Parties', 'Companies']
        ];
		$session = $this->request->session();
		$st_company_id = $session->read('st_company_id');
		
        $debitNotes = $this->paginate($this->DebitNotes->find()->where(['company_id'=>$st_company_id])->order(['transaction_date' => 'DESC']));

        $this->set(compact('debitNotes'));
        $this->set('_serialize', ['debitNotes']);
    }

    /**
     * View method
     *
     * @param string|null $id Debit Note id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $debitNote = $this->DebitNotes->get($id, [
            'contain' => ['SalesAccs', 'Parties', 'Companies','Creator']
        ]);

        $this->set('debitNote', $debitNote);
        $this->set('_serialize', ['debitNote']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		
		$this->viewBuilder()->layout('index_layout');
        $debitNote = $this->DebitNotes->newEntity();
		$s_employee_id=$this->viewVars['s_employee_id'];
		$session = $this->request->session();
		$st_company_id = $session->read('st_company_id');
        $st_year_id = $session->read('st_year_id');
		$financial_year = $this->DebitNotes->FinancialYears->find()->where(['id'=>$st_year_id])->first();
    
        if ($this->request->is('post')) {
			$last_ref_no=$this->DebitNotes->find()->select(['voucher_no'])->where(['company_id' => $st_company_id])->order(['voucher_no' => 'DESC'])->first();
			if($last_ref_no){
				$debitNote->voucher_no=$last_ref_no->voucher_no+1;
			}else{
				$debitNote->voucher_no=1;
			}
            $debitNote = $this->DebitNotes->patchEntity($debitNote, $this->request->data);
			
			$debitNote->created_by=$s_employee_id;
			$debitNote->transaction_date=date("Y-m-d",strtotime($debitNote->transaction_date));
			$debitNote->created_on=date("Y-m-d");
			$debitNote->company_id=$st_company_id;
			
            if ($this->DebitNotes->save($debitNote)) {
				$ledger = $this->DebitNotes->Ledgers->newEntity();
				$ledger->company_id=$st_company_id;
				$ledger->ledger_account_id = $debitNote->party_id;
				$ledger->debit = 0;
				$ledger->credit = $debitNote->amount;
				$ledger->voucher_id = $debitNote->id;
				$ledger->voucher_source = 'Debit Note';
				$ledger->transaction_date = $debitNote->transaction_date;
				$this->DebitNotes->Ledgers->save($ledger);
				//Ledger posting for bankcash
				$ledger = $this->DebitNotes->Ledgers->newEntity();
				$ledger->company_id=$st_company_id;
				$ledger->ledger_account_id = $debitNote->sales_acc_id;
				$ledger->debit =  $debitNote->amount;
				$ledger->credit = 0;
				$ledger->voucher_id = $debitNote->id;
				$ledger->voucher_source = 'Debit Note';
				$ledger->transaction_date = $debitNote->transaction_date;
				$this->DebitNotes->Ledgers->save($ledger);
				$this->Flash->success(__('The Debit Notes:'.str_pad($debitNote->voucher_no, 4, '0', STR_PAD_LEFT)).' has been genereted.');
				return $this->redirect(['action' => 'view/'.$debitNote->id]);
            } else {
                $this->Flash->error(__('The debit note could not be saved. Please, try again.'));
            }
        }
		$vr=$this->DebitNotes->VouchersReferences->find()->where(['company_id'=>$st_company_id,'module'=>'Debit Notes','sub_entity'=>'Customer-Suppiler'])->first();
		
		
		$DebitNotesSalesAccount=$vr->id;
		$vouchersReferences = $this->DebitNotes->VouchersReferences->get($vr->id, [
            'contain' => ['VoucherLedgerAccounts']
        ]);
		
		$where=[];
		foreach($vouchersReferences->voucher_ledger_accounts as $data){
			$where[]=$data->ledger_account_id;
		}
		if(sizeof($where)>0){
			$salesAccs = $this->DebitNotes->SalesAccs->find('list',
				['keyField' => function ($row) {
					return $row['id'];
				},
				'valueField' => function ($row) {
					if(!empty($row['alias'])){
						return  $row['name'] . ' (' . $row['alias'] . ')';
					}else{
						return $row['name'];
					}
					
				}])->where(['SalesAccs.id IN' => $where]);
		}
		else{
			$ErrorsalesAccs='true';
		}
		
		$vr=$this->DebitNotes->VouchersReferences->find()->where(['company_id'=>$st_company_id,'module'=>'Debit Notes','sub_entity'=>'Headers'])->first();	
		$DebitNotesParty=$vr->id;
		$vouchersReferences = $this->DebitNotes->VouchersReferences->get($vr->id, [
            'contain' => ['VoucherLedgerAccounts']
        ]);
		$where=[];
		foreach($vouchersReferences->voucher_ledger_accounts as $data){
			  $where[]=$data->ledger_account_id;
		
		}
		if(sizeof($where)>0){
			$parties = $this->DebitNotes->Parties->find('list',
				['keyField' => function ($row) {
					return $row['id'];
				},
				'valueField' => function ($row) {
					if(!empty($row['alias'])){
						return  $row['name'] . ' (' . $row['alias'] . ')';
					}else{
						return $row['name'];
					}
					
				}])->where(['Parties.id IN' => $where]);
		
		}
		else{
			$Errorparties='true';
		}
		
		
		$companies = $this->DebitNotes->Companies->find('all');
        $this->set(compact('debitNote', 'salesAccs', 'parties', 'companies','ErrorsalesAccs','Errorparties','financial_year','DebitNotesParty','DebitNotesSalesAccount'));
        $this->set('_serialize', ['debitNote']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Debit Note id.
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
		$financial_year = $this->DebitNotes->FinancialYears->find()->where(['id'=>$st_year_id])->first();
    
        $debitNote = $this->DebitNotes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $debitNote = $this->DebitNotes->patchEntity($debitNote, $this->request->data);
			$debitNote->edited_by=$s_employee_id;
			$debitNote->transaction_date=date("Y-m-d",strtotime($debitNote->transaction_date));
			$debitNote->edited_on=date("Y-m-d");
			$debitNote->company_id=$st_company_id;
			
            if ($this->DebitNotes->save($debitNote)) {
				
				$this->DebitNotes->Ledgers->deleteAll(['voucher_id' => $debitNote->id, 'voucher_source' => 'Debit Note']);
				
				$ledger = $this->DebitNotes->Ledgers->newEntity();
				$ledger->company_id=$st_company_id;
				$ledger->ledger_account_id = $debitNote->party_id;
				$ledger->debit = 0;
				$ledger->credit = $debitNote->amount;
				$ledger->voucher_id = $debitNote->id;
				$ledger->voucher_source = 'Debit Note';
				$ledger->transaction_date = $debitNote->transaction_date;
				$this->DebitNotes->Ledgers->save($ledger);
				//Ledger posting for bankcash
				$ledger = $this->DebitNotes->Ledgers->newEntity();
				$ledger->company_id=$st_company_id;
				$ledger->ledger_account_id = $debitNote->sales_acc_id;
				$ledger->debit =  $debitNote->amount;
				$ledger->credit = 0;
				$ledger->voucher_id = $debitNote->id;
				$ledger->voucher_source = 'Debit Note';
				$ledger->transaction_date = $debitNote->transaction_date;
				$this->DebitNotes->Ledgers->save($ledger);
                $this->Flash->success(__('The debit note has been saved.'));
				return $this->redirect(['action' => 'view/'.$debitNote->id]);
            } else {
                $this->Flash->error(__('The debit note could not be saved. Please, try again.'));
            }
        }
        
		$vr=$this->DebitNotes->VouchersReferences->find()->where(['company_id'=>$st_company_id,'module'=>'Debit Notes Voucher','sub_entity'=>'Sales Account'])->first();	
		$vouchersReferences = $this->DebitNotes->VouchersReferences->get($vr->id, [
            'contain' => ['VoucherLedgerAccounts']
        ]);
		
		$where=[];
		foreach($vouchersReferences->voucher_ledger_accounts as $data){
			$where[]=$data->ledger_account_id;
		}

		$salesAccs = $this->DebitNotes->SalesAccs->find('list',
				['keyField' => function ($row) {
					return $row['id'];
				},
				'valueField' => function ($row) {
					if(!empty($row['alias'])){
						return  $row['name'] . ' (' . $row['alias'] . ')';
					}else{
						return $row['name'];
					}
					
				}])->where(['SalesAccs.id IN' => $where]);
		
		$vr=$this->DebitNotes->VouchersReferences->find()->where(['company_id'=>$st_company_id,'module'=>'Debit Notes Voucher','sub_entity'=>'Party'])->first();			
		$vouchersReferences = $this->DebitNotes->VouchersReferences->get($vr->id, [
            'contain' => ['VoucherLedgerAccounts']
        ]);
		$where=[];
		foreach($vouchersReferences->voucher_ledger_accounts as $data){
			  $where[]=$data->ledger_account_id;
		
		}

		$parties = $this->DebitNotes->Parties->find('list',
				['keyField' => function ($row) {
					return $row['id'];
				},
				'valueField' => function ($row) {
					if(!empty($row['alias'])){
						return  $row['name'] . ' (' . $row['alias'] . ')';
					}else{
						return $row['name'];
					}
					
				}])->where(['Parties.id IN' => $where]);
		
		$companies = $this->DebitNotes->Companies->find('all');
        $this->set(compact('debitNote', 'salesAccs', 'parties', 'companies','financial_year'));
        $this->set('_serialize', ['debitNote']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Debit Note id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $debitNote = $this->DebitNotes->get($id);
        if ($this->DebitNotes->delete($debitNote)) {
            $this->Flash->success(__('The debit note has been deleted.'));
        } else {
            $this->Flash->error(__('The debit note could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	public function fetchReferenceNo($ledger_account_id=null)
    {
		$this->viewBuilder()->layout('ajax_layout');
	
		$ReferenceBalances=$this->DebitNotes->ReferenceBalances->find()->where(['ledger_account_id' => $ledger_account_id])->toArray();
		
		$this->set(compact(['ReferenceBalances']));
	}
}
