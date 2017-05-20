<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $inventoryTransferVoucher->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $inventoryTransferVoucher->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Inventory Transfer Vouchers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Inventory Transfer Voucher Rows'), ['controller' => 'InventoryTransferVoucherRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Inventory Transfer Voucher Row'), ['controller' => 'InventoryTransferVoucherRows', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="inventoryTransferVouchers form large-9 medium-8 columns content">
    <?= $this->Form->create($inventoryTransferVoucher) ?>
    <fieldset>
        <legend><?= __('Edit Inventory Transfer Voucher') ?></legend>
        <?php
            echo $this->Form->input('voucher_no');
            echo $this->Form->input('company_id', ['options' => $companies]);
            echo $this->Form->input('created_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
