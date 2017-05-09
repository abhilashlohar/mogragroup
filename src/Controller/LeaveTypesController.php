<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * LeaveTypes Controller
 *
 * @property \App\Model\Table\LeaveTypesTable $LeaveTypes
 */
class LeaveTypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		
		$this->viewBuilder()->layout('index_layout');
		$leaveType = $this->LeaveTypes->newEntity();
        if ($this->request->is('post')) {
            $leaveType = $this->LeaveTypes->patchEntity($leaveType, $this->request->data);
            if ($this->LeaveTypes->save($leaveType)) {
                $this->Flash->success(__('The leave type has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The leave type could not be saved. Please, try again.'));
            }
        }
		
        $this->set(compact('leaveType'));
        $this->set('_serialize', ['transporter']);
		$leaveTypes = $this->paginate($this->LeaveTypes);
		$this->set(compact('leaveTypes'));
        $this->set('_serialize', ['leaveTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Leave Type id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $leaveType = $this->LeaveTypes->get($id, [
            'contain' => []
        ]);

        $this->set('leaveType', $leaveType);
        $this->set('_serialize', ['leaveType']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('index_layout');
        $leaveType = $this->LeaveTypes->newEntity();
        if ($this->request->is('post')) {
            $leaveType = $this->LeaveTypes->patchEntity($leaveType, $this->request->data);
            if ($this->LeaveTypes->save($leaveType)) {
                $this->Flash->success(__('The leave type has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The leave type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('leaveType'));
        $this->set('_serialize', ['leaveType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Leave Type id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $leaveType = $this->LeaveTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $leaveType = $this->LeaveTypes->patchEntity($leaveType, $this->request->data);
            if ($this->LeaveTypes->save($leaveType)) {
                $this->Flash->success(__('The leave type has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The leave type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('leaveType'));
        $this->set('_serialize', ['leaveType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Leave Type id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $this->request->allowMethod(['post', 'delete']);
        $leaveType = $this->LeaveTypes->get($id);
        if ($this->LeaveTypes->delete($leaveType)) {
            $this->Flash->success(__('The leave type has been deleted.'));
        } else {
            $this->Flash->error(__('The leave type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
