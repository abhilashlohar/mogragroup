<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DipartmentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DipartmentsTable Test Case
 */
class DipartmentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DipartmentsTable
     */
    public $Dipartments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.dipartments',
        'app.employees',
        'app.designations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Dipartments') ? [] : ['className' => 'App\Model\Table\DipartmentsTable'];
        $this->Dipartments = TableRegistry::get('Dipartments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Dipartments);

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
