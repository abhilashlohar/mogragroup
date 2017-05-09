<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Sale Return'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sale Taxes'), ['controller' => 'SaleTaxes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sale Tax'), ['controller' => 'SaleTaxes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sales Orders'), ['controller' => 'SalesOrders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sales Order'), ['controller' => 'SalesOrders', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Transporters'), ['controller' => 'Transporters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Transporter'), ['controller' => 'Transporters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sale Return Rows'), ['controller' => 'SaleReturnRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sale Return Row'), ['controller' => 'SaleReturnRows', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="saleReturns index large-9 medium-8 columns content">
    <h3><?= __('Sale Returns') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('temp_limit') ?></th>
                <th><?= $this->Paginator->sort('customer_id') ?></th>
                <th><?= $this->Paginator->sort('lr_no') ?></th>
                <th><?= $this->Paginator->sort('discount_type') ?></th>
                <th><?= $this->Paginator->sort('total') ?></th>
                <th><?= $this->Paginator->sort('pnf') ?></th>
                <th><?= $this->Paginator->sort('pnf_type') ?></th>
                <th><?= $this->Paginator->sort('pnf_per') ?></th>
                <th><?= $this->Paginator->sort('total_after_pnf') ?></th>
                <th><?= $this->Paginator->sort('sale_tax_per') ?></th>
                <th><?= $this->Paginator->sort('sale_tax_id') ?></th>
                <th><?= $this->Paginator->sort('sale_tax_amount') ?></th>
                <th><?= $this->Paginator->sort('exceise_duty') ?></th>
                <th><?= $this->Paginator->sort('ed_description') ?></th>
                <th><?= $this->Paginator->sort('fright_amount') ?></th>
                <th><?= $this->Paginator->sort('fright_text') ?></th>
                <th><?= $this->Paginator->sort('grand_total') ?></th>
                <th><?= $this->Paginator->sort('due_payment') ?></th>
                <th><?= $this->Paginator->sort('date_created') ?></th>
                <th><?= $this->Paginator->sort('company_id') ?></th>
                <th><?= $this->Paginator->sort('process_status') ?></th>
                <th><?= $this->Paginator->sort('sales_order_id') ?></th>
                <th><?= $this->Paginator->sort('in1') ?></th>
                <th><?= $this->Paginator->sort('in2') ?></th>
                <th><?= $this->Paginator->sort('in4') ?></th>
                <th><?= $this->Paginator->sort('in3') ?></th>
                <th><?= $this->Paginator->sort('customer_po_no') ?></th>
                <th><?= $this->Paginator->sort('po_date') ?></th>
                <th><?= $this->Paginator->sort('additional_note') ?></th>
                <th><?= $this->Paginator->sort('employee_id') ?></th>
                <th><?= $this->Paginator->sort('created_by') ?></th>
                <th><?= $this->Paginator->sort('transporter_id') ?></th>
                <th><?= $this->Paginator->sort('discount_per') ?></th>
                <th><?= $this->Paginator->sort('discount') ?></th>
                <th><?= $this->Paginator->sort('form47') ?></th>
                <th><?= $this->Paginator->sort('form49') ?></th>
                <th><?= $this->Paginator->sort('status') ?></th>
                <th><?= $this->Paginator->sort('inventory_voucher_status') ?></th>
                <th><?= $this->Paginator->sort('payment_mode') ?></th>
                <th><?= $this->Paginator->sort('fright_ledger_account') ?></th>
                <th><?= $this->Paginator->sort('sales_ledger_account') ?></th>
                <th><?= $this->Paginator->sort('st_ledger_account_id') ?></th>
                <th><?= $this->Paginator->sort('pdf_font_size') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($saleReturns as $saleReturn): ?>
            <tr>
                <td><?= $this->Number->format($saleReturn->id) ?></td>
                <td><?= $this->Number->format($saleReturn->temp_limit) ?></td>
                <td><?= $saleReturn->has('customer') ? $this->Html->link($saleReturn->customer->customer_name, ['controller' => 'Customers', 'action' => 'view', $saleReturn->customer->id]) : '' ?></td>
                <td><?= h($saleReturn->lr_no) ?></td>
                <td><?= h($saleReturn->discount_type) ?></td>
                <td><?= $this->Number->format($saleReturn->total) ?></td>
                <td><?= $this->Number->format($saleReturn->pnf) ?></td>
                <td><?= h($saleReturn->pnf_type) ?></td>
                <td><?= $this->Number->format($saleReturn->pnf_per) ?></td>
                <td><?= $this->Number->format($saleReturn->total_after_pnf) ?></td>
                <td><?= $this->Number->format($saleReturn->sale_tax_per) ?></td>
                <td><?= $saleReturn->has('sale_tax') ? $this->Html->link($saleReturn->sale_tax->tax_figure, ['controller' => 'SaleTaxes', 'action' => 'view', $saleReturn->sale_tax->id]) : '' ?></td>
                <td><?= $this->Number->format($saleReturn->sale_tax_amount) ?></td>
                <td><?= $this->Number->format($saleReturn->exceise_duty) ?></td>
                <td><?= h($saleReturn->ed_description) ?></td>
                <td><?= $this->Number->format($saleReturn->fright_amount) ?></td>
                <td><?= h($saleReturn->fright_text) ?></td>
                <td><?= $this->Number->format($saleReturn->grand_total) ?></td>
                <td><?= $this->Number->format($saleReturn->due_payment) ?></td>
                <td><?= h($saleReturn->date_created) ?></td>
                <td><?= $saleReturn->has('company') ? $this->Html->link($saleReturn->company->name, ['controller' => 'Companies', 'action' => 'view', $saleReturn->company->id]) : '' ?></td>
                <td><?= h($saleReturn->process_status) ?></td>
                <td><?= $saleReturn->has('sales_order') ? $this->Html->link($saleReturn->sales_order->id, ['controller' => 'SalesOrders', 'action' => 'view', $saleReturn->sales_order->id]) : '' ?></td>
                <td><?= h($saleReturn->in1) ?></td>
                <td><?= $this->Number->format($saleReturn->in2) ?></td>
                <td><?= h($saleReturn->in4) ?></td>
                <td><?= h($saleReturn->in3) ?></td>
                <td><?= h($saleReturn->customer_po_no) ?></td>
                <td><?= h($saleReturn->po_date) ?></td>
                <td><?= h($saleReturn->additional_note) ?></td>
                <td><?= $saleReturn->has('employee') ? $this->Html->link($saleReturn->employee->name, ['controller' => 'Employees', 'action' => 'view', $saleReturn->employee->id]) : '' ?></td>
                <td><?= $this->Number->format($saleReturn->created_by) ?></td>
                <td><?= $saleReturn->has('transporter') ? $this->Html->link($saleReturn->transporter->transporter_name, ['controller' => 'Transporters', 'action' => 'view', $saleReturn->transporter->id]) : '' ?></td>
                <td><?= $this->Number->format($saleReturn->discount_per) ?></td>
                <td><?= $this->Number->format($saleReturn->discount) ?></td>
                <td><?= h($saleReturn->form47) ?></td>
                <td><?= h($saleReturn->form49) ?></td>
                <td><?= h($saleReturn->status) ?></td>
                <td><?= h($saleReturn->inventory_voucher_status) ?></td>
                <td><?= h($saleReturn->payment_mode) ?></td>
                <td><?= $this->Number->format($saleReturn->fright_ledger_account) ?></td>
                <td><?= $this->Number->format($saleReturn->sales_ledger_account) ?></td>
                <td><?= $this->Number->format($saleReturn->st_ledger_account_id) ?></td>
                <td><?= h($saleReturn->pdf_font_size) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $saleReturn->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $saleReturn->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $saleReturn->id], ['confirm' => __('Are you sure you want to delete # {0}?', $saleReturn->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
