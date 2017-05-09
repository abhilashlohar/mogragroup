<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ContraVouchers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $BankCashes
 * @property \Cake\ORM\Association\BelongsTo $Companies
 * @property \Cake\ORM\Association\HasMany $ContraVoucherRows
 *
 * @method \App\Model\Entity\ContraVoucher get($primaryKey, $options = [])
 * @method \App\Model\Entity\ContraVoucher newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ContraVoucher[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ContraVoucher|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ContraVoucher patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ContraVoucher[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ContraVoucher findOrCreate($search, callable $callback = null)
 */
class ContraVouchersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('contra_vouchers');
        $this->displayField('id');
        $this->primaryKey('id');

<<<<<<< HEAD
        $this->belongsTo('VouchersReferences');
        $this->belongsTo('FinancialYears');
        $this->belongsTo('ReferenceBalances');
        $this->belongsTo('ReferenceDetails');
        $this->belongsTo('Ledgers');
        $this->belongsTo('BankCashes', [
            'className' => 'LedgerAccounts',
            'foreignKey' => 'bank_cash_id',
            'propertyName' => 'BankCash',
        ]);
        
        $this->belongsTo('ReceivedFroms', [
            'className' => 'LedgerAccounts',
            'foreignKey' => 'received_from_id',
            'propertyName' => 'ReceivedFrom',
        ]);
        
        $this->belongsTo('Creator', [
            'className' => 'Employees',
            'foreignKey' => 'created_by',
            'propertyName' => 'creator',
        ]);
        
=======
        $this->belongsTo('BankCashes', [
            'foreignKey' => 'bank_cash_id',
            'joinType' => 'INNER'
        ]);
>>>>>>> origin/master
        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER'
        ]);
<<<<<<< HEAD
        
        $this->hasMany('ContraVoucherRows', [
            'foreignKey' => 'contra_voucher_id',
            'saveStrategy' => 'replace'
        ]);


=======
        $this->hasMany('ContraVoucherRows', [
            'foreignKey' => 'contra_voucher_id'
        ]);
>>>>>>> origin/master
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

<<<<<<< HEAD
=======
        $validator
            ->integer('voucher_no')
            ->requirePresence('voucher_no', 'create')
            ->notEmpty('voucher_no');

        $validator
            ->integer('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        $validator
            ->date('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');

>>>>>>> origin/master
        $validator
            ->integer('voucher_no')
            ->requirePresence('voucher_no', 'create')
            ->notEmpty('voucher_no');

        $validator
<<<<<<< HEAD
            ->integer('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        $validator
            ->date('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');

        $validator
            ->requirePresence('payment_mode', 'create')
            ->notEmpty('payment_mode');

      


=======
            ->date('transaction_date')
            ->requirePresence('transaction_date', 'create')
            ->notEmpty('transaction_date');

        $validator
            ->integer('edited_by')
            ->requirePresence('edited_by', 'create')
            ->notEmpty('edited_by');

        $validator
            ->date('edited_on')
            ->requirePresence('edited_on', 'create')
            ->notEmpty('edited_on');
>>>>>>> origin/master

        $validator
            ->requirePresence('cheque_no', 'create')
            ->notEmpty('cheque_no');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['bank_cash_id'], 'BankCashes'));
        $rules->add($rules->existsIn(['company_id'], 'Companies'));

        return $rules;
    }
}
