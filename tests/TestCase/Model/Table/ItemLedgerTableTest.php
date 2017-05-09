<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemLedgerTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemLedgerTable Test Case
 */
class ItemLedgerTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemLedgerTable
     */
    public $ItemLedger;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.item_ledger',
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
        'app.districts',
        'app.customer_groups',
        'app.customer_segs',
        'app.employees',
        'app.departments',
        'app.designations',
        'app.quotations',
        'app.creator',
        'app.sales_orders',
        'app.carrier',
        'app.customer_address',
        'app.transporters',
        'app.courier',
        'app.terms_conditions',
        'app.tax_details',
        'app.editor',
        'app.invoices',
        'app.sales_order_rows',
        'app.invoice_rows',
        'app.company_banks',
        'app.sale_taxes',
        'app.filenames',
        'app.quotation_rows',
        'app.customer_contacts',
        'app.item_used_by_companies',
        'app.item_companies'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ItemLedger') ? [] : ['className' => 'App\Model\Table\ItemLedgerTable'];
        $this->ItemLedger = TableRegistry::get('ItemLedger', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemLedger);

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
