<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TaxesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TaxesTable Test Case
 */
class TaxesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TaxesTable
     */
    public $Taxes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.taxes',
        'app.tax_details'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Taxes') ? [] : ['className' => 'App\Model\Table\TaxesTable'];
        $this->Taxes = TableRegistry::get('Taxes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Taxes);

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
