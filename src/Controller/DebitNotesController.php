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
        $this->paginate = [
            'contain' => ['CustomerSuppilers', 'Companies']
        ];
        $debitNotes = $this->paginate($this->DebitNotes);

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
        $debitNote = $this->DebitNotes->get($id, [
            'contain' => ['CustomerSuppilers', 'Companies', 'DebitNotesRows']
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
			$debitNote = $this->DebitNotes->patchEntity($debitNote, $this->request->data);
			$debitNote->created_on=date("Y-m-d");
			$debitNote->transaction_date=date("Y-m-d");
			$debitNote->company_id=$st_company_id;
			$debitNote->created_by=$s_employee_id;
			$last_voucher_no=$this->DebitNotes->find()->select(['voucher_no'])->where(['company_id' => $st_company_id])->order(['voucher_no' => 'DESC'])->first();
			if($last_voucher_no){
				$debitNote->voucher_no=$last_voucher_no->voucher_no+1;
			}else{
				$debitNote->voucher_no=1;
			}
			//pr($debitNote);exit;
           if ($this->DebitNotes->save($debitNote)) {
				$total_cr=0; $total_dr=0;
				foreach($debitNote->debit_notes_rows as $debit_notes_row){

					$ledger = $this->DebitNotes->Ledgers->newEntity();
					$ledger->company_id=$st_company_id;
					$ledger->ledger_account_id = $debit_notes_row->head_id;
					$ledger->credit = $debit_notes_row->amount;
					$ledger->debit = 0;
					$ledger->voucher_id = $debitNote->id;
					$ledger->voucher_source = 'Debit Note';
					$ledger->transaction_date = $debitNote->transaction_date;
					$this->DebitNotes->Ledgers->save($ledger);
					
					$total_dr = $total_dr + $debit_notes_row->amount;
				}
				
				$ledger = $this->DebitNotes->Ledgers->newEntity();
				$ledger->company_id=$st_company_id;
				$ledger->ledger_account_id = $debitNote->customer_suppiler_id;
				$ledger->debit = $total_dr;
				$ledger->credit = 0;
				$ledger->voucher_id = $debitNote->id;
				$ledger->voucher_source = 'Debit Note';
				$ledger->transaction_date = $debitNote->transaction_date;
				$this->DebitNotes->Ledgers->save($ledger);
			}
			
			//pr($debitNote); exit;
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
			$customer_suppiler_id = $this->DebitNotes->CustomerSuppilers->find('list',
				['keyField' => function ($row) {
					return $row['id'];
				},
				'valueField' => function ($row) {
					if(!empty($row['alias'])){
						return  $row['name'] . ' (' . $row['alias'] . ')';
					}else{
						return $row['name'];
					}
					
				}])->where(['CustomerSuppilers.id IN' => $where]);
		}
		else{
			$ErrorsalesAccs='true';
		}
		
		
		
		$vr=$this->DebitNotes->VouchersReferences->find()->where(['company_id'=>$st_company_id,'module'=>'Debit Notes','sub_entity'=>'Heads'])->first();	
		$DebitNotesParty=$vr->id;
		$vouchersReferences = $this->DebitNotes->VouchersReferences->get($vr->id, [
            'contain' => ['VoucherLedgerAccounts']
        ]);
		$where=[];
		foreach($vouchersReferences->voucher_ledger_accounts as $data){
			  $where[]=$data->ledger_account_id;
		
		}
		if(sizeof($where)>0){
			$heads = $this->DebitNotes->Heads->find('list',
				['keyField' => function ($row) {
					return $row['id'];
				},
				'valueField' => function ($row) {
					if(!empty($row['alias'])){
						return  $row['name'] . ' (' . $row['alias'] . ')';
					}else{
						return $row['name'];
					}
					
				}])->where(['Heads.id IN' => $where]);
		
		}
		else{
			$Errorparties='true';
		}
		
		
		$companies = $this->DebitNotes->Companies->find('all');
        $this->set(compact('debitNote', 'customer_suppiler_id', 'heads', 'companies','ErrorsalesAccs','Errorparties','financial_year','DebitNotesParty','DebitNotesSalesAccount'));
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
        $debitNote = $this->DebitNotes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $debitNote = $this->DebitNotes->patchEntity($debitNote, $this->request->data);
            if ($this->DebitNotes->save($debitNote)) {
                $this->Flash->success(__('The debit note has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The debit note could not be saved. Please, try again.'));
            }
        }
        $customerSuppilers = $this->DebitNotes->CustomerSuppilers->find('list', ['limit' => 200]);
        $companies = $this->DebitNotes->Companies->find('list', ['limit' => 200]);
        $this->set(compact('debitNote', 'customerSuppilers', 'companies'));
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
}
