<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Ledgers Controller
 *
 * @property \App\Model\Table\LedgersTable $Ledgers
 */
class LedgersController extends AppController
{
	public $helpers = [
         'Paginator' => ['templates' => 'paginator-templates']
         ];

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($status=null)
    {
		$this->viewBuilder()->layout('index_layout');
		$where=[];
		$ledger=$this->request->query('ledger');
		$From=$this->request->query('From');
		$To=$this->request->query('To');
		
		$session = $this->request->session();
		$st_company_id = $session->read('st_company_id');
		
		$this->set(compact('ledger','From','To'));
		if(!empty($ledger)){
			$where['ledger_account_id']=$ledger;
		}
		if(!empty($From)){
			$From=date("Y-m-d",strtotime($this->request->query('From')));
			$where['transaction_date >=']=$From;
		}
		if(!empty($To)){
			$To=date("Y-m-d",strtotime($this->request->query('To')));
			$where['transaction_date <=']=$To;
		}
		$where['Ledgers.company_id']=$st_company_id;
        $this->paginate = [
            'contain' => ['LedgerAccounts']
        ];
        $ledgers = $this->paginate($this->Ledgers->find()->where($where)->order(['Ledgers.transaction_date' => 'DESC']));
		
        $ledgerAccounts = $this->Ledgers->LedgerAccounts->find('list');
        $this->set(compact('ledgers','ledgerAccounts'));
        $this->set('_serialize', ['ledgers']);
    }

