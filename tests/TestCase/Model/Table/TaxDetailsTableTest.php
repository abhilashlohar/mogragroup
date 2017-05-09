<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TaxDetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TaxDetailsTable Test Case
 */
class TaxDetailsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TaxDetailsTable
     */
    public $TaxDetails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tax_details',
        'app.taxes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TaxDetails') ? [] : ['className' => 'App\Model\Table\TaxDetailsTable'];
        $this->TaxDetails = TableRegistry::get('TaxDetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TaxDetails);

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
