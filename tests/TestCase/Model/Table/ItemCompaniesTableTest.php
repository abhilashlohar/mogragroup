<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemCompaniesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemCompaniesTable Test Case
 */
class ItemCompaniesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemCompaniesTable
     */
    public $ItemCompanies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.item_companies',
        'app.items',
        'app.item_categories',
        'app.item_groups',
        'app.item_sub_groups',
        'app.units',
        'app.sources',
        'app.item_sources',
        'app.companies',
        'app.company_groups',
        'app.customers',
        'app.ledger_accounts',
        'app.account_second_subgroups',
        'app.account_first_subgroups',
        'app.account_groups',
        'app.account_categories',
        'app.ledgers',
        'app.districts',
        'app.customer_groups',
        'app.customer_segs',
        'app.employees',
        'app.departments',
        'app.designations',
        'app.employee_contact_persons',
        'app.quotations',
        'app.creator',
        'app.sales_orders',
        'app.filenames',
        'app.carrier',
        'app.customer_address',
        'app.transporters',
        'app.courier',
        'app.terms_conditions',
        'app.tax_details',
        'app.editor',
        'app.invoices',
        'app.item_ledger',
        'app.sales_order_rows',
        'app.invoice_rows',
        'app.company_banks',
        'app.sale_taxes',
        'app.account_references',
        'app.employee_companies',
        'app.quotation_close_reasons',
        'app.quotation_rows',
        'app.customer_contacts',
        'app.item_used_by_companies'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ItemCompanies') ? [] : ['className' => 'App\Model\Table\ItemCompaniesTable'];
        $this->ItemCompanies = TableRegistry::get('ItemCompanies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemCompanies);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
