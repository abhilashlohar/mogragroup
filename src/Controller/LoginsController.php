<?php
namespace App\Controller;
use App\Controller\AppController;

class LoginsController extends AppController
{
	
	public function initialize()
	{
		parent::initialize();
		$this->eventManager()->off($this->Csrf);
	}
	public function index()
    {
       $this->viewBuilder()->layout('login_layout');
	   $number=2;
	   $login = $this->Logins->newEntity();
	   if ($this->request->is('post')) 
		{ 
			$username=$this->request->data["username"];
			$password=$this->request->data["password"];
			$query = $this->Logins->findAllByUsernameAndPassword($username, $password);
			$number = $query->count(); 
			
			foreach ($query as $row) {
				$login_id=$row["id"];
				$employee_id=$row["employee_id"];
			}
			
			if($number==1 && !empty($login_id)){
				$this->request->session()->write('st_login_id',$login_id);
				$Employee=$this->Logins->Employees->get($employee_id, [
					'contain' => ['Companies']
				]);
				
				$count=0;
				foreach($Employee->companies as $company){
					$count++;
				}
				if($count==1){
					foreach($Employee->companies as $company){
						$this->request->session()->write('st_company_id',$company->id);
						break;
					}
					return $this->redirect(['controller'=>'Financial-Years','action' => 'selectCompanyYear']);
				}
				else
				{
					return $this->redirect(['action' => 'Switch-Company']);
				}
			}
		}
		
		$this->set(compact('login','number'));
		$this->set('_serialize', ['login']);
    }
	
	public function logout()
	{
		$session = $this->request->session();
		$session->delete('st_login_id');
		return $this->redirect("/login");
	}
	
	public function add()
    {
		$this->viewBuilder()->layout('index_layout');
		$login = $this->Logins->newEntity();
		//pr ($login->employee_id); exit;
		
		
        if ($this->request->is('post')) {
            $login = $this->Logins->patchEntity($login, $this->request->data);
			$emp_id=$login->employee_id;
			$EmployeeIdExist = $this->Logins->exists(['employee_id' => $emp_id]);
		
			if(!$EmployeeIdExist)
				{
					if ($this->Logins->save($login)) {
						$this->Flash->success(__('Login has been saved.'));
					} else {
						$this->Flash->error(__('The Login could not be saved. Please, try again.'));
					}
				}
			else{
				$this->Flash->error(__('This user have already login.'));
				}
        }
		$employees = $this->Logins->Employees->find('list');
		$this->paginate = [
            'contain' => ['Employees']
        ];
		$Logins = $this->paginate($this->Logins);
        $this->set(compact('login','employees','Logins'));
        $this->set('_serialize', ['login']);
    }
	
	function SwitchCompany($company_id=null){
		$this->viewBuilder()->layout('login_layout');
		$session = $this->request->session();
		$st_login_id = $session->read('st_login_id');
		
		$login=$this->Logins->get($st_login_id);
		
		if(!empty($company_id)){ 
			$this->request->allowMethod(['post', 'delete']);
			$this->request->session()->write('st_company_id',$company_id);
			
			return $this->redirect(['controller'=>'FinancialYears','action' => 'selectCompanyYear']);
			
		}
		$Employee=$this->Logins->Employees->get($login->employee_id, [
						'contain' => ['Companies']
		]);
		$this->set(compact('st_login_id','Employee'));
	}

	public function delete($id=null){
			$this->request->allowMethod(['post', 'delete']);
		$this->Logins->UserRights->deleteAll(['login_id' => $id]);
		$login = $this->Logins->get($id);
			if ($this->Logins->delete($login)) {
				$this->Flash->success(__('The User Login  has been deleted.'));
			} else {
				$this->Flash->error(__('The User Login could not be deleted. Please, try again.'));
			}
			return $this->redirect(['controller'=>'Logins','action' => 'Add']);
	}
}

