<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemCategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemCategoriesTable Test Case
 */
class ItemCategoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemCategoriesTable
     */
    public $ItemCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.item_categories',
        'app.item_groups',
        'app.items',
        'app.categories',
        'app.units',
        'app.sources',
        'app.item_sources',
        'app.companies',
        'app.company_groups',
        'app.customers',
        'app.districts',
        'app.customer_groups',
        'app.customer_segs',
        'app.employees',
        'app.departments',
        'app.designations',
        'app.transporters',
        'app.customer_contacts',
        'app.quotations',
        'app.terms_conditions',
        'app.filenames',
        'app.quotation_rows',
        'app.customer_address',
        'app.item_used_by_companies',
        'app.company_banks',
        'app.item_companies'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ItemCategories') ? [] : ['className' => 'App\Model\Table\ItemCategoriesTable'];
        $this->ItemCategories = TableRegistry::get('ItemCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemCategories);

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
