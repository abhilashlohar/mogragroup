<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PurchaseReturnsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PurchaseReturnsTable Test Case
 */
class PurchaseReturnsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PurchaseReturnsTable
     */
    public $PurchaseReturns;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.purchase_returns',
        'app.invoice_bookings',
        'app.grns',
        'app.purchase_order_rows',
        'app.purchase_orders',
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
        'app.reference_details',
        'app.receipt_vouchers',
        'app.vouchers_references',
        'app.voucher_ledger_accounts',
        'app.financial_years',
        'app.financial_months',
        'app.invoices',
        'app.customer_groups',
        'app.item_ledgers',
        'app.inventory_vouchers',
        'app.sales_order_rows',
        'app.sales_orders',
        'app.filenames',
        'app.quotations',
        'app.employees',
        'app.departments',
        'app.designations',
        'app.employee_contact_persons',
        'app.logins',
        'app.user_rights',
        'app.pages',
        'app.employee_companies',
        'app.creator',
        'app.editor',
        'app.terms_conditions',
        'app.quotation_close_reasons',
        'app.quotation_rows',
        'app.customer_contacts',
        'app.carrier',
        'app.customer_address',
        'app.districts',
        'app.transporters',
        'app.courier',
        'app.tax_details',
        'app.sale_taxes',
        'app.sale_tax_companies',
        'app.job_cards',
        'app.job_card_rows',
        'app.inventory_voucher_rows',
        'app.invoice_rows',
        'app.item_serialnumbers',
        'app.item_serial_numbers',
        'app.vendors',
        'app.vendor_contact_persons',
        'app.vendor_companies',
        'app.challans',
        'app.challan_rows',
        'app.reference_balances',
        'app.invoice_breakups',
        'app.account_references',
        'app.sale_returns',
        'app.sale_return_rows',
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
        'app.customer_companies',
        'app.item_used_by_companies',
        'app.company_banks',
        'app.item_companies',
        'app.material_indent_rows',
        'app.material_indents',
        'app.grn_rows',
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
        $config = TableRegistry::exists('PurchaseReturns') ? [] : ['className' => 'App\Model\Table\PurchaseReturnsTable'];
        $this->PurchaseReturns = TableRegistry::get('PurchaseReturns', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PurchaseReturns);

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
