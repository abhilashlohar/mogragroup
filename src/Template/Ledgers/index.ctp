<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel uppercase">Ledger Account</span>
		</div>

	<div class="portlet-body form">
	<div class="row ">
		<div class="col-md-12">
		<form method="GET" >
			<table class="table table-condensed">
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
						<td>
							<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-filter"></i> Filter</button>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
		<!-- BEGIN FORM-->
		<?php $page_no=$this->Paginator->current('Ledgers'); $page_no=($page_no-1)*20; ?>
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th width="10%">Transaction Date</th>
						<th width="10%">Ledger Account</th>
						<th width="10%">Source</th>
						<th width="10%">Reference</th>
						<th width="5%">Debit</th>
						<th width="5%">Credit</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($ledgers as $ledger): 
				$url_path="";
				if($ledger->voucher_source=="Journal Voucher"){
					$url_path="/JournalVouchers/view/".$ledger->voucher_id;
				}else if($ledger->voucher_source=="Payment Voucher"){
					$url_path="/PaymentVouchers/view/".$ledger->voucher_id;
				}else if($ledger->voucher_source=="PettyCashReceipt Voucher"){
					$url_path="/petty-cash-receipt-vouchers/view/".$ledger->voucher_id;
				}else if($ledger->voucher_source=="Contra Voucher"){
					$url_path="/contra-vouchers/view/".$ledger->voucher_id;
				}else if($ledger->voucher_source=="Receipt Voucher"){
					$url_path="/receipt-vouchers/view/".$ledger->voucher_id;
				}
				
				?>
					<tr>
						<td><?php echo date("d-m-Y",strtotime($ledger->transaction_date)); ?></td>
						<td><?= h($ledger->ledger_account->name); ?></td>
						<td><?= h($ledger->voucher_source); ?></td>
						<td>
						<?php if(!empty($url_path)){
								echo $this->Html->link(str_pad($ledger->voucher_id,4,'0',STR_PAD_LEFT),$url_path,['target' => '_blank']);
							}else{
								echo str_pad($ledger->voucher_id,4,'0',STR_PAD_LEFT);
							}
						
						?>
						</td>
						<td ><?= $this->Number->format($ledger->debit) ?></td>
						<td ><?= $this->Number->format($ledger->credit) ?></td>
				</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
				
			<div class="paginator">
				<ul class="pagination">
					<?= $this->Paginator->prev('<') ?>
					<?= $this->Paginator->numbers() ?>
					<?= $this->Paginator->next('>') ?>
				</ul>
				<p><?= $this->Paginator->counter() ?></p>
			</div>
		</div>
	</div>
  </div>
</div>
</div>