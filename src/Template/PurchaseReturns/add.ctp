<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Purchase Returns'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Invoice Bookings'), ['controller' => 'InvoiceBookings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Invoice Booking'), ['controller' => 'InvoiceBookings', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="purchaseReturns form large-9 medium-8 columns content">
    <?= $this->Form->create($purchaseReturn) ?>
    <fieldset>
        <legend><?= __('Add Purchase Return') ?></legend>
        <?php
            echo $this->Form->input('invoice_booking_id', ['options' => $invoiceBookings]);
            echo $this->Form->input('created_on');
            echo $this->Form->input('company_id', ['options' => $companies]);
            echo $this->Form->input('created_by');
            echo $this->Form->input('voucher_no');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
