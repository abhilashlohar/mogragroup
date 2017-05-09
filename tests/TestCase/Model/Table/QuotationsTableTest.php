<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\QuotationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\QuotationsTable Test Case
 */
class QuotationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\QuotationsTable
     */
    public $Quotations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.quotations',
        'app.customers',
        'app.districts',
        'app.company_groups',
        'app.customer_segs',
        'app.customer_contacts',
        'app.quotation_rows'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Quotations') ? [] : ['className' => 'App\Model\Table\QuotationsTable'];
        $this->Quotations = TableRegistry::get('Quotations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Quotations);

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
