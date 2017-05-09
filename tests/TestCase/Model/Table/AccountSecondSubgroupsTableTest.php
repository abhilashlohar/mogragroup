<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AccountSecondSubgroupsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AccountSecondSubgroupsTable Test Case
 */
class AccountSecondSubgroupsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AccountSecondSubgroupsTable
     */
    public $AccountSecondSubgroups;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.account_second_subgroups',
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
        $config = TableRegistry::exists('AccountSecondSubgroups') ? [] : ['className' => 'App\Model\Table\AccountSecondSubgroupsTable'];
        $this->AccountSecondSubgroups = TableRegistry::get('AccountSecondSubgroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AccountSecondSubgroups);

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
