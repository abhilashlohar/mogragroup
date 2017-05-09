<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PaymentVouchersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PaymentVouchersTable Test Case
 */
class PaymentVouchersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PaymentVouchersTable
     */
    public $PaymentVouchers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.payment_vouchers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PaymentVouchers') ? [] : ['className' => 'App\Model\Table\PaymentVouchersTable'];
        $this->PaymentVouchers = TableRegistry::get('PaymentVouchers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PaymentVouchers);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
