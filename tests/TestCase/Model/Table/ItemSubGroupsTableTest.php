<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemSubGroupsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemSubGroupsTable Test Case
 */
class ItemSubGroupsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemSubGroupsTable
     */
    public $ItemSubGroups;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.item_sub_groups',
        'app.item_groups',
        'app.item_categories',
        'app.items',
        'app.categories',
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
        'app.transporters',
        'app.customer_contacts',
        'app.quotations',
        'app.terms_conditions',
        'app.filenames',
        'app.quotation_rows',
        'app.customer_address',
        'app.item_used_by_companies',
        'app.company_banks',
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
        $config = TableRegistry::exists('ItemSubGroups') ? [] : ['className' => 'App\Model\Table\ItemSubGroupsTable'];
        $this->ItemSubGroups = TableRegistry::get('ItemSubGroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemSubGroups);

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
