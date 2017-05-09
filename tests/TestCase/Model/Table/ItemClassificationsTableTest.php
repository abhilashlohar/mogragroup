<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemClassificationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemClassificationsTable Test Case
 */
class ItemClassificationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemClassificationsTable
     */
    public $ItemClassifications;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.item_classifications'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ItemClassifications') ? [] : ['className' => 'App\Model\Table\ItemClassificationsTable'];
        $this->ItemClassifications = TableRegistry::get('ItemClassifications', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemClassifications);

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
