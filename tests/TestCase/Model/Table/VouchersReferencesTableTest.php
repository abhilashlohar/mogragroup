<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VouchersReferencesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VouchersReferencesTable Test Case
 */
class VouchersReferencesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VouchersReferencesTable
     */
    public $VouchersReferences;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.vouchers_references',
        'app.vouchers_references_groups'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('VouchersReferences') ? [] : ['className' => 'App\Model\Table\VouchersReferencesTable'];
        $this->VouchersReferences = TableRegistry::get('VouchersReferences', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VouchersReferences);

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
