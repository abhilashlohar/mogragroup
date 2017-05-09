<?php
namespace App\Test\TestCase\Controller;

use App\Controller\InvoicesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\InvoicesController Test Case
 */
class InvoicesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.invoices',
        'app.customers',
        'app.districts',
        'app.company_groups',
        'app.customer_segs',
        'app.employees',
        'app.dipartments',
        'app.transporters',
        'app.customer_contacts',
        'app.quotations',
        'app.companies',
        'app.item_used_by_companies',
        'app.item_companies',
        'app.items',
        'app.item_categories',
        'app.item_groups',
        'app.item_sub_groups',
        'app.units',
        'app.sources',
        'app.item_sources',
        'app.quotation_rows',
        'app.customer_address',
        'app.sales_orders',
        'app.sales_order_rows',
        'app.invoice_rows'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
