<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Debit Note'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Debit Notes Rows'), ['controller' => 'DebitNotesRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Debit Notes Row'), ['controller' => 'DebitNotesRows', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="debitNotes index large-9 medium-8 columns content">
    <h3><?= __('Debit Notes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('voucher_no') ?></th>
                <th><?= $this->Paginator->sort('created_on') ?></th>
                <th><?= $this->Paginator->sort('transaction_date') ?></th>
                <th><?= $this->Paginator->sort('customer_suppiler_id') ?></th>
                <th><?= $this->Paginator->sort('company_id') ?></th>
                <th><?= $this->Paginator->sort('created_by') ?></th>
                <th><?= $this->Paginator->sort('edited_by') ?></th>
                <th><?= $this->Paginator->sort('edited_on') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($debitNotes as $debitNote): ?>
            <tr>
                <td><?= $this->Number->format($debitNote->id) ?></td>
                <td><?= h($debitNote->voucher_no) ?></td>
                <td><?= h($debitNote->created_on) ?></td>
                <td><?= h($debitNote->transaction_date) ?></td>
                <td><?= $this->Number->format($debitNote->customer_suppiler_id) ?></td>
                <td><?= $debitNote->has('company') ? $this->Html->link($debitNote->company->name, ['controller' => 'Companies', 'action' => 'view', $debitNote->company->id]) : '' ?></td>
                <td><?= $this->Number->format($debitNote->created_by) ?></td>
                <td><?= $this->Number->format($debitNote->edited_by) ?></td>
                <td><?= h($debitNote->edited_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $debitNote->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $debitNote->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $debitNote->id], ['confirm' => __('Are you sure you want to delete # {0}?', $debitNote->id)]) ?>
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
