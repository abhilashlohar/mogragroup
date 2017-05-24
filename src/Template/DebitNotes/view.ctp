<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Debit Note'), ['action' => 'edit', $debitNote->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Debit Note'), ['action' => 'delete', $debitNote->id], ['confirm' => __('Are you sure you want to delete # {0}?', $debitNote->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Debit Notes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Debit Note'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Debit Notes Rows'), ['controller' => 'DebitNotesRows', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Debit Notes Row'), ['controller' => 'DebitNotesRows', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="debitNotes view large-9 medium-8 columns content">
    <h3><?= h($debitNote->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Voucher No') ?></th>
            <td><?= h($debitNote->voucher_no) ?></td>
        </tr>
        <tr>
            <th><?= __('Company') ?></th>
            <td><?= $debitNote->has('company') ? $this->Html->link($debitNote->company->name, ['controller' => 'Companies', 'action' => 'view', $debitNote->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($debitNote->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Customer Suppiler Id') ?></th>
            <td><?= $this->Number->format($debitNote->customer_suppiler_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created By') ?></th>
            <td><?= $this->Number->format($debitNote->created_by) ?></td>
        </tr>
        <tr>
            <th><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($debitNote->edited_by) ?></td>
        </tr>
        <tr>
            <th><?= __('Created On') ?></th>
            <td><?= h($debitNote->created_on) ?></td>
        </tr>
        <tr>
            <th><?= __('Transaction Date') ?></th>
            <td><?= h($debitNote->transaction_date) ?></td>
        </tr>
        <tr>
            <th><?= __('Edited On') ?></th>
            <td><?= h($debitNote->edited_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Subject') ?></h4>
        <?= $this->Text->autoParagraph(h($debitNote->subject)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Debit Notes Rows') ?></h4>
        <?php if (!empty($debitNote->debit_notes_rows)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Debit Note Id') ?></th>
                <th><?= __('Head Id') ?></th>
                <th><?= __('Amount') ?></th>
                <th><?= __('Narration') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($debitNote->debit_notes_rows as $debitNotesRows): ?>
            <tr>
                <td><?= h($debitNotesRows->id) ?></td>
                <td><?= h($debitNotesRows->debit_note_id) ?></td>
                <td><?= h($debitNotesRows->head_id) ?></td>
                <td><?= h($debitNotesRows->amount) ?></td>
                <td><?= h($debitNotesRows->narration) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'DebitNotesRows', 'action' => 'view', $debitNotesRows->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'DebitNotesRows', 'action' => 'edit', $debitNotesRows->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'DebitNotesRows', 'action' => 'delete', $debitNotesRows->id], ['confirm' => __('Are you sure you want to delete # {0}?', $debitNotesRows->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
