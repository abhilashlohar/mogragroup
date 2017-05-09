<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AccountFirstSubgroupsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AccountFirstSubgroupsTable Test Case
 */
class AccountFirstSubgroupsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AccountFirstSubgroupsTable
     */
    public $AccountFirstSubgroups;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.account_first_subgroups',
        'app.account_groups',
        'app.account_categories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AccountFirstSubgroups') ? [] : ['className' => 'App\Model\Table\AccountFirstSubgroupsTable'];
        $this->AccountFirstSubgroups = TableRegistry::get('AccountFirstSubgroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AccountFirstSubgroups);

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
