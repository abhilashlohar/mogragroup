<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EmployeeContactPersonsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EmployeeContactPersonsTable Test Case
 */
class EmployeeContactPersonsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EmployeeContactPersonsTable
     */
    public $EmployeeContactPersons;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.employee_contact_persons',
        'app.employees',
        'app.departments',
        'app.designations',
        'app.quotations',
        'app.customers',
        'app.districts',
        'app.company_groups',
        'app.companies',
        'app.item_used_by_companies',
        'app.company_banks',
        'app.sales_orders',
        'app.carrier',
        'app.customer_address',
        'app.transporters',
        'app.courier',
        'app.terms_conditions',
        'app.tax_details',
        'app.creator',
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
        'app.quotation_rows',
        'app.sales_order_rows',
        'app.invoice_rows',
        'app.sale_taxes',
        'app.editor',
        'app.customer_segs',
        'app.customer_contacts',
        'app.filenames'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('EmployeeContactPersons') ? [] : ['className' => 'App\Model\Table\EmployeeContactPersonsTable'];
        $this->EmployeeContactPersons = TableRegistry::get('EmployeeContactPersons', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EmployeeContactPersons);

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
