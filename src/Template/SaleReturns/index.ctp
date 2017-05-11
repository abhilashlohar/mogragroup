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
							<th>Date</th>
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
							<td><?= h(($saleReturn->sr1.'/IN-'.str_pad($saleReturn->sr2, 3, '0', STR_PAD_LEFT).'/'.$saleReturn->sr3.'/'.$saleReturn->sr4)) ?></td>
							
							<td><?php echo date("d-m-Y",strtotime($saleReturn->date_created)); ?></td>
							<td><?= h($saleReturn->total_after_pnf) ?></td>
							<td class="actions">
								<?php
								echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',['action' => 'edit', $saleReturn->id,],array('escape'=>false,'class'=>'btn btn-xs blue tooltips','data-original-title'=>'Edit')); 
								 ?>
								
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

