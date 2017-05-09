<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\QuotationCloseReasionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\QuotationCloseReasionsTable Test Case
 */
class QuotationCloseReasionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\QuotationCloseReasionsTable
     */
    public $QuotationCloseReasions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.quotation_close_reasions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('QuotationCloseReasions') ? [] : ['className' => 'App\Model\Table\QuotationCloseReasionsTable'];
        $this->QuotationCloseReasions = TableRegistry::get('QuotationCloseReasions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->QuotationCloseReasions);

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
