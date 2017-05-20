<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Inventory Transfer Voucher'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Inventory Transfer Voucher Rows'), ['controller' => 'InventoryTransferVoucherRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Inventory Transfer Voucher Row'), ['controller' => 'InventoryTransferVoucherRows', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="inventoryTransferVouchers index large-9 medium-8 columns content">
    <h3><?= __('Inventory Transfer Vouchers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('voucher_no') ?></th>
                <th><?= $this->Paginator->sort('company_id') ?></th>
                <th><?= $this->Paginator->sort('created_by') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($inventoryTransferVouchers as $inventoryTransferVoucher): ?>
            <tr>
                <td><?= $this->Number->format($inventoryTransferVoucher->id) ?></td>
                <td><?= $this->Number->format($inventoryTransferVoucher->voucher_no) ?></td>
                <td><?= $inventoryTransferVoucher->has('company') ? $this->Html->link($inventoryTransferVoucher->company->name, ['controller' => 'Companies', 'action' => 'view', $inventoryTransferVoucher->company->id]) : '' ?></td>
                <td><?= $this->Number->format($inventoryTransferVoucher->created_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $inventoryTransferVoucher->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $inventoryTransferVoucher->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $inventoryTransferVoucher->id], ['confirm' => __('Are you sure you want to delete # {0}?', $inventoryTransferVoucher->id)]) ?>
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
