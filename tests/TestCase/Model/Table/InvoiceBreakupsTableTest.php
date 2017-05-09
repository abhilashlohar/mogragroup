<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InvoiceBreakupsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InvoiceBreakupsTable Test Case
 */
class InvoiceBreakupsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InvoiceBreakupsTable
     */
    public $InvoiceBreakups;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.invoice_breakups',
        'app.invoices',
        'app.customer_groups',
        'app.customers',
        'app.ledger_accounts',
        'app.account_second_subgroups',
        'app.account_first_subgroups',
        'app.account_groups',
        'app.account_categories',
        'app.ledgers',
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
        'app.carrier',
        'app.customer_address',
        'app.transporters',
        'app.courier',
        'app.terms_conditions',
        'app.tax_details',
        'app.creator',
        'app.employee_companies',
        'app.editor',
        'app.sales_order_rows',
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
        'app.item_ledgers',
        'app.job_card_rows',
        'app.job_cards',
        'app.sale_taxes',
        'app.inventory_voucher_rows',
        'app.inventory_vouchers',
        'app.quotation_close_reasons',
        'app.email_records',
        'app.customer_contacts',
        'app.customer_segs',
        'app.receipt_vouchers',
        'app.vouchers_references',
        'app.voucher_ledger_accounts',
        'app.received_froms',
        'app.bank_cashes',
        'app.receipt_breakups',
        'app.account_references',
        'app.receipts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('InvoiceBreakups') ? [] : ['className' => 'App\Model\Table\InvoiceBreakupsTable'];
        $this->InvoiceBreakups = TableRegistry::get('InvoiceBreakups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->InvoiceBreakups);

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
