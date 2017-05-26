<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Credit Note'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Ledgers'), ['controller' => 'Ledgers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ledger'), ['controller' => 'Ledgers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vouchers References'), ['controller' => 'VouchersReferences', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vouchers Reference'), ['controller' => 'VouchersReferences', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Financial Years'), ['controller' => 'FinancialYears', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Financial Year'), ['controller' => 'FinancialYears', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Challans'), ['controller' => 'Challans', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Challan'), ['controller' => 'Challans', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Purchase Accs'), ['controller' => 'LedgerAccounts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Purchase Acc'), ['controller' => 'LedgerAccounts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Creator'), ['controller' => 'Employees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Creator'), ['controller' => 'Employees', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Reference Details'), ['controller' => 'ReferenceDetails', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Reference Detail'), ['controller' => 'ReferenceDetails', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Reference Balances'), ['controller' => 'ReferenceBalances', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Reference Balance'), ['controller' => 'ReferenceBalances', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="creditNotes index large-9 medium-8 columns content">
    <h3><?= __('Credit Notes') ?></h3>
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
            <?php foreach ($creditNotes as $creditNote): ?>
            <tr>
                <td><?= $this->Number->format($creditNote->id) ?></td>
                <td><?= h($creditNote->voucher_no) ?></td>
                <td><?= h($creditNote->created_on) ?></td>
                <td><?= h($creditNote->transaction_date) ?></td>
                <td><?= $this->Number->format($creditNote->customer_suppiler_id) ?></td>
                <td><?= $creditNote->has('company') ? $this->Html->link($creditNote->company->name, ['controller' => 'Companies', 'action' => 'view', $creditNote->company->id]) : '' ?></td>
                <td><?= $creditNote->has('creator') ? $this->Html->link($creditNote->creator->name, ['controller' => 'Employees', 'action' => 'view', $creditNote->creator->id]) : '' ?></td>
                <td><?= $this->Number->format($creditNote->edited_by) ?></td>
                <td><?= h($creditNote->edited_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $creditNote->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $creditNote->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $creditNote->id], ['confirm' => __('Are you sure you want to delete # {0}?', $creditNote->id)]) ?>
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
