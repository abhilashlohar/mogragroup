<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemSerialNumbersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemSerialNumbersTable Test Case
 */
class ItemSerialNumbersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemSerialNumbersTable
     */
    public $ItemSerialNumbers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.item_serial_numbers',
        'app.items',
        'app.item_categories',
        'app.item_groups',
        'app.item_sub_groups',
        'app.units',
        'app.sources',
        'app.item_sources',
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
        'app.item_ledgers',
        'app.terms_conditions',
        'app.sales_order_rows',
        'app.sale_taxes',
        'app.job_card_rows',
        'app.job_cards',
        'app.inventory_voucher_rows',
        'app.inventory_vouchers',
        'app.transporters',
        'app.customer_address',
        'app.invoice_rows',
        'app.company_banks',
        'app.account_references',
        'app.carrier',
        'app.courier',
        'app.tax_details',
        'app.editor',
        'app.employee_companies',
        'app.quotation_close_reasons',
        'app.email_records',
        'app.quotation_rows',
        'app.customer_contacts',
        'app.item_used_by_companies',
        'app.item_companies',
        'app.grns',
        'app.purchase_order_rows',
        'app.purchase_orders',
        'app.vendors',
        'app.vendor_contact_persons',
        'app.grn_rows',
        'app.invoice_bookings',
        'app.invoice_booking_rows'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ItemSerialNumbers') ? [] : ['className' => 'App\Model\Table\ItemSerialNumbersTable'];
        $this->ItemSerialNumbers = TableRegistry::get('ItemSerialNumbers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemSerialNumbers);

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
