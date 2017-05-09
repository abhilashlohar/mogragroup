<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VouchersReferencesGroupsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VouchersReferencesGroupsTable Test Case
 */
class VouchersReferencesGroupsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VouchersReferencesGroupsTable
     */
    public $VouchersReferencesGroups;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.vouchers_references_groups',
        'app.vouchers_references',
        'app.account_groups',
        'app.account_categories',
        'app.account_first_subgroups',
        'app.account_second_subgroups'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('VouchersReferencesGroups') ? [] : ['className' => 'App\Model\Table\VouchersReferencesGroupsTable'];
        $this->VouchersReferencesGroups = TableRegistry::get('VouchersReferencesGroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VouchersReferencesGroups);

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
