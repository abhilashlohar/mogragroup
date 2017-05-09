<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CustomerCompaniesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CustomerCompaniesTable Test Case
 */
class CustomerCompaniesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CustomerCompaniesTable
     */
    public $CustomerCompanies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.customer_companies',
        'app.customers',
        'app.ledger_accounts',
        'app.account_second_subgroups',
        'app.account_first_subgroups',
        'app.account_groups',
        'app.account_categories',
        'app.ledgers',
        'app.reference_details',
        'app.reference_balances',
        'app.districts',
        'app.company_groups',
        'app.companies',
        'app.item_used_by_companies',
        'app.company_banks',
        'app.quotations',
        'app.financial_years',
        'app.financial_months',
        'app.receipt_vouchers',
        'app.vouchers_references',
        'app.voucher_ledger_accounts',
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
        'app.item_serialnumbers',
        'app.grns',
        'app.purchase_order_rows',
        'app.purchase_orders',
        'app.filenames',
        'app.sales_orders',
        'app.carrier',
        'app.customer_address',
        'app.transporters',
        'app.courier',
        'app.terms_conditions',
        'app.tax_details',
        'app.employees',
        'app.departments',
        'app.designations',
        'app.employee_contact_persons',
        'app.employee_companies',
        'app.creator',
        'app.editor',
        'app.sales_order_rows',
        'app.sale_taxes',
        'app.sale_tax_companies',
        'app.job_card_rows',
        'app.job_cards',
        'app.inventory_voucher_rows',
        'app.inventory_vouchers',
        'app.item_serial_numbers',
        'app.material_indent_rows',
        'app.material_indents',
        'app.vendors',
        'app.vendor_contact_persons',
        'app.vendor_companies',
        'app.grn_rows',
        'app.invoice_bookings',
        'app.invoice_booking_rows',
        'app.account_references',
        'app.quotation_rows',
        'app.challans',
        'app.challan_rows',
        'app.invoice_breakups',
        'app.received_froms',
        'app.bank_cashes',
        'app.receipt_breakups',
        'app.quotation_close_reasons',
        'app.customer_contacts',
        'app.customer_segs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CustomerCompanies') ? [] : ['className' => 'App\Model\Table\CustomerCompaniesTable'];
        $this->CustomerCompanies = TableRegistry::get('CustomerCompanies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CustomerCompanies);

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
