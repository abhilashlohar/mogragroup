<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel uppercase">Goods Receipt Note</span>
			<?php if($pull_request=="true"){ ?>
			: Select a GRN to Book Invoice
			<?php } ?>
		</div>
		<div class="actions">
			<div class="btn-group">
			<?php
			if($status==null or $status=='Pending'){ $class1='btn btn-primary'; }else{ $class1='btn btn-default'; }
			if($status=='Invoice-Booked'){ $class2='btn btn-primary'; }else{ $class2='btn btn-default'; }
			?>
				<?= $this->Html->link(
					'Pending',
					'/Grns/index/Pending',
					['class' => $class1]
				); ?>
				<?= $this->Html->link(
					'Invoice-Booked',
					'/Grns/index/Invoice-Booked',
					['class' => $class2]
				); ?>
			<?php  ?>
			</div>
		</div>
	</div>
	<div class="portlet-body">
		<div class="row">
			<form method="GET" >
				<input type="hidden">
				<table class="table table-condensed">
					<thead>
						<tr>
							<th>GRN No</th>
							<th>Supplier </th>
							<th>Date </th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					
						<tr>
							<td>
								<div class="row">

									<div class="col-md-5">
										<div class="input-group" >
											<span class="input-group-addon">GRN-</span><input type="text" name="grn_no" class="form-control input-sm" placeholder="GRN No" value="<?php echo @$grn_no; ?>">
										</div>
									</div>
									<div class="col-md-5">
										<input type="text" name="file" class="form-control input-sm" placeholder="File" value="<?php echo @$file; ?>">
									</div>
									<div class="col-md-2"></div>
								</div>
							</td>
							<td><input type="text" name="vendor" class="form-control input-sm" placeholder="Party" value="<?php echo @$vendor; ?>"></td>
							<td>
								<div class="row">
									<div class="col-md-6">
										<input type="text" name="From" class="form-control input-sm date-picker" placeholder="From" value="<?php echo @$From; ?>" data-date-format="dd-mm-yyyy" >
									</div>
									<div class="col-md-6">
										<input type="text" name="To" class="form-control input-sm date-picker" placeholder="To" value="<?php echo @$To; ?>" data-date-format="dd-mm-yyyy" >
									</div>
								</div>
							</td>
							
							<td><button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-filter"></i> Filter</button></td>
						</tr>
					</tbody>
				</table>
			</form>
			<div class="col-md-12">
				<?php $page_no=$this->Paginator->current('Invoices'); $page_no=($page_no-1)*20; ?>
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>Sr. No.</th>
							<th>GRN No.</th>
							<th>PO No.</th>
							<th>Supplier</th>
							<th>Date Created</th>
							<th class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
					
						<?php foreach ($grns as $grn): ?>
						<tr>
							<td><?= h(++$page_no) ?></td>
							<td><?= h(($grn->grn1.'/GRN-'.str_pad($grn->grn2, 3, '0', STR_PAD_LEFT).'/'.$grn->grn3.'/'.$grn->grn4)) ?></td>
							<td><?= h(($grn->purchase_order->po1.'/PO-'.str_pad($grn->purchase_order->po2, 3, '0', STR_PAD_LEFT).'/'.$grn->purchase_order->po3.'/'.$grn->purchase_order->po4)) ?></td>
							<td><?= h($grn->vendor->company_name) ?></td>
							<td><?php echo date("d-m-Y",strtotime($grn->date_created)); ?></td>
							<td class="actions">
							<?php if($pull_request=="true"){
									echo $this->Html->link('<i class="fa fa-repeat"></i>  Convert Into Book Invoice','/InvoiceBookings/Add?grn='.$grn->id,array('escape'=>false,'class'=>'btn btn-xs default blue-stripe'));
								} else { ?>
							<?php if(in_array(35,$allowed_pages)){ ?>
							<?php echo $this->Html->link('<i class="fa fa-search"></i>',['action' => 'view', $grn->id],array('escape'=>false,'target'=>'_blank','class'=>'btn btn-xs yellow tooltips','data-original-title'=>'View '));  ?>	
							 <?php } ?>
							<?php if($status!='Invoice-Booked' and in_array(16,$allowed_pages)){ ?>
							<?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',['action' => 'EditNew', $grn->id],array('escape'=>false,'class'=>'btn btn-xs blue tooltips','data-original-title'=>'Edit'));?> <?php } ?>
                             <?php } ?>
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
