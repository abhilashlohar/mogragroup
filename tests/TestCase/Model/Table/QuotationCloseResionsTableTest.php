<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\QuotationCloseResionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\QuotationCloseResionsTable Test Case
 */
class QuotationCloseResionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\QuotationCloseResionsTable
     */
    public $QuotationCloseResions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.quotation_close_resions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('QuotationCloseResions') ? [] : ['className' => 'App\Model\Table\QuotationCloseResionsTable'];
        $this->QuotationCloseResions = TableRegistry::get('QuotationCloseResions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->QuotationCloseResions);

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
