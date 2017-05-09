<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel uppercase">Stock Report</span>
		</div>
		<div class="portlet-body">
			<div class="row">
				<div class="col-md-12">
				<form method="GET" >
				<table width="30%">
					<tbody>
						<tr>
							<td><input type="text" name="item_name" class="form-control input-sm" placeholder="Item Name" value="<?php echo @$item_name; ?>"></td>
							<td><button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-filter"></i> Filter</button></td>
						</tr>
					</tbody>
				</table>
				</form>
				<?php $page_no=$this->Paginator->current('ItemLedgers'); $page_no=($page_no-1)*20; ?>
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>Sr. No.</th>
							<th><?= $this->Paginator->sort('item_id') ?></th>
							<th>Current Stock</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($itemLedgers as $itemLedger): ?>
						<tr>
							<td><?= h(++$page_no) ?></td>
							<td><?= $this->Html->link($itemLedger->item->name, ['controller' => 'ItemLedgers', 'action' => 'index', $itemLedger->item->id]) ?></td>
							<td><?= h($itemLedger->total_in-$itemLedger->total_out) ?></td>
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
</div>