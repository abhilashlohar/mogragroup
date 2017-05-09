<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\QuotationCloseReasonsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\QuotationCloseReasonsTable Test Case
 */
class QuotationCloseReasonsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\QuotationCloseReasonsTable
     */
    public $QuotationCloseReasons;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.quotation_close_reasons'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('QuotationCloseReasons') ? [] : ['className' => 'App\Model\Table\QuotationCloseReasonsTable'];
        $this->QuotationCloseReasons = TableRegistry::get('QuotationCloseReasons', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->QuotationCloseReasons);

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
