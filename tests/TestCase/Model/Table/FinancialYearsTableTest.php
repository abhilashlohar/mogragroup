<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FinancialYearsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FinancialYearsTable Test Case
 */
class FinancialYearsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FinancialYearsTable
     */
    public $FinancialYears;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.financial_years',
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
        'app.vendors',
        'app.vendor_contact_persons',
        'app.transporters',
        'app.customer_address',
        'app.sale_taxes',
        'app.sales_order_rows',
        'app.job_card_rows',
        'app.job_cards',
        'app.inventory_voucher_rows',
        'app.inventory_vouchers',
        'app.item_serial_numbers',
        'app.grn_rows',
        'app.invoice_bookings',
        'app.invoice_booking_rows',
        'app.account_references',
        'app.quotation_rows',
        'app.challans',
        'app.challan_rows',
        'app.terms_conditions',
        'app.invoice_breakups',
        'app.receipt_vouchers',
        'app.vouchers_references',
        'app.voucher_ledger_accounts',
        'app.received_froms',
        'app.bank_cashes',
        'app.receipt_breakups',
        'app.carrier',
        'app.courier',
        'app.tax_details',
        'app.editor',
        'app.employee_companies',
        'app.quotation_close_reasons',
        'app.email_records',
        'app.customer_contacts',
        'app.item_used_by_companies',
        'app.company_banks'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('FinancialYears') ? [] : ['className' => 'App\Model\Table\FinancialYearsTable'];
        $this->FinancialYears = TableRegistry::get('FinancialYears', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FinancialYears);

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
