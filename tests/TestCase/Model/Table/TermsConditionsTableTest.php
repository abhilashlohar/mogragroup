<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TermsConditionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TermsConditionsTable Test Case
 */
class TermsConditionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TermsConditionsTable
     */
    public $TermsConditions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.terms_conditions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TermsConditions') ? [] : ['className' => 'App\Model\Table\TermsConditionsTable'];
        $this->TermsConditions = TableRegistry::get('TermsConditions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TermsConditions);

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
