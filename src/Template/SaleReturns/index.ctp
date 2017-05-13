<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel uppercase">Invoices</span> 
			
		</div>
		<div class="actions">
	
		</div>
	</div>
	<div class="portlet-body">
		<div class="row">
			<div class="col-md-12">
				<?php $page_no=$this->Paginator->current('Invoices'); $page_no=($page_no-1)*20; ?>
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>Sr. No.</th>
							<th>Voucher No.</th>
							<th>Invoice No.</th>
							<th>Date Created</th>
							<th>Total</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($saleReturns as $saleReturn): 
						//pr($saleReturn); 
						?>
						<tr>
							<td><?= h(++$page_no) ?></td>
							<td><?= h('#'.str_pad($saleReturn->sr2, 4, '0', STR_PAD_LEFT)) ?></td>
							<td><?= h(($saleReturn->sr1.'/IN-'.str_pad($saleReturn->sr2, 3, '0', STR_PAD_LEFT).'/'.$saleReturn->sr3.'/'.$saleReturn->sr4)) ?></td>
							
							<td><?php echo date("d-m-Y",strtotime($saleReturn->date_created)); ?></td>
							<td><?= h($saleReturn->total_after_pnf) ?></td>
							<td class="actions"></td>
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