    /**
     * View method
     *
     * @param string|null $id Ledger id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ledger = $this->Ledgers->get($id, [
            'contain' => ['LedgerAccounts']
        ]);

        $this->set('ledger', $ledger);
        $this->set('_serialize', ['ledger']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		
        $ledger = $this->Ledgers->newEntity();
        if ($this->request->is('post')) {
            $ledger = $this->Ledgers->patchEntity($ledger, $this->request->data);
            if ($this->Ledgers->save($ledger)) {
                $this->Flash->success(__('The ledger has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The ledger could not be saved. Please, try again.'));
            }
        }
        $ledgerAccounts = $this->Ledgers->LedgerAccounts->find('list', ['limit' => 200]);
        $this->set(compact('ledger', 'ledgerAccounts'));
        $this->set('_serialize', ['ledger']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Ledger id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $ledger = $this->Ledgers->newEntity();
		
		$session = $this->request->session();
		$company_id = $session->read('st_company_id');
        $ledger = $this->Ledgers->get($id, [
            'contain' => ['LedgerAccounts']
        ]);

		
		$ReferenceBalance=$this->Ledgers->ReferenceBalances->find()->where(['ledger_account_id'=>$ledger->ledger_account_id,'reference_no'=>$ledger->ref_no])->first();
		//pr($ReferenceBalance); exit;
		$ref_bal_diff=abs($ReferenceBalance->credit-$ReferenceBalance->debit);
		$ledger_diff=abs($ledger->credit-$ledger->debit);
		
		$allow='YES';
		if($ref_bal_diff!=$ledger_diff){
			$allow='NO';
		}
		
		if ($this->request->is(['patch', 'post', 'put'])) {
            $ledger = $this->Ledgers->patchEntity($ledger, $this->request->data);
				$old_ref_no=$ledger->getOriginal('ref_no');
			if ($this->Ledgers->save($ledger)) {
				
				//pr($old_ref_no); exit;
				$query2 = $this->Ledgers->ReferenceBalances->query();
				$query2->update()
				->set(['credit' => $ledger->credit,'debit' => $ledger->debit,'reference_no' => $ledger->ref_no])
				->where(['reference_no' => $old_ref_no,'ledger_account_id' => $ledger->ledger_account_id,])
				->execute();
				
				$query3 = $this->Ledgers->ReferenceDetails->query();
				$query3->update()
				->set(['credit' => $ledger->credit,'debit' => $ledger->debit,'reference_no' => $ledger->ref_no])
				->where(['reference_no' => $old_ref_no,'ledger_account_id' => $ledger->ledger_account_id,])
				->execute();
				
                $this->Flash->success(__('The ledger has been saved.'));

                return $this->redirect(['action' => 'opening-balance-view']);
            } else {
                $this->Flash->error(__('The ledger could not be saved. Please, try again.'));
            }
        }
        $ledgerAccounts = $this->Ledgers->LedgerAccounts->find('list', ['limit' => 200]);
        $this->set(compact('ledger', 'ledgerAccounts','allow'));
        $this->set('_serialize', ['ledger']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Ledger id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ledger = $this->Ledgers->get($id);
        if ($this->Ledgers->delete($ledger)) {
            $this->Flash->success(__('The ledger has been deleted.'));
        } else {
            $this->Flash->error(__('The ledger could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function openingBalance()
    {
		$this->viewBuilder()->layout('index_layout');
        $ledger = $this->Ledgers->newEntity();
		
		$session = $this->request->session();
		$company_id = $session->read('st_company_id');
		$st_year_id = $session->read('st_year_id');
		$financial_year = $this->Ledgers->FinancialYears->find()->where(['id'=>$st_year_id])->first();	
				
		if ($this->request->is('post')) {
			
			$total_row=sizeof($this->request->data['reference_no']);
			
			$Ledgersexists = $this->Ledgers->exists(['ledger_account_id' => $this->request->data['ledger_account_id'],'company_id'=>$company_id]);
			if($Ledgersexists){
				$this->Flash->error(__('Opening Balance already exists'));
				return $this->redirect(['action' => 'openingBalance']);
			}

			
		    for($row=0; $row<$total_row; $row++)
		    {
			 ////////////////  Ledger ////////////////////////////////
				$query = $this->Ledgers->query();
				$query->insert(['transaction_date', 'ledger_account_id', 'voucher_source', 'credit', 'debit','company_id','ref_no'])
				->values([
					'transaction_date' => date('Y-m-d', strtotime($this->request->data['transaction_date'])),
					'ledger_account_id' => $this->request->data['ledger_account_id'],
					'voucher_source' => $this->request->data['voucher_source'],
					'credit' => $this->request->data['credit'][$row],
					'debit' => $this->request->data['debit'][$row],
					'company_id' => $company_id,
					'ref_no' => $this->request->data['reference_no'][$row]
				])
				->execute();
			
				////////////////  ReferenceDetails ////////////////////////////////
				$query1 = $this->Ledgers->ReferenceDetails->query();
				$query1->insert(['reference_no', 'ledger_account_id', 'credit', 'debit', 'reference_type'])
				->values([
					'ledger_account_id' => $this->request->data['ledger_account_id'],
					'reference_no' => $this->request->data['reference_no'][$row],
					'credit' => $this->request->data['credit'][$row],
					'debit' => $this->request->data['debit'][$row],
					'reference_type' => 'New Reference'
				])
				->execute();
				
				////////////////  ReferenceBalances ////////////////////////////////
				$query2 = $this->Ledgers->ReferenceBalances->query();
				$query2->insert(['reference_no', 'ledger_account_id', 'credit', 'debit'])
				->values([
					'reference_no' => $this->request->data['reference_no'][$row],
					'ledger_account_id' => $this->request->data['ledger_account_id'],
					'credit' => $this->request->data['credit'][$row],
					'debit' => $this->request->data['debit'][$row]
				])
				->execute();
		   }
		   return $this->redirect(['action' => 'Opening_balance']);
        }
		
		
        $ledgerAccounts = $this->Ledgers->LedgerAccounts->find('list',
			['keyField' => function ($row) {
				return $row['id'];
			},
			'valueField' => function ($row) {
				if(!empty($row['alias'])){
					return  $row['name'] . ' (' . $row['alias'] . ')';
				}else{
					return $row['name'];
				}
				
			}])->where(['company_id'=>$company_id])->contain(['AccountSecondSubgroups'=>['AccountFirstSubgroups'=>['AccountGroups'=>['AccountCategories'=>function($q){
				return $q->where(['AccountCategories.id IN'=>[1,2]]);
			}]]]]);
        $this->set(compact('ledger', 'ledgerAccounts','financial_year'));
        $this->set('_serialize', ['ledger']);
    }
	
	
	
	public function checkReferenceNo()
    {
		$reference_no=$this->request->query['reference_no'][0];
		$ledger_account_id=$this->request->query['ledger_account_id'];
		
		$ReferenceDetails=$this->Ledgers->ReferenceBalances->find()
		->where(['reference_no' => $reference_no,'ledger_account_id' => $ledger_account_id])
		->count();
		
		if(empty($ReferenceDetails))
		{
			$output="true";
		}
		else
		{
			$output="false";
		}
		
		$this->response->body($output);
		return $this->response;
	}
	
	
	
	public function AccountStatement (){
		$this->viewBuilder()->layout('index_layout');
		
		$session = $this->request->session();
		$st_company_id = $session->read('st_company_id');
		
		$ledger_account_id=$this->request->query('ledger_account_id');
		if($ledger_account_id){
		$transaction_from_date= date('Y-m-d', strtotime($this->request->query['From']));
		$transaction_to_date= date('Y-m-d', strtotime($this->request->query['To']));
		
		
		$Ledger_Account_data = $this->Ledgers->LedgerAccounts->get($ledger_account_id, [
            'contain' => ['AccountSecondSubgroups'=>['AccountFirstSubgroups'=>['AccountGroups'=>['AccountCategories']]]]
        ]);
			
			
		$Ledgers_rows=$this->Ledgers->find()
		->contain(['LedgerAccounts'])
		->where(['ledger_account_id'=>$ledger_account_id])
		->where(function($exp) use($transaction_from_date,$transaction_to_date) {
			return $exp->between('transaction_date', $transaction_from_date, $transaction_to_date, 'date');
		})->order(['transaction_date'=>'ASC']);

		
		
		$query = $this->Ledgers->find();
		$total_balance=$query->select(['total_debit' => $query->func()->sum('debit'),'total_credit' => $query->func()->sum('credit')])->where(['Ledgers.ledger_account_id' => $ledger_account_id,'Ledgers.transaction_date <'=>$transaction_from_date])->toArray();

		$query = $this->Ledgers->find();
		$total_opening_balance=$query->select(['total_opening_debit' => $query->func()->sum('debit'),'total_opening_credit' => $query->func()->sum('credit')])->where(['Ledgers.ledger_account_id' => $ledger_account_id, 'Ledgers.voucher_source'=>'Opening Balance'])->where(function($exp) use($transaction_from_date,$transaction_to_date) {
			return $exp->between('transaction_date', $transaction_from_date, $transaction_to_date, 'date');
		})->toArray();
	}
		//pr($total_opening_balance); exit;
		$ledger=$this->Ledgers->LedgerAccounts->find('list',
				['keyField' => function ($row) {
					return $row['id'];
				},
				'valueField' => function ($row) {
					if(!empty($row['alias'])){
						return  $row['name'] . ' (' . $row['alias'] . ')';
					}else{
						return $row['name'];
					}
					
				}])->where(['company_id'=>$st_company_id]);

		$this->set(compact('ledger','Ledgers_rows','total_balance','ledger_account_id','transaction_from_date','transaction_to_date','Ledger_Account_data','total_opening_balance'));
	}
	
	
	public function openingBalanceView (){
		$this->viewBuilder()->layout('index_layout');
		$session = $this->request->session();
		$st_company_id = $session->read('st_company_id');
		$ledger_name=$this->request->query('ledger_name');
		
		$OpeningBalanceViews = $this->paginate($this->Ledgers->find()
		->contain(['LedgerAccounts'=>function($q) use($ledger_name){
			return $q->where(['LedgerAccounts.name LIKE'=>'%'.$ledger_name.'%']);
		}])
		->where(['Ledgers.company_id'=>$st_company_id,'Ledgers.voucher_source'=>'Opening Balance']));
		$this->set(compact('OpeningBalanceViews', 'ledger_name'));
	}
	
	
	
}
