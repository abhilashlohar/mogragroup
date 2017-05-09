<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VendorsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VendorsTable Test Case
 */
class VendorsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VendorsTable
     */
    public $Vendors;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.vendors',
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
        'app.grns',
        'app.purchase_order_rows'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Vendors') ? [] : ['className' => 'App\Model\Table\VendorsTable'];
        $this->Vendors = TableRegistry::get('Vendors', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Vendors);

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
}
