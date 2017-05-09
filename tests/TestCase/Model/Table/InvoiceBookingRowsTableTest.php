<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InvoiceBookingRowsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InvoiceBookingRowsTable Test Case
 */
class InvoiceBookingRowsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InvoiceBookingRowsTable
     */
    public $InvoiceBookingRows;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.invoice_booking_rows',
        'app.invoice_bookings',
        'app.grns',
        'app.purchase_order_rows',
        'app.purchase_orders',
        'app.companies',
        'app.company_groups',
        'app.customers',
        'app.ledger_accounts',
        'app.account_second_subgroups',
        'app.account_first_subgroups',
        'app.account_groups',
        'app.account_categories',
        'app.ledgers',
        'app.districts',
        'app.customer_groups',
        'app.customer_segs',
        'app.employees',
        'app.departments',
        'app.designations',
        'app.employee_contact_persons',
        'app.quotations',
        'app.creator',
        'app.sales_orders',
        'app.filenames',
        'app.invoices',
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
        'app.terms_conditions',
        'app.transporters',
        'app.customer_address',
        'app.company_banks',
        'app.account_references',
        'app.carrier',
        'app.courier',
        'app.tax_details',
        'app.editor',
        'app.employee_companies',
        'app.quotation_close_reasons',
        'app.customer_contacts',
        'app.email_records',
        'app.item_used_by_companies',
        'app.vendors',
        'app.vendor_contact_persons',
        'app.item_ledgers',
        'app.grn_rows'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('InvoiceBookingRows') ? [] : ['className' => 'App\Model\Table\InvoiceBookingRowsTable'];
        $this->InvoiceBookingRows = TableRegistry::get('InvoiceBookingRows', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->InvoiceBookingRows);

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
