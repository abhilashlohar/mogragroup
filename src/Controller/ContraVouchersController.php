<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ContraVouchers Controller
 *
 * @property \App\Model\Table\ContraVouchersTable $ContraVouchers
 */
class ContraVouchersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['BankCashes', 'Companies']
        ];
        $contraVouchers = $this->paginate($this->ContraVouchers);

        $this->set(compact('contraVouchers'));
        $this->set('_serialize', ['contraVouchers']);
    }

    /**
     * View method
     *
     * @param string|null $id Contra Voucher id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contraVoucher = $this->ContraVouchers->get($id, [
            'contain' => ['BankCashes', 'Companies', 'ContraVoucherRows']
        ]);

        $this->set('contraVoucher', $contraVoucher);
        $this->set('_serialize', ['contraVoucher']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contraVoucher = $this->ContraVouchers->newEntity();
        if ($this->request->is('post')) {
            $contraVoucher = $this->ContraVouchers->patchEntity($contraVoucher, $this->request->data);
            if ($this->ContraVouchers->save($contraVoucher)) {
                $this->Flash->success(__('The contra voucher has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The contra voucher could not be saved. Please, try again.'));
            }
        }
        $bankCashes = $this->ContraVouchers->BankCashes->find('list', ['limit' => 200]);
        $companies = $this->ContraVouchers->Companies->find('list', ['limit' => 200]);
        $this->set(compact('contraVoucher', 'bankCashes', 'companies'));
        $this->set('_serialize', ['contraVoucher']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Contra Voucher id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contraVoucher = $this->ContraVouchers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contraVoucher = $this->ContraVouchers->patchEntity($contraVoucher, $this->request->data);
            if ($this->ContraVouchers->save($contraVoucher)) {
                $this->Flash->success(__('The contra voucher has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The contra voucher could not be saved. Please, try again.'));
            }
        }
        $bankCashes = $this->ContraVouchers->BankCashes->find('list', ['limit' => 200]);
        $companies = $this->ContraVouchers->Companies->find('list', ['limit' => 200]);
        $this->set(compact('contraVoucher', 'bankCashes', 'companies'));
        $this->set('_serialize', ['contraVoucher']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Contra Voucher id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contraVoucher = $this->ContraVouchers->get($id);
        if ($this->ContraVouchers->delete($contraVoucher)) {
            $this->Flash->success(__('The contra voucher has been deleted.'));
        } else {
            $this->Flash->error(__('The contra voucher could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
