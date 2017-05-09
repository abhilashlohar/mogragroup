<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CustomerGroupsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CustomerGroupsTable Test Case
 */
class CustomerGroupsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CustomerGroupsTable
     */
    public $CustomerGroups;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.customer_groups',
        'app.customers',
        'app.districts',
        'app.company_groups',
        'app.companies',
        'app.item_used_by_companies',
        'app.company_banks',
        'app.customer_segs',
        'app.employees',
        'app.dipartments',
        'app.designations',
        'app.transporters',
        'app.customer_contacts',
        'app.quotations',
        'app.categories',
        'app.terms_conditions',
        'app.filenames',
        'app.items',
        'app.units',
        'app.sources',
        'app.item_sources',
        'app.item_companies',
        'app.quotation_rows',
        'app.customer_address'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CustomerGroups') ? [] : ['className' => 'App\Model\Table\CustomerGroupsTable'];
        $this->CustomerGroups = TableRegistry::get('CustomerGroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CustomerGroups);

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
