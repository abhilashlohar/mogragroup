<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SaleReturnRowsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SaleReturnRowsTable Test Case
 */
class SaleReturnRowsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SaleReturnRowsTable
     */
    public $SaleReturnRows;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sale_return_rows',
        'app.sale_returns',
        'app.customers',
        'app.ledger_accounts',
        'app.account_second_subgroups',
        'app.account_first_subgroups',
        'app.account_groups',
        'app.account_categories',
        'app.ledgers',
        'app.reference_details',
        'app.receipt_vouchers',
        'app.vouchers_references',
        'app.voucher_ledger_accounts',
        'app.financial_years',
        'app.financial_months',
        'app.companies',
        'app.company_groups',
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
        'app.item_serialnumbers',
        'app.grns',
        'app.purchase_order_rows',
        'app.purchase_orders',
        'app.material_indent_rows',
        'app.material_indents',
        'app.creator',
        'app.employee_companies',
        'app.vendors',
        'app.vendor_contact_persons',
        'app.vendor_companies',
        'app.transporters',
        'app.customer_address',
        'app.districts',
        'app.sale_taxes',
        'app.sales_order_rows',
        'app.job_card_rows',
        'app.job_cards',
        'app.inventory_voucher_rows',
        'app.inventory_vouchers',
        'app.item_serial_numbers',
        'app.sale_tax_companies',
        'app.grn_rows',
        'app.invoice_bookings',
        'app.invoice_booking_rows',
        'app.account_references',
        'app.reference_balances',
        'app.quotation_rows',
        'app.challans',
        'app.challan_rows',
        'app.terms_conditions',
        'app.invoice_breakups',
        'app.carrier',
        'app.courier',
        'app.tax_details',
        'app.editor',
        'app.quotation_close_reasons',
        'app.customer_contacts',
        'app.customer_companies',
        'app.received_froms',
        'app.bank_cashes',
        'app.receipt_breakups',
        'app.payment_vouchers',
        'app.paid_tos',
        'app.payment_breakups',
        'app.credit_notes',
        'app.purchase_accs',
        'app.parties',
        'app.customer_segs',
        'app.st_ledger_accounts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SaleReturnRows') ? [] : ['className' => 'App\Model\Table\SaleReturnRowsTable'];
        $this->SaleReturnRows = TableRegistry::get('SaleReturnRows', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SaleReturnRows);

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
