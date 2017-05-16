<?php //pr($customers); exit;?>
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel uppercase">Supplier</span>
		</div>
	</div>
	<div class="portlet-body">
		<div class="table-scrollable">
			<?php $page_no=$this->Paginator->current('Vendors'); $page_no=($page_no-1)*20; ?>
			 <table class="table table-hover">
				 <thead>
					<tr>
						<th>Sr. No.</th>
						<th>Supplier Name</th>
						<th>Over-Due</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($over_due_report as $key=>$over_due_reports){ 
						if($over_due_reports>0){
					?>
					<tr>
						<td><?= h(++$page_no) ?></td>
						<td><?= h($company_name[$key]);?></td>
						<td><?= h($over_due_reports) ?></td>
						
					</tr>
					<?php }} ?>
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