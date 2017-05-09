<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EmployeeEmergencyContactPersonsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EmployeeEmergencyContactPersonsTable Test Case
 */
class EmployeeEmergencyContactPersonsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EmployeeEmergencyContactPersonsTable
     */
    public $EmployeeEmergencyContactPersons;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.employee_emergency_contact_persons',
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
        $config = TableRegistry::exists('EmployeeEmergencyContactPersons') ? [] : ['className' => 'App\Model\Table\EmployeeEmergencyContactPersonsTable'];
        $this->EmployeeEmergencyContactPersons = TableRegistry::get('EmployeeEmergencyContactPersons', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EmployeeEmergencyContactPersons);

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
