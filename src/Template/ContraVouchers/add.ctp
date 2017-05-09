<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Contra Vouchers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Contra Voucher Rows'), ['controller' => 'ContraVoucherRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Contra Voucher Row'), ['controller' => 'ContraVoucherRows', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="contraVouchers form large-9 medium-8 columns content">
    <?= $this->Form->create($contraVoucher) ?>
    <fieldset>
        <legend><?= __('Add Contra Voucher') ?></legend>
        <?php
            echo $this->Form->input('voucher_no');
            echo $this->Form->input('bank_cash_id');
            echo $this->Form->input('created_by');
            echo $this->Form->input('created_on');
            echo $this->Form->input('payment_mode');
            echo $this->Form->input('company_id', ['options' => $companies]);
            echo $this->Form->input('transaction_date');
            echo $this->Form->input('edited_by');
            echo $this->Form->input('edited_on');
            echo $this->Form->input('cheque_no');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
