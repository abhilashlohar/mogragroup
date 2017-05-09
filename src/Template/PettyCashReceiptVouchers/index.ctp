<?php //pr($pettyCashReceiptVouchers); exit; ?>
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel uppercase">Petty Cash Receipt Vouchers</span>
		</div>
	</div>
	<div class="portlet-body">
		<div class="row">
			<div class="col-md-12">
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>Voucher Date</th>
							<th>Voucher No</th>
							<th>Received From</th>
							<th>Bank/Cash</th>
							<th>Payment Mode</th>
							<th>Amount</th>
							<th class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						
						<?php $i=0; foreach ($pettyCashReceiptVouchers as $pettyCashReceiptVoucher): $i++; 
						$receivedFrom=$pettyCashReceiptVoucher->ReceivedFrom->name;
						$bankCashes=$pettyCashReceiptVoucher->BankCash->name;
					?>
						<tr>
							
							<td><?= h(date("d-m-Y",strtotime($pettyCashReceiptVoucher->transaction_date)))?>
							<td><?= h('#'.str_pad($pettyCashReceiptVoucher->voucher_no, 4, '0', STR_PAD_LEFT)) ?></td>
							<td><?= h($receivedFrom) ?></td>
							<td><?= h($bankCashes) ?></td>
							<td><?= h($pettyCashReceiptVoucher->payment_mode) ?></td>
							<td><?= ($pettyCashReceiptVoucher->amount) ?></td>
							
							<td class="actions">
							<?php echo $this->Html->link('<i class="fa fa-search"></i>',['action' => 'view', $pettyCashReceiptVoucher->id],array('escape'=>false,'target'=>'_blank','class'=>'btn btn-xs yellow tooltips','data-original-title'=>'View ')); ?>
							<?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',['action' => 'edit', $pettyCashReceiptVoucher->id],array('escape'=>false,'class'=>'btn btn-xs blue tooltips','data-original-title'=>'Edit')); 
							
							/* $this->Form->postLink('<i class="fa fa-trash"></i> ',
								['action' => 'delete',$pettyCashReceiptVoucher->id], 
								[
									'escape' => false,
									'class' => 'btn btn-xs btn-danger',
									'confirm' => __('Are you sure ?', $pettyCashReceiptVoucher->id)
								]
							) */ 
							?>
							
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
		</div>
	</div>
</div>

