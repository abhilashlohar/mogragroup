<?php //pr($pettyCashReceiptVouchers); exit; ?>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-globe font-blue-steel"></i>
            <span class="caption-subject font-blue-steel uppercase">Debit Note</span>
        </div>
    
    <div class="portlet-body">
        <div class="row">
            <div class="col-md-12">
                <?php $page_no=$this->Paginator->current('DebitNotes'); $page_no=($page_no-1)*20; ?>
				 <table class='table table-hover'cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th><?= $this->Paginator->sort('id') ?></th>
							<th><?= $this->Paginator->sort('voucher_no') ?></th>
							<th><?= $this->Paginator->sort('created_on') ?></th>
							<th><?= $this->Paginator->sort('transaction_date') ?></th>
							<th><?= $this->Paginator->sort('customer_suppiler_id') ?></th>
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
						    <td class="actions">
								<?= $this->Html->link(__('View'), ['action' => 'view', $debitNote->id]) ?>
								<?= $this->Html->link(__('Edit'), ['action' => 'edit', $debitNote->id]) ?>
								<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $debitNote->id], ['confirm' => __('Are you sure you want to delete # {0}?', $debitNote->id)]) ?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
                </div>
            </div>
        </div>
                <div class="paginator">
                    <ul class="pagination">
                        <?= $this->Paginator->prev('< ' . __('previous')) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next(__('next') . ' >') ?>
                    </ul>
                    <p><?= $this->Paginator->counter() ?></p>
                </div>
            </div>
        </div>