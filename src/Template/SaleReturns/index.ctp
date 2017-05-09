'<?php $url_excel="/?".$url; ?>

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
				<form method="GET" >
				<input type="hidden" name="inventory_voucher" value="<?php echo @$inventory_voucher; ?>">
				<table class="table table-condensed">
					<thead>
						<tr>
							<th>Invoice No</th>
							<th>Customer</th>
							<th>Date</th>
							<th>Total</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					
						<tr>
							<td>
								<div class="row">
									<div class="col-md-4">
										<input type="text" name="company_alise" class="form-control input-sm" placeholder="Company" value="<?php echo @$company_alise; ?>">
									</div>
									<div class="col-md-4">
										<div class="input-group" style="" id="pnf_text">
											<span class="input-group-addon">IN-</span><input type="text" name="invoice_no" class="form-control input-sm" placeholder="Invoice No" value="<?php echo @$invoice_no; ?>">
										</div>
									</div>
									<div class="col-md-4">
										<input type="text" name="file" class="form-control input-sm" placeholder="File" value="<?php echo @$file; ?>">
									</div>
								</div>
							</td>
							<td><input type="text" name="customer" class="form-control input-sm" placeholder="Customer" value="<?php echo @$customer; ?>"></td>
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
							<td>
							<table>
								<tr>
									<td><input type="text" name="total_From" class="form-control input-sm" placeholder="From" value="<?php echo @$total_From; ?>" style="width: 100px;"></td>
									<td><input type="text" name="total_To" class="form-control input-sm" placeholder="To" value="<?php echo @$total_To; ?>" style="width: 100px;"></td>
								</tr>
							</table>
							</td>
							<td><button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-filter"></i> Filter</button></td>
						</tr>
					</tbody>
				</table>
				</form>
				<?php $page_no=$this->Paginator->current('Invoices'); $page_no=($page_no-1)*20; ?>
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>Sr. No.</th>
							<th>Invoice No.</th>
							<th>Customer</th>
							<th>Date</th>
							<th>Total</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($invoices as $invoice): 
						if($invoice->status=='Pending'){ $tr_color='#FFF'; }
						if($invoice->status=='Cancel'){ $tr_color='#FFF'; }
						?>
						<tr>
							<td><?= h(++$page_no) ?></td>
							<td><?= h(($invoice->in1.'/IN-'.str_pad($invoice->in2, 3, '0', STR_PAD_LEFT).'/'.$invoice->in3.'/'.$invoice->in4)) ?></td>
							<td><?= h($invoice->customer->customer_name) ?></td>
							<td><?php echo date("d-m-Y",strtotime($invoice->date_created)); ?></td>
							<td><?= h($invoice->total_after_pnf) ?></td>
							<td class="actions">
								<?php if(in_array(23,$allowed_pages)){ ?>
								<?php echo $this->Html->link('<i class="fa fa-search"></i>',['action' => 'confirm', $invoice->id],array('escape'=>false,'target'=>'_blank','class'=>'btn btn-xs yellow tooltips','data-original-title'=>'View as PDF')); ?>
								<?php } ?>
								<?php if($invoice->status !='Cancel' and $inventory_voucher!="true" and in_array(8,$allowed_pages)){
									
								if(!in_array(date("m-Y",strtotime($invoice->date_created)),$closed_month))
								 { 
								echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',['action' => 'edit', $invoice->id,],array('escape'=>false,'class'=>'btn btn-xs blue tooltips','data-original-title'=>'Edit')); 
								 }
								if( in_array(33,$allowed_pages)){
								echo $this->Html->link('<i class="fa fa-minus-circle"></i> ',['action' => '#'],array('escape'=>false,'class'=>'btn btn-xs red tooltips close_btn','data-original-title'=>'Close','role'=>'button','invoice_id'=>$invoice->id));
								}
								}?>
								<?php
								if($inventory_voucher=="true"){
								echo $this->Html->link('<i class="fa fa-repeat"></i>  Create Inventory Voucher','/Inventory-Vouchers/edit?invoice='.$invoice->id,array('escape'=>false,'class'=>'btn btn-xs default blue-stripe'));
								
								} ?><?php 
								if($sales_return=="true" && $invoice->sale_return_status=='No'){
								echo $this->Html->link('<i class="fa fa-repeat"></i>  Sale Return','/SaleReturns/Add?invoice='.$invoice->id,array('escape'=>false,'class'=>'btn btn-xs default blue-stripe'));
								}elseif($sales_return=="true" && $invoice->sale_return_status=='Yes'){
									echo $this->Html->link('<i class="fa fa-repeat"></i> Edit Sale Return','/SaleReturns/Edit?invoice='.$invoice->id,array('escape'=>false,'class'=>'btn btn-xs default blue-stripe'));
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
<script>
$( function() {
$( "#sortable" ).sortable();
$( "#sortable" ).disableSelection();
} );
</script>
<?php echo $this->Html->css('/drag_drop/jquery-ui.css'); ?>
<?php echo $this->Html->script('/drag_drop/jquery-1.12.4.js'); ?>
<?php echo $this->Html->script('/drag_drop/jquery-ui.js'); ?>

<script>
$(document).ready(function() { 
	
	$('#close_popup_btn').die().live("click",function() {
		var invoice_id=$(this).attr('invoice_id');
		var url="<?php echo $this->Url->build(['controller'=>'Invoices','action'=>'Cancel']); 
		?>";
		
		url=url+'/'+invoice_id
		$.ajax({
			url: url,
		}).done(function(response) {
			location.reload();
		});		
		
    });

	
	$('.close_btn').die().live("click",function() {
		var invoice_id=$(this).attr('invoice_id');
		$("#myModal2").show();
		$("#close_popup_btn").attr('invoice_id',invoice_id);
    });
	
	$('.closebtn2').on("click",function() { 
		$("#myModal2").hide();
    });
	
	
	
	
});	
</script>

<div id="myModal2" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="false" style="display: none; padding-right: 12px;"><div class="modal-backdrop fade in" ></div>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
			
				Are you sure you want to cancel
				
			</div>
			<div class="modal-footer">
				<button class="btn default closebtn2">Close</button>
				<button class="btn red close_rsn" id="close_popup_btn">Close Invoice</button>
			</div>
		</div>
	</div>
</div>
