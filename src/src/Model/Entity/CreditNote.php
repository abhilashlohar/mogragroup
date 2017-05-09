<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CreditNote Entity
 *
 * @property int $id
 * @property \Cake\I18n\Time $created_on
 * @property \Cake\I18n\Time $transaction_date
 * @property int $sales_acc_id
 * @property string $payment_mode
 * @property int $party_id
 * @property string $narration
 * @property float $amount
 * @property int $company_id
 * @property int $created_by
 *
 * @property \App\Model\Entity\SalesAcc $sales_acc
 * @property \App\Model\Entity\Party $party
 * @property \App\Model\Entity\Company $company
 */
class CreditNote extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
