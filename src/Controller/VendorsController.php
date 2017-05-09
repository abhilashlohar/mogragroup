<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Vendors Controller
 *
 * @property \App\Model\Table\VendorsTable $Vendors
 */
class VendorsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		$this->viewBuilder()->layout('index_layout');
        $vendors = $this->paginate($this->Vendors->find()->order(['Vendors.company_name' => 'ASC']));

        $this->set(compact('vendors'));
        $this->set('_serialize', ['vendors']);
    }

    /**
     * View method
     *
     * @param string|null $id Vendor id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vendor = $this->Vendors->get($id, [
            'contain' => []
        ]);

        $this->set('vendor', $vendor);
        $this->set('_serialize', ['vendor']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('index_layout');
        $vendor = $this->Vendors->newEntity();
        if ($this->request->is('post')) {
            $vendor = $this->Vendors->patchEntity($vendor, $this->request->data);
			//pr($vendor); exit;	
			
            if ($this->Vendors->save($vendor))
			{
				
				foreach($vendor->companies as $data)
				{
					$ledgerAccount = $this->Vendors->LedgerAccounts->newEntity();
					$ledgerAccount->account_second_subgroup_id = $vendor->account_second_subgroup_id;
					$ledgerAccount->name = $vendor->company_name;
					$ledgerAccount->source_model = 'Vendors';
					$ledgerAccount->source_id = $vendor->id;
					$ledgerAccount->company_id = $data->id;
					$this->Vendors->LedgerAccounts->save($ledgerAccount);
				} 
				$this->Flash->success(__('The Vendor has been saved.'));
					return $this->redirect(['action' => 'index']);
				
				
            } else 
				{
					$this->Flash->error(__('The vendor could not be saved. Please, try again.'));
				}
        }
		$ItemGroups = $this->Vendors->ItemGroups->find('list');
		$AccountCategories = $this->Vendors->AccountCategories->find('list');
		$Companies = $this->Vendors->Companies->find('list');
        
        $this->set(compact('vendor','ItemGroups','AccountCategories','Companies'));
        $this->set('_serialize', ['vendor']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Vendor id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $vendor = $this->Vendors->get($id, [
            'contain' => ['VendorContactPersons']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vendor = $this->Vendors->patchEntity($vendor, $this->request->data);
			//pr($vendor); exit;	
            if ($this->Vendors->save($vendor)) {
				$query = $this->Vendors->LedgerAccounts->query();
					$query->update()
						->set(['account_second_subgroup_id' => $vendor->account_second_subgroup_id])
						->where(['id' => $vendor->ledger_account_id])
						->execute();
                $this->Flash->success(__('The vendor has been saved.'));
				return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The vendor could not be saved. Please, try again.'));
            }
        }
		$ItemGroups = $this->Vendors->ItemGroups->find('list');
		$AccountCategories = $this->Vendors->AccountCategories->find('list');
		$AccountGroups = $this->Vendors->AccountGroups->find('list');
		$AccountFirstSubgroups = $this->Vendors->AccountFirstSubgroups->find('list');
		$AccountSecondSubgroups = $this->Vendors->AccountSecondSubgroups->find('list');
		
        $this->set(compact('vendor','ItemGroups','AccountCategories','AccountGroups','AccountFirstSubgroups','AccountSecondSubgroups'));
        $this->set('_serialize', ['vendor']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Vendor id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vendor = $this->Vendors->get($id);
        if ($this->Vendors->delete($vendor)) {
            $this->Flash->success(__('The vendor has been deleted.'));
        } else {
            $this->Flash->error(__('The vendor could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function EditCompany($vendor_id=null)
    {
		$this->viewBuilder()->layout('index_layout');	
		$Companies = $this->Vendors->Companies->find();
		$Company_array=[];
		$Company_array1=[];
		$Company_array2=[];
		foreach($Companies as $Company){
			$employee_Company_exist= $this->Vendors->VendorCompanies->exists(['vendor_id' => $vendor_id,'company_id'=>$Company->id]);
			if($employee_Company_exist){
				$bill_to_bill_account= $this->Vendors->LedgerAccounts->find()->where(['source_model'=>'Vendors','source_id' => $vendor_id,'company_id'=>$Company->id])->first();

				$Company_array[$Company->id]='Yes';
				$Company_array1[$Company->id]=$Company->name;
				$Company_array2[$Company->id]=$bill_to_bill_account->bill_to_bill_account;
				
			}else{
				$Company_array[$Company->id]='No';
				$Company_array1[$Company->id]=$Company->name;
				$Company_array2[$Company->id]='No';
			}
		}

		$vendor_data= $this->Vendors->get($vendor_id);
		$this->set(compact('vendor_data','Companies','customer_Company','Company_array','vendor_id','Company_array1','Company_array2'));

	}
	
	public function AddCompany($company_id=null,$vendor_id=null)
    {
		$this->viewBuilder()->layout('index_layout');	
		//pr($company_id); 
		
		$EmployeeCompany = $this->Vendors->VendorCompanies->newEntity();
		$EmployeeCompany->company_id=$company_id;
		$EmployeeCompany->vendor_id=$vendor_id;
		
		$this->Vendors->VendorCompanies->save($EmployeeCompany);

		$vendor_details= $this->Vendors->get($vendor_id);
		//pr($vendor_details); exit;
		$ledgerAccount = $this->Vendors->LedgerAccounts->newEntity();
		$ledgerAccount->account_second_subgroup_id = $vendor_details->account_second_subgroup_id;
		$ledgerAccount->name = $vendor_details->company_name;
		//$ledgerAccount->alias = $employee_details->alias;
		$ledgerAccount->bill_to_bill_account = 'Yes';
		$ledgerAccount->source_model = 'Vendors';
		$ledgerAccount->source_id = $vendor_details->id;
		$ledgerAccount->company_id = $company_id;
		//pr($ledgerAccount); exit;
		$this->Vendors->LedgerAccounts->save($ledgerAccount);
		
		return $this->redirect(['action' => 'EditCompany/'.$vendor_id]);
	}
	
	public function CheckCompany($company_id=null,$vendor_id=null)
    {
		$this->viewBuilder()->layout('index_layout');	
		 $this->request->allowMethod(['post', 'delete']);
		$employees_ledger= $this->Vendors->LedgerAccounts->find()->where(['source_model' => 'Vendors','source_id'=>$vendor_id,'company_id'=>$company_id])->first();

		$ledgerexist = $this->Vendors->Ledgers->exists(['ledger_account_id' => $employees_ledger->id]);

		if(!$ledgerexist){
			$customer_Company_dlt= $this->Vendors->VendorCompanies->find()->where(['VendorCompanies.vendor_id'=>$vendor_id,'company_id'=>$company_id])->first();
			$customer_ledger_dlt= $this->Vendors->LedgerAccounts->find()->where(['source_model' => 'Vendors','source_id'=>$vendor_id,'company_id'=>$company_id])->first();
			$VoucherLedgerAccountsexist = $this->Vendors->VoucherLedgerAccounts->exists(['ledger_account_id' => $employees_ledger->id]);
			if($VoucherLedgerAccountsexist){
				$Voucherref = $this->Vendors->VouchersReferences->find()->contain(['VoucherLedgerAccounts'])->where(['VouchersReferences.company_id'=>$company_id]);
				foreach($Voucherref as $Voucherref){
					foreach($Voucherref->voucher_ledger_accounts as $voucher_ledger_account){
							if($voucher_ledger_account->ledger_account_id==$employees_ledger->id){
								$this->Vendors->VoucherLedgerAccounts->delete($voucher_ledger_account);
							}
					}
					
				}
				
			}

			$this->Vendors->VendorCompanies->delete($customer_Company_dlt);
			$this->Vendors->LedgerAccounts->delete($customer_ledger_dlt);
			return $this->redirect(['action' => 'EditCompany/'.$vendor_id]);
				
		}else{
			$this->Flash->error(__('Company Can not Deleted'));
			return $this->redirect(['action' => 'EditCompany/'.$vendor_id]);
		}
	}
	public function BillToBill($company_id=null,$vendor_id=null,$bill_to_bill_account=null)
	{

	
		$query2 = $this->Vendors->LedgerAccounts->query();
		//pr(['source_model' => 'Vendors','source_id'=>$vendor_id,'company_id'=>$company_id]); 
		//pr(['bill_to_bill_account' => $bill_to_bill_account]); exit;
		$query2->update()
			->set(['bill_to_bill_account' => $bill_to_bill_account])
			->where(['source_model' => 'Vendors','source_id'=>$vendor_id,'company_id'=>$company_id])
			->execute();
			
		return $this->redirect(['action' => 'EditCompany/'.$vendor_id]);
	}
}
