<?php //pr($SalesOrders); exit; ?>


<div class="portlet light bordered">
<div class="portlet-title">
<div class="caption">
    <i class="icon-globe font-blue-steel"></i>
	<span class="caption-subject font-blue-steel uppercase">Pending Sales Order To Create Job Cards</span> 
</div>
<div class="portlet-body">
	<div class="row">
		<div class="col-md-12">
		<form method="GET" >
		<input type="hidden">
				<table class="table table-condensed">
				
					<tbody>
					
						<tr>
							<td>
								<div class="row">
									<div class="col-md-12">
										<div class="input-group" >
											<span class="input-group-addon">SO-</span><input type="text" name="so_no" class="form-control input-sm" placeholder="SO No" value="<?php echo @$so_no; ?>">
										</div>
									</div>
									
								
								</div>
							</td>
							<td>
								<div class="row">
									<div class="col-md-12">
										<div class="input-group" >
											<input type="text" name="cust_name" class="form-control input-sm" placeholder="Customer" value="<?php echo @$cust_name; ?>">
										</div>
									</div>
								
									
								</div>
							</td>
							<td><div class="row">
									<div class="col-md-6">
										<input type="text" name="Po_Date_From" class="form-control input-sm date-picker" placeholder="PO Date From" value="<?php echo @$Po_Date_From; ?>" data-date-format="dd-mm-yyyy" >
									</div>
									<div class="col-md-6">
										<input type="text" name="Po_Date_To" class="form-control input-sm date-picker" placeholder="PO Date To" value="<?php echo @$Po_Date_To; ?>" data-date-format="dd-mm-yyyy" >
									</div>
								</div></td>
							<td>
								<div class="row">
									<div class="col-md-12">
										<input type="text" name="po_no" class="form-control input-sm" placeholder="PO No" value="<?php echo @$po_no; ?>" data-date-format="dd-mm-yyyy" >
									</div>
								
								</div>
							</td>
							
							<td><button type="submit" name="save" class="btn btn-primary btn-sm"><i class="fa fa-filter"></i> Filter</button></td>
						</tr>
					</tbody>
				</table>
				</form>
			<?php $page_no=$this->Paginator->current('JobCards'); $page_no=($page_no-1)*20; ?>	 
			<table class="table table-bordered table-striped ">
				<thead>
				<tr>
					<td style="font-size:120%;">Sr.No.</td>
					<td style="font-size:120%;">Sales Order</td>
					<td style="font-size:120%;">Customer</td>
					<td style="font-size:120%;">PO Date</td>
					<td style="font-size:120%;">PO No.</td>
					<td style="font-size:120%;">Action</td>
				</tr>
				<tbody>
		    <?php foreach ($SalesOrders as $SalesOrder): ?>
				<tr>
					<td><?= h(++$page_no) ?></td>
					<td><?= h(($SalesOrder->so1.'/SO-'.str_pad($SalesOrder->so2, 3, '0', STR_PAD_LEFT).'/'.$SalesOrder->so3.'/'.$SalesOrder->so4))?></td> 
					<td><?php echo $SalesOrder->customer->customer_name; ?></td> 
					<td><?php echo date("d-m-Y",strtotime($SalesOrder->po_date)); ?></td> 
					<td><?php echo $SalesOrder->customer_po_no; ?></td> 
					
					<td class="actions">
						<?php if(sizeof($SalesOrder->job_card)==0){
							if(sizeof($SalesOrder->sales_order_rows)>0){
								echo $this->Html->link('<i class="fa fa-repeat "></i>  Create Job Card','/JobCards/Pre-Add?sales-order='.$SalesOrder->id,array('escape'=>false,'class'=>'btn btn-xs default blue-stripe'));
							}else{
								echo $this->Html->link('<i class="fa fa-repeat "></i>  Create Job Card','/JobCards/Add?sales-order='.$SalesOrder->id,array('escape'=>false,'class'=>'btn btn-xs default blue-stripe'));
							}
						}else{
							if(sizeof($SalesOrder->sales_order_rows)>0){
								echo $this->Html->link('<i class="fa fa-repeat "></i>  Edit Job Card','/JobCards/Pre-Edit?job-card='.$SalesOrder->job_card->id.'&sales-order='.$SalesOrder->id,array('escape'=>false,'class'=>'btn btn-xs default blue-stripe'));
							}else{
								echo $this->Html->link('<i class="fa fa-repeat "></i> Edit Job Card',['action' => 'edit', $SalesOrder->job_card->id],array('escape'=>false,'class'=>'btn btn-xs default blue-stripe'));
							}
						} ?>
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
 
 