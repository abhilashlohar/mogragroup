<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SaleTaxesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SaleTaxesTable Test Case
 */
class SaleTaxesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SaleTaxesTable
     */
    public $SaleTaxes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sale_taxes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SaleTaxes') ? [] : ['className' => 'App\Model\Table\SaleTaxesTable'];
        $this->SaleTaxes = TableRegistry::get('SaleTaxes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SaleTaxes);

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
