<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PettyCashReceiptVouchersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PettyCashReceiptVouchersTable Test Case
 */
class PettyCashReceiptVouchersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PettyCashReceiptVouchersTable
     */
    public $PettyCashReceiptVouchers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.petty_cash_receipt_vouchers',
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
        $config = TableRegistry::exists('PettyCashReceiptVouchers') ? [] : ['className' => 'App\Model\Table\PettyCashReceiptVouchersTable'];
        $this->PettyCashReceiptVouchers = TableRegistry::get('PettyCashReceiptVouchers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PettyCashReceiptVouchers);

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
