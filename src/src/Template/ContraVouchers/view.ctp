<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Contra Voucher'), ['action' => 'edit', $contraVoucher->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Contra Voucher'), ['action' => 'delete', $contraVoucher->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contraVoucher->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Contra Vouchers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Contra Voucher'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Contra Voucher Rows'), ['controller' => 'ContraVoucherRows', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Contra Voucher Row'), ['controller' => 'ContraVoucherRows', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="contraVouchers view large-9 medium-8 columns content">
    <h3><?= h($contraVoucher->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Payment Mode') ?></th>
            <td><?= h($contraVoucher->payment_mode) ?></td>
        </tr>
        <tr>
            <th><?= __('Company') ?></th>
            <td><?= $contraVoucher->has('company') ? $this->Html->link($contraVoucher->company->name, ['controller' => 'Companies', 'action' => 'view', $contraVoucher->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Cheque No') ?></th>
            <td><?= h($contraVoucher->cheque_no) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($contraVoucher->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Voucher No') ?></th>
            <td><?= $this->Number->format($contraVoucher->voucher_no) ?></td>
        </tr>
        <tr>
            <th><?= __('Bank Cash Id') ?></th>
            <td><?= $this->Number->format($contraVoucher->bank_cash_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created By') ?></th>
            <td><?= $this->Number->format($contraVoucher->created_by) ?></td>
        </tr>
        <tr>
            <th><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($contraVoucher->edited_by) ?></td>
        </tr>
        <tr>
            <th><?= __('Created On') ?></th>
            <td><?= h($contraVoucher->created_on) ?></td>
        </tr>
        <tr>
            <th><?= __('Transaction Date') ?></th>
            <td><?= h($contraVoucher->transaction_date) ?></td>
        </tr>
        <tr>
            <th><?= __('Edited On') ?></th>
            <td><?= h($contraVoucher->edited_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Contra Voucher Rows') ?></h4>
        <?php if (!empty($contraVoucher->contra_voucher_rows)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Contra Voucher Id') ?></th>
                <th><?= __('Received From Id') ?></th>
                <th><?= __('Amount') ?></th>
                <th><?= __('Cr Dr') ?></th>
                <th><?= __('Narration') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($contraVoucher->contra_voucher_rows as $contraVoucherRows): ?>
            <tr>
                <td><?= h($contraVoucherRows->id) ?></td>
                <td><?= h($contraVoucherRows->contra_voucher_id) ?></td>
                <td><?= h($contraVoucherRows->received_from_id) ?></td>
                <td><?= h($contraVoucherRows->amount) ?></td>
                <td><?= h($contraVoucherRows->cr_dr) ?></td>
                <td><?= h($contraVoucherRows->narration) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ContraVoucherRows', 'action' => 'view', $contraVoucherRows->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ContraVoucherRows', 'action' => 'edit', $contraVoucherRows->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ContraVoucherRows', 'action' => 'delete', $contraVoucherRows->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contraVoucherRows->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
