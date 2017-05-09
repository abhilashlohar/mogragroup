<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Purchase Return'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Invoice Bookings'), ['controller' => 'InvoiceBookings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Invoice Booking'), ['controller' => 'InvoiceBookings', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="purchaseReturns index large-9 medium-8 columns content">
    <h3><?= __('Purchase Returns') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('invoice_booking_id') ?></th>
                <th><?= $this->Paginator->sort('created_on') ?></th>
                <th><?= $this->Paginator->sort('company_id') ?></th>
                <th><?= $this->Paginator->sort('created_by') ?></th>
                <th><?= $this->Paginator->sort('voucher_no') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($purchaseReturns as $purchaseReturn): ?>
            <tr>
                <td><?= $this->Number->format($purchaseReturn->id) ?></td>
                <td><?= $purchaseReturn->has('invoice_booking') ? $this->Html->link($purchaseReturn->invoice_booking->id, ['controller' => 'InvoiceBookings', 'action' => 'view', $purchaseReturn->invoice_booking->id]) : '' ?></td>
                <td><?= h($purchaseReturn->created_on) ?></td>
                <td><?= $purchaseReturn->has('company') ? $this->Html->link($purchaseReturn->company->name, ['controller' => 'Companies', 'action' => 'view', $purchaseReturn->company->id]) : '' ?></td>
                <td><?= $this->Number->format($purchaseReturn->created_by) ?></td>
                <td><?= $this->Number->format($purchaseReturn->voucher_no) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $purchaseReturn->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchaseReturn->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $purchaseReturn->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseReturn->id)]) ?>
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
