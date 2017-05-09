<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EmailRecordsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EmailRecordsTable Test Case
 */
class EmailRecordsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EmailRecordsTable
     */
    public $EmailRecords;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.email_records'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('EmailRecords') ? [] : ['className' => 'App\Model\Table\EmailRecordsTable'];
        $this->EmailRecords = TableRegistry::get('EmailRecords', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EmailRecords);

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
