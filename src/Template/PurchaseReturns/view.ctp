<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Purchase Return'), ['action' => 'edit', $purchaseReturn->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Purchase Return'), ['action' => 'delete', $purchaseReturn->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseReturn->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Purchase Returns'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Purchase Return'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Invoice Bookings'), ['controller' => 'InvoiceBookings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Invoice Booking'), ['controller' => 'InvoiceBookings', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="purchaseReturns view large-9 medium-8 columns content">
    <h3><?= h($purchaseReturn->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Invoice Booking') ?></th>
            <td><?= $purchaseReturn->has('invoice_booking') ? $this->Html->link($purchaseReturn->invoice_booking->id, ['controller' => 'InvoiceBookings', 'action' => 'view', $purchaseReturn->invoice_booking->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Company') ?></th>
            <td><?= $purchaseReturn->has('company') ? $this->Html->link($purchaseReturn->company->name, ['controller' => 'Companies', 'action' => 'view', $purchaseReturn->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($purchaseReturn->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created By') ?></th>
            <td><?= $this->Number->format($purchaseReturn->created_by) ?></td>
        </tr>
        <tr>
            <th><?= __('Voucher No') ?></th>
            <td><?= $this->Number->format($purchaseReturn->voucher_no) ?></td>
        </tr>
        <tr>
            <th><?= __('Created On') ?></th>
            <td><?= h($purchaseReturn->created_on) ?></td>
        </tr>
    </table>
</div>
