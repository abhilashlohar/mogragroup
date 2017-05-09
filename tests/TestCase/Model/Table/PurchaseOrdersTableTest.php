<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PurchaseOrdersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PurchaseOrdersTable Test Case
 */
class PurchaseOrdersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PurchaseOrdersTable
     */
    public $PurchaseOrders;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.purchase_orders',
        'app.companies',
        'app.company_groups',
        'app.customers',
        'app.districts',
        'app.customer_segs',
        'app.employees',
        'app.dipartments',
        'app.designations',
        'app.transporters',
        'app.customer_contacts',
        'app.quotations',
        'app.item_categories',
        'app.item_groups',
        'app.item_sub_groups',
        'app.items',
        'app.units',
        'app.sources',
        'app.item_sources',
        'app.item_companies',
        'app.item_used_by_companies',
        'app.terms_conditions',
        'app.quotation_rows',
        'app.customer_address',
        'app.vendors',
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
        $config = TableRegistry::exists('PurchaseOrders') ? [] : ['className' => 'App\Model\Table\PurchaseOrdersTable'];
        $this->PurchaseOrders = TableRegistry::get('PurchaseOrders', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PurchaseOrders);

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
