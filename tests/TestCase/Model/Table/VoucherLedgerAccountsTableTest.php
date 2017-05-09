<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VoucherLedgerAccountsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VoucherLedgerAccountsTable Test Case
 */
class VoucherLedgerAccountsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VoucherLedgerAccountsTable
     */
    public $VoucherLedgerAccounts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.voucher_ledger_accounts',
        'app.vouchers_references',
        'app.account_groups',
        'app.account_categories',
        'app.account_first_subgroups',
        'app.account_second_subgroups',
        'app.ledger_accounts',
        'app.customers',
        'app.districts',
        'app.company_groups',
        'app.companies',
        'app.item_used_by_companies',
        'app.company_banks',
        'app.quotations',
        'app.employees',
        'app.departments',
        'app.designations',
        'app.employee_contact_persons',
        'app.sales_orders',
        'app.filenames',
        'app.invoices',
        'app.customer_groups',
        'app.item_ledgers',
        'app.items',
        'app.item_categories',
        'app.item_groups',
        'app.item_sub_groups',
        'app.units',
        'app.sources',
        'app.item_sources',
        'app.item_companies',
        'app.invoice_rows',
        'app.quotation_rows',
        'app.sales_order_rows',
        'app.sale_taxes',
        'app.ledgers',
        'app.terms_conditions',
        'app.transporters',
        'app.customer_address',
        'app.creator',
        'app.employee_companies',
        'app.account_references',
        'app.carrier',
        'app.courier',
        'app.tax_details',
        'app.editor',
        'app.quotation_close_reasons',
        'app.customer_contacts',
        'app.email_records',
        'app.customer_segs',
        'app.vouchers_ledger_accounts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('VoucherLedgerAccounts') ? [] : ['className' => 'App\Model\Table\VoucherLedgerAccountsTable'];
        $this->VoucherLedgerAccounts = TableRegistry::get('VoucherLedgerAccounts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VoucherLedgerAccounts);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
