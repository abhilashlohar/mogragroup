<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PurchaseOrderRowsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PurchaseOrderRowsTable Test Case
 */
class PurchaseOrderRowsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PurchaseOrderRowsTable
     */
    public $PurchaseOrderRows;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.purchase_order_rows',
        'app.purchase_orders',
        'app.companies',
        'app.company_groups',
        'app.customers',
        'app.districts',
        'app.customer_groups',
        'app.customer_segs',
        'app.employees',
        'app.departments',
        'app.designations',
        'app.quotations',
        'app.item_groups',
        'app.item_categories',
        'app.items',
        'app.item_sub_groups',
        'app.units',
        'app.sources',
        'app.item_sources',
        'app.item_companies',
        'app.item_used_by_companies',
        'app.quotation_rows',
        'app.sales_order_rows',
        'app.sales_orders',
        'app.carrier',
        'app.customer_address',
        'app.transporters',
        'app.courier',
        'app.terms_conditions',
        'app.tax_details',
        'app.sale_taxes',
        'app.invoice_rows',
        'app.invoices',
        'app.company_banks',
        'app.filenames',
        'app.customer_contacts',
        'app.vendors',
        'app.vendor_contact_persons',
        'app.grns'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PurchaseOrderRows') ? [] : ['className' => 'App\Model\Table\PurchaseOrderRowsTable'];
        $this->PurchaseOrderRows = TableRegistry::get('PurchaseOrderRows', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PurchaseOrderRows);

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
