<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CreditNotes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $SalesAccs
 * @property \Cake\ORM\Association\BelongsTo $Parties
 * @property \Cake\ORM\Association\BelongsTo $Companies
 *
 * @method \App\Model\Entity\CreditNote get($primaryKey, $options = [])
 * @method \App\Model\Entity\CreditNote newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CreditNote[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CreditNote|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CreditNote patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CreditNote[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CreditNote findOrCreate($search, callable $callback = null)
 */
class CreditNotesTable extends Table
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

        $this->table('credit_notes');
        $this->displayField('id');
        $this->primaryKey('id');$this->belongsTo('Ledgers');
		$this->belongsTo('VouchersReferences');
		$this->belongsTo('FinancialYears');
		$this->belongsTo('Challans');
		
		$this->belongsTo('PurchaseAccs', [
			'className' => 'LedgerAccounts',
            'foreignKey' => 'purchase_acc_id',
            'propertyName' => 'PurchaseAccs',
        ]);
		$this->belongsTo('Parties', [
			'className' => 'LedgerAccounts',
            'foreignKey' => 'party_id',
            'propertyName' => 'Parties',
        ]);
        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER'
        ]);
		
		$this->belongsTo('Creator', [
			'className' => 'Employees',
			'foreignKey' => 'created_by',
			'propertyName' => 'creator',
		]);
		$this->belongsTo('ReferenceDetails');
		$this->belongsTo('ReferenceBalances');
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

        $validator
            
            ->requirePresence('purchase_acc_id')
            ->notEmpty('purchase_acc_id');

        $validator
            ->requirePresence('party_id', 'create')
            ->notEmpty('party_id');

        $validator
            ->requirePresence('payment_mode', 'create')
            ->notEmpty('payment_mode');

        $validator
            ->requirePresence('narration', 'create')
            ->notEmpty('narration');

        $validator
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

        $validator
            ->integer('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
   
}
