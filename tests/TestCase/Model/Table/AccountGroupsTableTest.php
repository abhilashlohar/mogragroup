<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AccountGroupsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AccountGroupsTable Test Case
 */
class AccountGroupsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AccountGroupsTable
     */
    public $AccountGroups;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.account_groups',
        'app.account_categories',
        'app.account_first_subgroups'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AccountGroups') ? [] : ['className' => 'App\Model\Table\AccountGroupsTable'];
        $this->AccountGroups = TableRegistry::get('AccountGroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AccountGroups);

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
