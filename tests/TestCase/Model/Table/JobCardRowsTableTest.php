<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\JobCardRowsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\JobCardRowsTable Test Case
 */
class JobCardRowsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\JobCardRowsTable
     */
    public $JobCardRows;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.job_card_rows',
        'app.job_cards',
        'app.sales_orders',
        'app.customers',
        'app.ledger_accounts',
        'app.account_second_subgroups',
        'app.account_first_subgroups',
        'app.account_groups',
        'app.account_categories',
        'app.ledgers',
        'app.districts',
        'app.company_groups',
        'app.companies',
        'app.item_used_by_companies',
        'app.company_banks',
        'app.quotations',
        'app.employees',
        'app.departments',
        'app.designations',
        'app.employee_contact_persons',
        'app.invoices',
        'app.customer_groups',
        'app.item_ledger',
        'app.items',
        'app.item_categories',
        'app.item_groups',
        'app.item_sub_groups',
        'app.units',
        'app.sources',
        'app.item_sources',
        'app.item_companies',
        'app.invoice_rows',
        'app.quotation_rows',
        'app.sales_order_rows',
        'app.terms_conditions',
        'app.transporters',
        'app.customer_address',
        'app.sale_taxes',
        'app.creator',
        'app.editor',
        'app.filenames',
        'app.quotation_close_reasons',
        'app.customer_segs',
        'app.customer_contacts',
        'app.carrier',
        'app.courier',
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
        $config = TableRegistry::exists('JobCardRows') ? [] : ['className' => 'App\Model\Table\JobCardRowsTable'];
        $this->JobCardRows = TableRegistry::get('JobCardRows', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->JobCardRows);

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
