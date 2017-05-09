<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\JournalVoucherRowsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\JournalVoucherRowsTable Test Case
 */
class JournalVoucherRowsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\JournalVoucherRowsTable
     */
    public $JournalVoucherRows;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.journal_voucher_rows',
        'app.journal_vouchers',
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
        'app.carrier',
        'app.customer_address',
        'app.transporters',
        'app.courier',
        'app.terms_conditions',
        'app.tax_details',
        'app.creator',
        'app.invoices',
        'app.customer_groups',
        'app.item_ledger',
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
        'app.editor',
        'app.filenames',
        'app.quotation_close_reasons',
        'app.customer_segs',
        'app.customer_contacts',
        'app.ledgers',
        'app.vouchers_references_groups',
        'app.ledger1s',
        'app.ledger2s'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('JournalVoucherRows') ? [] : ['className' => 'App\Model\Table\JournalVoucherRowsTable'];
        $this->JournalVoucherRows = TableRegistry::get('JournalVoucherRows', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->JournalVoucherRows);

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
