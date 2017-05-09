<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CustomerSegsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CustomerSegsTable Test Case
 */
class CustomerSegsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CustomerSegsTable
     */
    public $CustomerSegs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.customer_segs',
        'app.customers',
        'app.districts',
        'app.company_groups',
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
        $config = TableRegistry::exists('CustomerSegs') ? [] : ['className' => 'App\Model\Table\CustomerSegsTable'];
        $this->CustomerSegs = TableRegistry::get('CustomerSegs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CustomerSegs);

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
