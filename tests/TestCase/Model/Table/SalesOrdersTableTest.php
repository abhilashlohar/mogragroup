<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SalesOrdersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SalesOrdersTable Test Case
 */
class SalesOrdersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SalesOrdersTable
     */
    public $SalesOrders;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sales_orders',
        'app.customers',
        'app.districts',
        'app.company_groups',
        'app.customer_segs',
        'app.employees',
        'app.dipartments',
        'app.transporters',
        'app.customer_contacts',
        'app.quotations',
        'app.companies',
        'app.item_used_by_companies',
        'app.item_categories',
        'app.item_groups',
        'app.item_sub_groups',
        'app.items',
        'app.units',
        'app.sources',
        'app.item_sources',
        'app.item_companies',
        'app.quotation_rows',
        'app.customer_address',
        'app.sales_order_rows'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SalesOrders') ? [] : ['className' => 'App\Model\Table\SalesOrdersTable'];
        $this->SalesOrders = TableRegistry::get('SalesOrders', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SalesOrders);

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
