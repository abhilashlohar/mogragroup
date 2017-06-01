

<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel uppercase">Sales Report</span>
		</div>
		<div class="actions">
			
			<?php $today =date('d-m-Y'); echo $this->Html->link('<i class="fa fa-puzzle-piece"></i> Sales Report',array('controller'=>'Invoices','action'=>'salesReport','From'=>$today,'To'=>$today),array('escape'=>false,'class'=>'btn btn-primary')); ?>
			<?php echo $this->Html->link('Sales Return Report','/SaleReturns/salesReturnReport',array('escape'=>false,'class'=>'btn btn-default')); ?>
			<?php echo $this->Html->link('Purchase Report','/InvoiceBookings/purchaseReport',array('escape'=>false,'class'=>'btn btn-default')); ?>
			<?php echo $this->Html->link('Purchase Return Report','/PurchaseReturns/purchaseReturnReport',array('escape'=>false,'class'=>'btn btn-default')); ?>
		</div>
		
	
	<div class="portlet-body form">
	<form method="GET" >
				<table class="table table-condensed">
				<tbody>
					<tr>
					<td>
						<div class="row">
							<div class="col-md-3">
								<input type="text" name="From" class="form-control input-sm date-picker" placeholder="Transaction From" value="<?php echo @date('d-m-Y', strtotime($From));  ?>"  data-date-format="dd-mm-yyyy" >
							</div>
							<div class="col-md-3">
								<input type="text" name="To" class="form-control input-sm date-picker" placeholder="Transaction To" value="<?php echo @date('d-m-Y', strtotime($To));  ?>"  data-date-format="dd-mm-yyyy" >
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
						<th>Customer</th>
						<th>Sales @ 5.50 %</th>
						<th>VAT @5.50 %</th>
						<th>Sales @ 14.50 %</th>
						<th>VAT @14.50 %</th>
						<th>2 % CST Sale</th>
						<th>CST @ 2 %</th>
						<th>Sale NIL Tax</th>
					</tr>
				</thead>
				<tbody><?php $sales5=0; $vat5=0; $sales14=0; $vat14=0; $sales2=0; $vat2=0; $sales0=0; ?>
				<?php foreach ($invoices as $invoice): ?>
					<tr>
						<td><?= h(++$page_no) ?></td>
							<td><?= h(($invoice->in1.'/IN-'.str_pad($invoice->in2, 3, '0', STR_PAD_LEFT).'/'.$invoice->in3.'/'.$invoice->in4)) ?></td>
							<td><?php echo date("d-m-Y",strtotime($invoice->date_created)); ?></td>
							<td><?php echo $invoice->customer->customer_name.'('.$invoice->customer->alias.')'?></td>
							<td><?php if($invoice->sale_tax_per==5.50){
								echo $invoice->total;
								$sales5=$sales5+$invoice->total;
							}else{
								echo "-";
							} ?>
							</td>
							<td><?php if($invoice->sale_tax_per==5.50){
								echo $invoice->sale_tax_amount;
								$vat5=$vat5+$invoice->sale_tax_amount;
							}else{
								echo "-";
							} ?></td>
							<td><?php if($invoice->sale_tax_per==14.50){
								echo $invoice->total;
								$sales14=$sales14+$invoice->total;
							}else{
								echo "-";
							} ?>
							</td>
							<td><?php if($invoice->sale_tax_per==14.50){
								echo $invoice->sale_tax_amount;
								$vat14=$vat14+$invoice->sale_tax_amount;
							}else{
								echo "-";
							} ?></td>
							<td><?php if($invoice->sale_tax_per==2.00){
								echo $invoice->total;
								$sales2=$sales2+$invoice->total;
							}else{
								echo "-";
							} ?>
							</td>
							<td><?php if($invoice->sale_tax_per==2.00){
								echo $invoice->sale_tax_amount;
								$vat2=$vat2+$invoice->sale_tax_amount;
							}else{
								echo "-";
							} ?></td>
							<td><?php if($invoice->sale_tax_per==0.00){
								echo $invoice->total;
								$sales0=$sales0+$invoice->total;
							}else{
								echo "-";
							} ?></td>
				</tr>
				<?php endforeach; ?>
				<tr>
					<td colspan="4" align="right">Total</td>
					<td><?php echo number_format($sales5,2,'.',','); ?></td>
					<td><?php echo number_format($vat5,2,'.',','); ?></td>
					<td><?php echo number_format($sales14,2,'.',','); ?></td>
					<td><?php echo number_format($vat14,2,'.',','); ?></td>
					<td><?php echo number_format($sales2,2,'.',','); ?></td>
					<td><?php echo number_format($vat2,2,'.',','); ?></td>
					<td><?php echo number_format($sales0,2,'.',','); ?></td>
				</tr>
				</tbody>
			</table>
			</div>
		</div>
		</div>
		
		
		<!-- END FORM-->


</div>