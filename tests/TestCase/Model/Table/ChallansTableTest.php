<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChallansTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChallansTable Test Case
 */
class ChallansTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ChallansTable
     */
    public $Challans;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.challans',
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
        'app.sales_orders',
        'app.carrier',
        'app.customer_address',
        'app.transporters',
        'app.courier',
        'app.terms_conditions',
        'app.tax_details',
        'app.creator',
        'app.invoices',
        'app.sales_order_rows',
        'app.items',
        'app.item_categories',
        'app.item_groups',
        'app.item_sub_groups',
        'app.units',
        'app.sources',
        'app.item_sources',
        'app.item_companies',
        'app.quotation_rows',
        'app.invoice_rows',
        'app.sale_taxes',
        'app.editor',
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
        $config = TableRegistry::exists('Challans') ? [] : ['className' => 'App\Model\Table\ChallansTable'];
        $this->Challans = TableRegistry::get('Challans', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Challans);

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
