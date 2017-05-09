<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CreditNotes Controller
 *
 * @property \App\Model\Table\CreditNotesTable $CreditNotes
 */
class CreditNotesController extends AppController
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
            'contain' => ['PurchaseAccs', 'Parties', 'Companies']
        ];
		
		$session = $this->request->session();
		$st_company_id = $session->read('st_company_id');
		
        $creditNotes = $this->paginate($this->CreditNotes->find()->where(['company_id'=>$st_company_id])->order(['transaction_date' => 'DESC']));

        $this->set(compact('creditNotes'));
        $this->set('_serialize', ['creditNotes']);
    }

    /**
     * View method
     *
     * @param string|null $id Credit Note id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $creditNote = $this->CreditNotes->get($id, [
            'contain' => ['PurchaseAccs', 'Parties', 'Companies','Creator']
        ]);

        $this->set('creditNote', $creditNote);
        $this->set('_serialize', ['creditNote']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
		
		$this->viewBuilder()->layout('index_layout');
		$challan_id=$this->request->query('Challan');
		//pr($challan_id); exit;
        $creditNote = $this->CreditNotes->newEntity();
		$s_employee_id=$this->viewVars['s_employee_id'];
		$session = $this->request->session();
		$st_company_id = $session->read('st_company_id');
        $st_year_id = $session->read('st_year_id');
		$financial_year = $this->CreditNotes->FinancialYears->find()->where(['id'=>$st_year_id])->first();
    
		 if ($this->request->is('post')) {
			 $total_row=sizeof($this->request->data['reference_no']);
			
			$last_ref_no=$this->CreditNotes->find()->select(['voucher_no'])->where(['company_id' => $st_company_id])->order(['voucher_no' => 'DESC'])->first();
			if($last_ref_no){
				$creditNote->voucher_no=$last_ref_no->voucher_no+1;
			}else{
				$creditNote->voucher_no=1;
			}
			$creditNote = $this->CreditNotes->patchEntity($creditNote, $this->request->data);
            $creditNote->created_by=$s_employee_id;
			$creditNote->transaction_date=date("Y-m-d",strtotime($creditNote->transaction_date));
			$creditNote->created_on=date("Y-m-d");
			$creditNote->company_id=$st_company_id;
			
			if ($this->CreditNotes->save($creditNote)) {
				$query = $this->CreditNotes->Challans->query();
					$query->update()
						->set(['pass_credit_note' => 'No'])
						->where(['id' => $challan_id])
						->execute();
				$ledger = $this->CreditNotes->Ledgers->newEntity();
				$ledger->company_id=$st_company_id;
				$ledger->ledger_account_id = $creditNote->purchase_acc_id;
				$ledger->debit = 0;
				$ledger->credit = $creditNote->amount;
				$ledger->voucher_id = $creditNote->id;
				$ledger->voucher_source = 'Credit Note';
				$ledger->transaction_date = $creditNote->transaction_date;
				$this->CreditNotes->Ledgers->save($ledger);
				//Ledger posting for bankcash
				$ledger = $this->CreditNotes->Ledgers->newEntity();
				$ledger->company_id=$st_company_id;
				$ledger->ledger_account_id = $creditNote->party_id;
				$ledger->debit =  $creditNote->amount;
				$ledger->credit = 0;
				$ledger->voucher_id = $creditNote->id;
				$ledger->voucher_source = 'Credit Note';
				$ledger->transaction_date = $creditNote->transaction_date;
				$this->CreditNotes->Ledgers->save($ledger);
				
				for($row=0; $row<$total_row; $row++)
				{
					////////////////  ReferenceDetails ////////////////////////////////
					$query1 = $this->CreditNotes->ReferenceDetails->query();
					
					$query1->insert(['reference_no', 'ledger_account_id', 'credit_note_id', 'debit', 'reference_type'])
					->values([
						'ledger_account_id' => $this->request->data['purchase_acc_id'],
						'credit_note_id' => $creditNote->id,
						'reference_no' => $this->request->data['reference_no'][$row],
						'debit' => $this->request->data['debit'][$row],
						'reference_type' => $this->request->data['reference_type'][$row]
					])
					->execute();
					
					////////////////  ReferenceBalances ////////////////////////////////
					if($this->request->data['reference_type'][$row]=='Against Reference')
					{
						
						$query2 = $this->CreditNotes->ReferenceBalances->query();
						
						$query2->update()
							->set(['debit' => $this->request->data['debit'][$row]])
							->where(['reference_no' => $this->request->data['reference_no'][$row],'ledger_account_id' => $this->request->data['purchase_acc_id']])
							->execute();
					}
					else
					{
						$query2 = $this->CreditNotes->ReferenceBalances->query();
						$query2->insert(['reference_no', 'ledger_account_id', 'debit'])
						->values([
							'reference_no' => $this->request->data['reference_no'][$row],
							'ledger_account_id' => $this->request->data['purchase_acc_id'],
							'debit' => $this->request->data['debit'][$row],
						])
						->execute();
					}
					
				}
			
				
				$this->Flash->success(__('The Credit Notes:'.str_pad($creditNote->voucher_no, 4, '0', STR_PAD_LEFT)).' has been genereted.');
				return $this->redirect(['action' => 'view/'.$creditNote->id]);
            } else {
                $this->Flash->error(__('The credit note could not be saved. Please, try again.'));
            }
        }
		$vr=$this->CreditNotes->VouchersReferences->find()->where(['company_id'=>$st_company_id,'module'=>'Credit Notes','sub_entity'=>'Purchase Account'])->first();
		$CreditNotesPurchaseAccount=$vr->id;
		$vouchersReferences = $this->CreditNotes->VouchersReferences->get($vr->id, [
            'contain' => ['VoucherLedgerAccounts']
        ]);
		
		$where=[];
		foreach($vouchersReferences->voucher_ledger_accounts as $data){
			  $where[]=$data->ledger_account_id;
		}
		if(sizeof($where)>0){
			$purchaseAccs = $this->CreditNotes->PurchaseAccs->find('list',
				['keyField' => function ($row) {
					return $row['id'];
				},
				'valueField' => function ($row) {
					if(!empty($row['alias'])){
						return  $row['name'] . ' (' . $row['alias'] . ')';
					}else{
						return $row['name'];
					}
					
				}])->where(['PurchaseAccs.id IN' => $where]);
		}else{
			$ErrorpurchaseAccs='true';
		}
		$vr=$this->CreditNotes->VouchersReferences->find()->where(['company_id'=>$st_company_id,'module'=>'Credit Notes','sub_entity'=>'Party'])->first();
		$CreditNotesParty=$vr->id;
		$vouchersReferences = $this->CreditNotes->VouchersReferences->get($vr->id, [
            'contain' => ['VoucherLedgerAccounts']
        ]);
		$where=[];
		foreach($vouchersReferences->voucher_ledger_accounts as $data){
			  $where[]=$data->ledger_account_id;
		}
		if(sizeof($where)>0){
			$parties = $this->CreditNotes->Parties->find('list',
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
		$companies = $this->CreditNotes->Companies->find('all');
        $this->set(compact('creditNote', 'purchaseAccs', 'parties', 'companies','ErrorpurchaseAccs','Errorparties','financial_year','CreditNotesPurchaseAccount','CreditNotesParty'));
        $this->set('_serialize', ['debitNote']);
 }

    /**
     * Edit method
     *
     * @param string|null $id Credit Note id.
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
		$financial_year = $this->CreditNotes->FinancialYears->find()->where(['id'=>$st_year_id])->first();
    
        $creditNote = $this->CreditNotes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $creditNote = $this->CreditNotes->patchEntity($creditNote, $this->request->data);
			$creditNote->edited_by=$s_employee_id;
			$creditNote->transaction_date=date("Y-m-d",strtotime($creditNote->transaction_date));
			$creditNote->edited_on=date("Y-m-d");
			$creditNote->company_id=$st_company_id;
			
            if ($this->CreditNotes->save($creditNote)) {
				
				$this->CreditNotes->Ledgers->deleteAll(['voucher_id' => $creditNote->id, 'voucher_source' => 'Credit Note']);
				
				$ledger = $this->CreditNotes->Ledgers->newEntity();
				$ledger->company_id=$st_company_id;
				$ledger->ledger_account_id = $creditNote->purchase_acc_id;
				$ledger->debit = 0;
				$ledger->credit = $creditNote->amount;
				$ledger->voucher_id = $creditNote->id;
				$ledger->voucher_source = 'Credit Note';
				$ledger->transaction_date = $creditNote->transaction_date;
				$this->CreditNotes->Ledgers->save($ledger);
				//Ledger posting for bankcash
				$ledger = $this->CreditNotes->Ledgers->newEntity();
				$ledger->company_id=$st_company_id;
				$ledger->ledger_account_id = $creditNote->party_id;
				$ledger->debit =  $creditNote->amount;
				$ledger->credit = 0;
				$ledger->voucher_id = $creditNote->id;
				$ledger->voucher_source = 'Credit Note';
				$ledger->transaction_date = $creditNote->transaction_date;
				$this->CreditNotes->Ledgers->save($ledger);
				
                $this->Flash->success(__('The credit note has been saved.'));
				return $this->redirect(['action' => 'view/'.$creditNote->id]);
            } else {
                $this->Flash->error(__('The credit note could not be saved. Please, try again.'));
            }
        } 
		$vr=$this->CreditNotes->VouchersReferences->find()->where(['company_id'=>$st_company_id,'module'=>'Credit Notes','sub_entity'=>'Purchase Account'])->first();
		$vouchersReferences = $this->CreditNotes->VouchersReferences->get($vr->id, [
            'contain' => ['VoucherLedgerAccounts']
        ]);
		
		$where=[];
		foreach($vouchersReferences->voucher_ledger_accounts as $data){
			  $where[]=$data->ledger_account_id;
		}

		$purchaseAccs = $this->CreditNotes->PurchaseAccs->find('list',
				['keyField' => function ($row) {
					return $row['id'];
				},
				'valueField' => function ($row) {
					if(!empty($row['alias'])){
						return  $row['name'] . ' (' . $row['alias'] . ')';
					}else{
						return $row['name'];
					}
					
				}])->where(['PurchaseAccs.id IN' => $where]);
		$vr=$this->CreditNotes->VouchersReferences->find()->where(['company_id'=>$st_company_id,'module'=>'Credit Notes','sub_entity'=>'Party'])->first();
		$vouchersReferences = $this->CreditNotes->VouchersReferences->get($vr->id, [
            'contain' => ['VoucherLedgerAccounts']
        ]);
		$where=[];
		foreach($vouchersReferences->voucher_ledger_accounts as $data){
			  $where[]=$data->ledger_account_id;
		}

		$parties = $this->CreditNotes->Parties->find('list',
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
		
		$companies = $this->CreditNotes->Companies->find('all');
        $this->set(compact('creditNote', 'purchaseAccs', 'parties', 'companies','financial_year'));
        $this->set('_serialize', ['debitNote']);
 
    }

    /**
     * Delete method
     *
     * @param string|null $id Credit Note id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $creditNote = $this->CreditNotes->get($id);
        if ($this->CreditNotes->delete($creditNote)) {
            $this->Flash->success(__('The credit note has been deleted.'));
        } else {
            $this->Flash->error(__('The credit note could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function fetchReferenceNo($ledger_account_id=null)
    {
		$this->viewBuilder()->layout('ajax_layout');
		
		//pr($ledger_account_id);
		$ReferenceDetails=$this->CreditNotes->ReferenceBalances->find()->where(['ledger_account_id' => $ledger_account_id])->toArray();
		
		$this->set(compact(['ReferenceDetails']));
	}
}
