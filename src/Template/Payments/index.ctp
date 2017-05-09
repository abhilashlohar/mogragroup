<?php //pr($pettyCashReceiptVouchers); exit; ?>
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel uppercase">Payment Vouchers</span>
		</div>
<<<<<<< HEAD
	</div>
	<div class="portlet-body">
		<div class="row">
			<div class="col-md-12">
=======
	
	<div class="portlet-body">
		<div class="row">
			<div class="col-md-12">
			<form method="GET" >
			
				<table class="table table-condensed">
					<tbody>
						<tr>
						<td>
								<div class="row">
									<div class="col-md-6">
										<input type="text" name="From" class="form-control input-sm date-picker" placeholder="Transaction From" value="<?php echo @$From; ?>" data-date-format="dd-mm-yyyy" >
									</div>
									<div class="col-md-6">
										<input type="text" name="To" class="form-control input-sm date-picker" placeholder="Transaction To" value="<?php echo @$To; ?>" data-date-format="dd-mm-yyyy" >
									</div>
								</div>
							</td>
							
							<td>
								
								<div class="row">
                                									<div class="col-md-12">
										<input type="text" name="vouch_no" class="form-control input-sm" placeholder="Voucher No" value="<?php echo @$vouch_no; ?>">
								</div>
								</div>
							</td>
							
							<td><button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-filter"></i> Filter</button></td>
						</tr>
					</tbody>
				</table>
				</form>
>>>>>>> origin/master
				<?php $page_no=$this->Paginator->current('Payments'); $page_no=($page_no-1)*20; ?>
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>Sr. No.</th>
							<th>Transaction Date</th>
							<th>Vocher No</th>
							<th>Amount</th>
							<th class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0; foreach ($payments as $payment): $i++; 
						
					?>
						<tr>
							<td><?= h(++$page_no) ?></td>
							<td><?= h(date("d-m-Y",strtotime($payment->transaction_date)))?></td>
							<td><?= h('#'.str_pad($payment->voucher_no, 4, '0', STR_PAD_LEFT)) ?></td>
							<td><?= h($payment->payment_rows[0]->total_dr-$payment->payment_rows[0]->total_cr) ?></td>
							<td class="actions">
							<?php echo $this->Html->link('<i class="fa fa-search"></i>',['action' => 'view', $payment->id],array('escape'=>false,'target'=>'_blank','class'=>'btn btn-xs yellow tooltips','data-original-title'=>'View ')); ?>
							 <?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',['action' => 'edit', $payment->id],array('escape'=>false,'class'=>'btn btn-xs blue tooltips','data-original-title'=>'Edit')); ?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
<<<<<<< HEAD
=======
				</div>
				</div>
				</div>
>>>>>>> origin/master
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
<<<<<<< HEAD
	</div>
</div>
=======
	
>>>>>>> origin/master
