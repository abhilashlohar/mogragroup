<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FilenamesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FilenamesTable Test Case
 */
class FilenamesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FilenamesTable
     */
    public $Filenames;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.filenames',
        'app.customers',
        'app.districts',
        'app.company_groups',
        'app.customer_segs',
        'app.employees',
        'app.dipartments',
        'app.designations',
        'app.transporters',
        'app.customer_contacts',
        'app.quotations',
        'app.companies',
        'app.item_used_by_companies',
        'app.item_categories',
        'app.item_groups',
        'app.item_sub_groups',
        'app.items',
        'app.units',
        'app.sources',
        'app.item_sources',
        'app.item_companies',
        'app.terms_conditions',
        'app.quotation_rows',
        'app.customer_address'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Filenames') ? [] : ['className' => 'App\Model\Table\FilenamesTable'];
        $this->Filenames = TableRegistry::get('Filenames', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Filenames);

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
