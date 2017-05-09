<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserRightsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserRightsTable Test Case
 */
class UserRightsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UserRightsTable
     */
    public $UserRights;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.user_rights',
        'app.logins',
        'app.employees',
        'app.departments',
        'app.designations',
        'app.pages'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UserRights') ? [] : ['className' => 'App\Model\Table\UserRightsTable'];
        $this->UserRights = TableRegistry::get('UserRights', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserRights);

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
