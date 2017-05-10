<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel uppercase">Invoice Book</span>
			
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
							<th>Invoice Booking No.</th>
							<th>GRN No.</th>
							<th>Invoice No.</th>
							<th>Invoice Booked On</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($invoiceBookings as $invoiceBooking):
						if($invoiceBooking->grn->status=='Converted Into Invoice Booking'){ $tr_color='#f4f4f4'; }
						if($invoiceBooking->grn->status=='Pending'){ $tr_color='#FFF'; }
					?>
						<tr>
							<td><?= h(++$page_no) ?></td>
							<td><?php echo $invoiceBooking->ib1.'/IB-'.str_pad($invoiceBooking->ib2, 3, '0', STR_PAD_LEFT).'/'.$invoiceBooking->ib3.'/'.$invoiceBooking->ib4; ?></td>
							<td><?= h(($invoiceBooking->grn->grn1.'/GRN-'.str_pad($invoiceBooking->grn->grn2, 3, '0', STR_PAD_LEFT).'/'.$invoiceBooking->grn->grn3.'/'.$invoiceBooking->grn->grn4)) ?></td>
							
							<td><?= h($invoiceBooking->invoice_no) ?></td>
							<td><?php echo date("d-m-Y",strtotime($invoiceBooking->created_on)) ?></td>
							<td class="actions">
								<?php if(in_array(18,$allowed_pages)){ ?>
								<?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',['action' => 'edit', $invoiceBooking->id,],array('escape'=>false,'class'=>'btn btn-xs blue tooltips','data-original-title'=>'Edit')); ?>
								<?php } ?>
								<?php if(in_array(123,$allowed_pages)){ ?>
                                <?php echo $this->Html->link('<i class="fa fa-search"></i>',['action' => 'view', $invoiceBooking->id,],array('escape'=>false,'target'=>'_blank','class'=>'btn btn-xs yellow tooltips','data-original-title'=>'View')); ?>
                                <?php } ?>
								<?php if($purchase_return=="true"){
								echo $this->Html->link('<i class="fa fa-repeat"></i>  Purchase Return','/PurchaseReturns/Add?invoiceBooking='.$invoiceBooking->id,array('escape'=>false,'class'=>'btn btn-xs default blue-stripe'));
								} ?>
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

