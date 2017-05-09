<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReceiptVouchersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReceiptVouchersTable Test Case
 */
class ReceiptVouchersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReceiptVouchersTable
     */
    public $ReceiptVouchers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.receipt_vouchers',
        'app.received_froms',
        'app.bank_cashes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ReceiptVouchers') ? [] : ['className' => 'App\Model\Table\ReceiptVouchersTable'];
        $this->ReceiptVouchers = TableRegistry::get('ReceiptVouchers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ReceiptVouchers);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
