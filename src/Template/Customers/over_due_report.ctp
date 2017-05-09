<?php //pr($customers); exit;?>
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel uppercase">CUSTOMERS</span>
		</div>
	</div>
	<div class="portlet-body">
		<div class="table-scrollable">
			<?php $page_no=$this->Paginator->current('Customers'); $page_no=($page_no-1)*20; ?>
			 <table class="table table-hover">
				 <thead>
					<tr>
						<th>Sr. No.</th>
						<th>Customer Name</th>
						<th>Over-Due</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($LedgerAccounts as $LedgerAccount){ 
					//pr($customer->id); exit;
					$due=0;
					$total_credit=0;
					$total_debit=0;
						foreach($ReferenceDetails as $ReferenceDetail){
							//pr($ReferenceDetail->ledger_account_id); 
							if($ReferenceDetail->ledger_account_id==$LedgerAccount->id){
								if($ReferenceDetail->credit==0){
								$total_debit+=$ReferenceDetail->debit;
								}else{
								$total_credit+=$ReferenceDetail->credit;
								}
							
						}
						$due=$total_credit-$total_debit;
						} ?>
					<tr>
						<td><?= h(++$page_no) ?></td>
						<td><?= h($LedgerAccount->name) ?></td>
						<td>
						<?=$this->Number->format($due,[ 'places' => 2]);
						 ?>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
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