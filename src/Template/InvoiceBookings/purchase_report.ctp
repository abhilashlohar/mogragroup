

<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel uppercase">Purchase Report</span>
		</div>
		<div class="actions">
			
			<?php echo $this->Html->link('Sales Report','/Invoices/salesReport',array('escape'=>false,'class'=>'btn btn-default')); ?>
			<?php echo $this->Html->link('Sales Return Report','/SaleReturns/salesReturnReport',array('escape'=>false,'class'=>'btn btn-default')); ?>
			<?php echo $this->Html->link('Purchase Report','/InvoiceBookings/purchaseReport',array('escape'=>false,'class'=>'btn btn-primary')); ?>
			<?php echo $this->Html->link('Purchase Return Report','/PurchaseReturns/purchaseReturnReport',array('escape'=>false,'class'=>'btn btn-default')); ?>
		</div>
		
	</div>
	<div class="portlet-body form">
	<form method="GET" >
				<table class="table table-condensed" style="width:90%;">
				<tbody>
					<tr>
					<td>
						<div class="row">
							<div class="col-md-3">
								<input type="text" name="From" class="form-control input-sm date-picker" placeholder="Transaction From" value="<?php echo @$From; ?>"  data-date-format="dd-mm-yyyy" >
							</div>
							<div class="col-md-3">
								<input type="text" name="To" class="form-control input-sm date-picker" placeholder="Transaction To" value="<?php echo @$To; ?>"  data-date-format="dd-mm-yyyy" >
							</div>
							<div class="col-md-3">
								<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-filter"></i> Filter</button>
							</div>
						</div>
					</td>
					
					</tr>
				</tbody>
			</table>
			</form>
		<!-- BEGIN FORM-->
		<div class="row ">
		
		<div class="col-md-12">
		
		 <?php $page_no=$this->Paginator->current('Ledgers'); $page_no=($page_no-1)*20; ?>
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>Sr.No.</th>
						<th>Invoice No</th>
						<th>Date</th>
						<th>Supplier</th>
						<th>Purchase @ 5.50 %</th>
						<th>VAT @5.50 %</th>
						<th>Purchase @ 14.50 %</th>
						<th>VAT @14.50 %</th>
						<th>Purchase @ 5.00 %</th>
						<th>VAT @5.00 %</th>
					</tr>
				</thead>
				<tbody><?php $sales5=0; $vat5=0; $sales14=0; $vat14=0; $sales2=0; $vat2=0; $sales0=0; ?>
				<?php foreach ($InvoiceBookings as $InvoiceBooking): 
				if($InvoiceBooking->purchase_ledger_account !=35){ 
				?>
					<tr>
						<td><?= h(++$page_no) ?></td>
							<td><?= h(($InvoiceBooking->ib1.'/IN-'.str_pad($InvoiceBooking->ib2, 3, '0', STR_PAD_LEFT).'/'.$InvoiceBooking->ib3.'/'.$InvoiceBooking->ib4)) ?></td>
							<td><?php echo date("d-m-Y",strtotime($InvoiceBooking->created_on)); ?></td>
							<td><?= h($InvoiceBooking->vendor->company_name) ?></td>
							<?php $purchase5=0; $vat5=0; $purchase14=0; $vat14=0; $purchase2=0; $vat2=0; ?>
							<?php foreach($InvoiceBooking->invoice_booking_rows as $invoice_booking_row ) {?>
								<?php if($invoice_booking_row->sale_tax==5.00){
									$total_amt=($invoice_booking_row->amount*$invoice_booking_row->sale_tax)/100;
									$vat5=$vat5+$total_amt;
								}else if($invoice_booking_row->sale_tax==14.5){
									$total_amt=($invoice_booking_row->amount*$invoice_booking_row->sale_tax)/100;
									$vat14=$vat14+$total_amt;
								} else if($invoice_booking_row->sale_tax==5.50){ 
									$total_amt=($invoice_booking_row->amount*$invoice_booking_row->sale_tax)/100;
									$vat2=$vat2+$total_amt;
									
								}
								?>
							<?php }?>
							<?php //pr($vat2);  ?>
							<td></td>
							<td><?php if($invoice_booking_row->sale_tax==5.50){
								echo $vat2;
							}else{
								echo "-";
							} ?></td>
							<td></td>
							<td><?php if($invoice_booking_row->sale_tax==14.5){
								echo $vat14;
							}else{
								echo "-";
							} ?>
							</td>
							<td></td>
							<td><?php if($invoice_booking_row->sale_tax==5.0){
								echo $vat5;
							}else{
								echo "-";
							} ?>
							</td>
							
							
				</tr>
				<?php } ?>
				<?php endforeach; ?>
				<tr>
					<td colspan="4" align="right">Total</td>
					<td><?php echo $sales5; ?></td>
					<td><?php echo $vat5; ?></td>
					<td><?php echo $sales14; ?></td>
					<td><?php echo $vat14; ?></td>
					<td><?php echo $sales2; ?></td>
					<td><?php echo $vat2; ?></td>
					<td><?php echo $sales0; ?></td>
				</tr>
				</tbody>
			</table>
			</div>
		
		</div>
		
		
		<!-- END FORM-->


</div>