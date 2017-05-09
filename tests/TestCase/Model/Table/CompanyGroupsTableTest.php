<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CompanyGroupsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CompanyGroupsTable Test Case
 */
class CompanyGroupsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CompanyGroupsTable
     */
    public $CompanyGroups;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.company_groups',
        'app.customers',
        'app.districts',
        'app.customer_segs',
        'app.customer_contacts',
        'app.quotations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CompanyGroups') ? [] : ['className' => 'App\Model\Table\CompanyGroupsTable'];
        $this->CompanyGroups = TableRegistry::get('CompanyGroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CompanyGroups);

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
