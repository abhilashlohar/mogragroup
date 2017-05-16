

<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel uppercase">Ledger Account</span>
		</div>
		
	</div>
	<div class="portlet-body form">
	<form method="GET" >
				<table class="table table-condensed" style="width:90%;">
				<tbody>
					<tr>
					<td>
						<div class="row">
							<div class="col-md-6">
								<input type="text" name="From" class="form-control input-sm date-picker" placeholder="Transaction From" value="<?php echo @$From; ?>"  data-date-format="dd-mm-yyyy" >
							</div>
							<div class="col-md-6">
								<input type="text" name="To" class="form-control input-sm date-picker" placeholder="Transaction To" value="<?php echo @$To; ?>"  data-date-format="dd-mm-yyyy" >
							</div>
						</div>
					</td>
					
							
						<td><button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-filter"></i> Filter</button></td>
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
				<tbody>
				<?php foreach ($invoices as $invoice): 
			
				
				?>
					<tr>
						<td><?= h(++$page_no) ?></td>
							<td><?= h(($invoice->in1.'/IN-'.str_pad($invoice->in2, 3, '0', STR_PAD_LEFT).'/'.$invoice->in3.'/'.$invoice->in4)) ?></td>
							<td><?php echo date("d-m-Y",strtotime($invoice->date_created)); ?></td>
							<td><?= h($invoice->customer->customer_name) ?></td>
							<td><?php if($invoice->sale_tax_per==5.50){
								echo $invoice->sale_tax_amount;
							}else{
								echo "-";
							} ?>
							</td>
							<td></td>
							<td><?php if($invoice->sale_tax_per==5.50){
								echo $invoice->sale_tax_amount;
							}else{
								echo "-";
							} ?>
							</td>
				</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
			</div>
		
		</div>
		
		
		<!-- END FORM-->


</div>