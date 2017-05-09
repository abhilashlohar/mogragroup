<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CustomerAddressTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CustomerAddressTable Test Case
 */
class CustomerAddressTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CustomerAddressTable
     */
    public $CustomerAddress;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.customer_address',
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
        'app.item_groups',
        'app.item_categories',
        'app.items',
        'app.item_sub_groups',
        'app.units',
        'app.sources',
        'app.item_sources',
        'app.item_companies',
        'app.quotation_rows',
        'app.sales_order_rows',
        'app.sales_orders',
        'app.carrier',
        'app.courier',
        'app.terms_conditions',
        'app.tax_details',
        'app.sale_taxes',
        'app.invoice_rows',
        'app.invoices',
        'app.transporters',
        'app.filenames',
        'app.customer_groups',
        'app.customer_segs',
        'app.customer_contacts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CustomerAddress') ? [] : ['className' => 'App\Model\Table\CustomerAddressTable'];
        $this->CustomerAddress = TableRegistry::get('CustomerAddress', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CustomerAddress);

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
