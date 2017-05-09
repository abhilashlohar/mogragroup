
<?php 

	if(!empty($status)){
		$url_excel=$status."/?".$url;
	}else{
		$url_excel="/?".$url;
	}

?>

<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel uppercase">Purchase Orders</span>
			<?php if($pull_request=="true"){ ?>
			: Select a Purchase-Order to convert into Grn
			<?php } ?>
		</div>
		<div class="actions">
			<div class="btn-group">
			<?php
			if($status==null or $status=='Pending'){ $class1='btn btn-primary'; }else{ $class1='btn btn-default'; }
			if($status=='Converted-Into-GRN'){ $class2='btn btn-primary'; }else{ $class2='btn btn-default'; }
			?>
			<?php if($pull_request!="true"){ ?>
				<?= $this->Html->link(
					'Pending',
					'/Purchase-Orders/index/Pending',
					['class' => $class1]
				); ?>
				<?= $this->Html->link(
					'Converted-Into-GRN',
					'/Purchase-Orders/index/Converted-Into-GRN',
					['class' => $class2]
				); ?>
			<?php } ?>
			</div>
		</div>
	</div>
	
	<div class="portlet-body">
		<div class="row">
			<div class="col-md-12">
			<form method="GET" >
				<input type="hidden" name="inventory_voucher" value="<?php echo @$inventory_voucher; ?>">
				<table class="table table-condensed">
					<thead>
						<tr>
							<th>Purchase No</th>
							<th>Party </th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					
						<tr>
							<td>
								<div class="row">

									<div class="col-md-5">
										<div class="input-group" style="" id="pnf_text">
											<span class="input-group-addon">PO-</span><input type="text" name="purchase_no" class="form-control input-sm" placeholder="Purchase No" value="<?php echo @$purchase_no; ?>">
										</div>
									</div>
									<div class="col-md-5">
										<input type="text" name="file" class="form-control input-sm" placeholder="File" value="<?php echo @$file; ?>">
									</div>
									<div class="col-md-2"></div>
								</div>
							</td>
							<td><input type="text" name="vendor" class="form-control input-sm" placeholder="Party" value="<?php echo @$vendor; ?>"></td>
							
							<td><button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-filter"></i> Filter</button></td>
						</tr>
					</tbody>
				</table>
				</form>
				<?php $page_no=$this->Paginator->current('Purchase Orders'); $page_no=($page_no-1)*20; ?>
				<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>S.No</th>
								<th>Purchase No.</th>
								<th>Party Name</th>
								<th style="text-align:right">Total</th>
								
								<th class="actions"><?= __('Actions') ?></th>
							</tr>
					
					</thead>

					<tbody>
						<?php foreach ($purchaseOrders as $purchaseOrder): 
?>
						<tr>
							<td><?= h(++$page_no) ?></td>
							
							<td><?= h(($purchaseOrder->po1.'/PO-'.str_pad($purchaseOrder->po2, 3, '0', STR_PAD_LEFT).'/'.$purchaseOrder->po3.'/'.$purchaseOrder->po4)) ?></td>
							
							<td><?= h($purchaseOrder->vendor->company_name) ?></td>
							<td align="right"><?= $this->Number->format($purchaseOrder->total) ?></td>
						
							<td class="actions">
							<?php if(in_array(31,$allowed_pages)){ ?>
								<?php echo $this->Html->link('<i class="fa fa-search"></i>',['action' => 'confirm', $purchaseOrder->id],array('escape'=>false,'target'=>'_blank','class'=>'btn btn-xs yellow tooltips','data-original-title'=>'View as PDF')); ?>
							<?php } ?>
								<?php if($pull_request=="true"){
									echo $this->Html->link('<i class="fa fa-repeat"></i>  Convert Into GRN','/Grns/AddNew?purchase-order='.$purchaseOrder->id,array('escape'=>false,'class'=>'btn btn-xs default blue-stripe'));
								} ?>
								<?php if($pull_request!="true" and in_array(14,$allowed_pages)){ 
									echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',['action' => 'edit', $purchaseOrder->id],array('escape'=>false,'class'=>'btn btn-xs blue tooltips','data-original-title'=>'Edit'));} ?>

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
