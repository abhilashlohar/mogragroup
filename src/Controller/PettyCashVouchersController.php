<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PettyCashVouchers Controller
 *
 * @property \App\Model\Table\PettyCashVouchersTable $PettyCashVouchers
 */
class PettyCashVouchersController extends AppController
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
            'contain' => []
        ];
        
        
        $pettycashvouchers = $this->paginate($this->PettyCashVouchers->find()->where(['company_id'=>$st_company_id])->contain(['PettyCashVoucherRows'=>function($q){
            $PettyCashVoucherRows = $this->PettyCashVouchers->PettyCashVoucherRows->find();
            $totalCrCase = $PettyCashVoucherRows->newExpr()
                ->addCase(
                    $PettyCashVoucherRows->newExpr()->add(['cr_dr' => 'Cr']),
                    $PettyCashVoucherRows->newExpr()->add(['amount']),
                    'integer'
                );
            $totalDrCase = $PettyCashVoucherRows->newExpr()
                ->addCase(
                    $PettyCashVoucherRows->newExpr()->add(['cr_dr' => 'Dr']),
                    $PettyCashVoucherRows->newExpr()->add(['amount']),
                    'integer'
                );
            return $PettyCashVoucherRows->select([
                    'total_cr' => $PettyCashVoucherRows->func()->sum($totalCrCase),
                    'total_dr' => $PettyCashVoucherRows->func()->sum($totalDrCase)
                ])
                ->group('petty_cash_voucher_id')
                
                ->autoFields(true);
            
        }])->order(['voucher_no'=>'DESC']));
        

        $this->set(compact('pettycashvouchers'));
        $this->set('_serialize', ['pettycashvouchers']);
    }

    /**
     * View method
     *
     * @param string|null $id Petty Cash Voucher id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->layout('index_layout');
        $pettycashvoucher = $this->PettyCashVouchers->get($id, [
            'contain' => ['BankCashes', 'Companies', 'PettyCashVoucherRows' => ['ReceivedFroms'], 'Creator']
        ]);

        $this->set('pettycashvoucher', $pettycashvoucher);
        $this->set('_serialize', ['pettycashvoucher']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->viewBuilder()->layout('index_layout');
        $s_employee_id=$this->viewVars['s_employee_id'];
        $session = $this->request->session();
        $st_company_id = $session->read('st_company_id');
        $st_year_id = $session->read('st_year_id');
        $financial_year = $this->PettyCashVouchers->FinancialYears->find()->where(['id'=>$st_year_id])->first();
        
        $pettycashvoucher = $this->PettyCashVouchers->newEntity();
        
        if ($this->request->is('post')) {
            $pettycashvoucher = $this->PettyCashVouchers->patchEntity($pettycashvoucher, $this->request->data);
            $pettycashvoucher->company_id=$st_company_id;
            //Voucher Number Increment
            $last_voucher_no=$this->PettyCashVouchers->find()->select(['voucher_no'])->where(['company_id' => $st_company_id])->order(['voucher_no' => 'DESC'])->first();
            if($last_voucher_no){
                $pettycashvoucher->voucher_no=$last_voucher_no->voucher_no+1;
            }else{
                $pettycashvoucher->voucher_no=1;
            }
            
            $pettycashvoucher->created_on=date("Y-m-d");
            $pettycashvoucher->created_by=$s_employee_id;
            $pettycashvoucher->transaction_date=date("Y-m-d",strtotime($pettycashvoucher->transaction_date));
            //pr($pettycashvoucher); exit;
            if ($this->PettyCashVouchers->save($pettycashvoucher)) {
                $total_cr=0; $total_dr=0;
                foreach($pettycashvoucher->petty_cash_voucher_rows as $petty_cash_voucher_row){
                    
                    //Ledger posting for Received From Entity
                    $ledger = $this->PettyCashVouchers->Ledgers->newEntity();
                    $ledger->company_id=$st_company_id;
                    $ledger->ledger_account_id = $petty_cash_voucher_row->received_from_id;
                    if($petty_cash_voucher_row->cr_dr=="Dr"){
                        $ledger->debit = $petty_cash_voucher_row->amount;
                        $ledger->credit = 0;
                        $total_dr=$total_dr+$petty_cash_voucher_row->amount;
                    }else{
                        $ledger->debit = 0;
                        $ledger->credit = $petty_cash_voucher_row->amount;
                        $total_cr=$total_cr+$petty_cash_voucher_row->amount;
                    }
                    
                    $ledger->voucher_id = $pettycashvoucher->id;
                    $ledger->voucher_source = 'Petty Cash Voucher';
                    $ledger->transaction_date = $pettycashvoucher->transaction_date;
                    $this->PettyCashVouchers->Ledgers->save($ledger);
                    
                    $total_amount=$total_dr-$total_cr;
                    
                    //Reference Number coding
                    if(sizeof(@$pettycashvoucher->ref_rows[$petty_cash_voucher_row->received_from_id])>0){
                        
                        foreach($pettycashvoucher->ref_rows[$petty_cash_voucher_row->received_from_id] as $ref_row){ 
                            $ref_row=(object)$ref_row;
                            if($ref_row->ref_type=='New Reference' or $ref_row->ref_type=='Advance Reference'){
                                $query = $this->PettyCashVouchers->ReferenceBalances->query();
                                if($petty_cash_voucher_row->cr_dr=="Dr"){
                                    $query->insert(['ledger_account_id', 'reference_no', 'credit', 'debit'])
                                    ->values([
                                        'ledger_account_id' => $petty_cash_voucher_row->received_from_id,
                                        'reference_no' => $ref_row->ref_no,
                                        'credit' => 0,
                                        'debit' => $ref_row->ref_amount
                                    ])
                                    ->execute();
                                }else{
                                    $query->insert(['ledger_account_id', 'reference_no', 'credit', 'debit'])
                                    ->values([
                                        'ledger_account_id' => $petty_cash_voucher_row->received_from_id,
                                        'reference_no' => $ref_row->ref_no,
                                        'credit' => $ref_row->ref_amount,
                                        'debit' => 0
                                    ])
                                    ->execute();
                                }
                                
                            }else{
                                $ReferenceBalance=$this->PettyCashVouchers->ReferenceBalances->find()->where(['ledger_account_id'=>$petty_cash_voucher_row->received_from_id,'reference_no'=>$ref_row->ref_no])->first();
                                $ReferenceBalance=$this->PettyCashVouchers->ReferenceBalances->get($ReferenceBalance->id);
                                if($petty_cash_voucher_row->cr_dr=="Dr"){
                                    $ReferenceBalance->debit=$ReferenceBalance->debit+$ref_row->ref_amount;
                                }else{
                                    $ReferenceBalance->credit=$ReferenceBalance->credit+$ref_row->ref_amount;
                                }
                                
                                $this->PettyCashVouchers->ReferenceBalances->save($ReferenceBalance);
                            }
                            
                            $query = $this->PettyCashVouchers->ReferenceDetails->query();
                            if($petty_cash_voucher_row->cr_dr=="Dr"){
                                $query->insert(['ledger_account_id', 'petty_cash_voucher_id', 'reference_no', 'credit', 'debit', 'reference_type'])
                                ->values([
                                    'ledger_account_id' => $payment_row->received_from_id,
                                    'petty_cash_voucher_id' => $pettycashvoucher->id,
                                    'reference_no' => $ref_row->ref_no,
                                    'credit' => 0,
                                    'debit' => $ref_row->ref_amount,
                                    'reference_type' => $ref_row->ref_type
                                ])
                                ->execute();
                            }else{
                                $query->insert(['ledger_account_id', 'petty_cash_voucher_id', 'reference_no', 'credit', 'debit', 'reference_type'])
                                ->values([
                                    'ledger_account_id' => $payment_row->received_from_id,
                                    'petty_cash_voucher_id' => $pettycashvoucher->id,
                                    'reference_no' => $ref_row->ref_no,
                                    'credit' => $ref_row->ref_amount,
                                    'debit' => 0,
                                    'reference_type' => $ref_row->ref_type
                                ])
                                ->execute();
                            }
                            
                        }
                    }
                }
                
                //Ledger posting for bankcash
                $ledger = $this->PettyCashVouchers->Ledgers->newEntity();
                $ledger->company_id=$st_company_id;
                $ledger->ledger_account_id = $pettycashvoucher->bank_cash_id;
                $ledger->debit = 0;
                $ledger->credit = $total_amount;
                $ledger->voucher_id = $pettycashvoucher->id;
                $ledger->voucher_source = 'Petty Cash Voucher';
                $ledger->transaction_date = $pettycashvoucher->transaction_date;
                $this->PettyCashVouchers->Ledgers->save($ledger);
                
                $this->Flash->success(__('The petty cash has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The petty cash could not be saved. Please, try again.'));
            }
        }
        $vr=$this->PettyCashVouchers->VouchersReferences->find()->where(['company_id'=>$st_company_id,'module'=>'Petty Cash Voucher','sub_entity'=>'Cash/Bank'])->first();
        $ReceiptVouchersCashBank=$vr->id;
        $vouchersReferences = $this->PettyCashVouchers->VouchersReferences->get($vr->id, [
            'contain' => ['VoucherLedgerAccounts']
        ]);
        $where=[];
        foreach($vouchersReferences->voucher_ledger_accounts as $data){
            $where[]=$data->ledger_account_id;
        }
        $BankCashes_selected='yes';
        if(sizeof($where)>0){
            $bankCashes = $this->PettyCashVouchers->BankCashes->find('list',
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
        }else{
            $BankCashes_selected='no';
        }
        //pr($bankCashes->toArray())    ; exit;
        
        $vr=$this->PettyCashVouchers->VouchersReferences->find()->where(['company_id'=>$st_company_id,'module'=>'Petty Cash Voucher','sub_entity'=>'Paid To'])->first();
        $ReceiptVouchersReceivedFrom=$vr->id;
        $vouchersReferences = $this->PettyCashVouchers->VouchersReferences->get($vr->id, [
            'contain' => ['VoucherLedgerAccounts']
        ]);
        $where=[];
        foreach($vouchersReferences->voucher_ledger_accounts as $data){
            $where[]=$data->ledger_account_id;
        }
        $ReceivedFroms_selected='yes';
        if(sizeof($where)>0){
            $receivedFroms = $this->PettyCashVouchers->ReceivedFroms->find('list',
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
        }else{
            $ReceivedFroms_selected='no';
        }
        $this->set(compact('pettycashvoucher', 'bankCashes', 'receivedFroms', 'financial_year', 'BankCashes_selected', 'ReceivedFroms_selected'));
        $this->set('_serialize', ['pettycashvoucher']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Petty Cash Voucher id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pettyCashVoucher = $this->PettyCashVouchers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pettyCashVoucher = $this->PettyCashVouchers->patchEntity($pettyCashVoucher, $this->request->data);
            if ($this->PettyCashVouchers->save($pettyCashVoucher)) {
                $this->Flash->success(__('The petty cash voucher has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The petty cash voucher could not be saved. Please, try again.'));
            }
        }
        $bankCashes = $this->PettyCashVouchers->BankCashes->find('list', ['limit' => 200]);
        $companies = $this->PettyCashVouchers->Companies->find('list', ['limit' => 200]);
        $this->set(compact('pettyCashVoucher', 'bankCashes', 'companies'));
        $this->set('_serialize', ['pettyCashVoucher']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Petty Cash Voucher id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pettyCashVoucher = $this->PettyCashVouchers->get($id);
        if ($this->PettyCashVouchers->delete($pettyCashVoucher)) {
            $this->Flash->success(__('The petty cash voucher has been deleted.'));
        } else {
            $this->Flash->error(__('The petty cash voucher could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
