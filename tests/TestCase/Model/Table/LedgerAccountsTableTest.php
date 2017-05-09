<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LedgerAccountsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LedgerAccountsTable Test Case
 */
class LedgerAccountsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LedgerAccountsTable
     */
    public $LedgerAccounts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ledger_accounts',
        'app.account_second_subgroups',
        'app.account_first_subgroups',
        'app.account_groups',
        'app.account_categories',
        'app.sources',
        'app.ledgers',
        'app.payment_vouchers',
        'app.vouchers_references',
        'app.vouchers_references_groups'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('LedgerAccounts') ? [] : ['className' => 'App\Model\Table\LedgerAccountsTable'];
        $this->LedgerAccounts = TableRegistry::get('LedgerAccounts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LedgerAccounts);

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
