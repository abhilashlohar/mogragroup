<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel">Item opening balance view</span>
		</div>
		
		<div class="actions">
			<?= $this->Html->link(
				'Add',
				'/Items/Opening-Balance'
			); ?>
			<?= $this->Html->link(
				'View',
				'/Items/Opening-Balance-View'
			); ?>
		</div>
	</div>
	<div class="portlet-body form">
		<form method="GET" >
			<input type="hidden" name="pull-request" value="<?php echo @$pull_request; ?>">
				<table class="table table-condensed" width="20%">
					<tbody>
						<tr>
							<td width="20%"><input type="text" name="item" class="form-control input-sm" placeholder="Item Name" value="<?php echo @$item; ?>"></td>
							<td><button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-filter"></i> Filter</button></td>
							</tr>
						</tbody>
				</table>
		</form>
		<?php $page_no=$this->Paginator->current('ItemLedgers'); $page_no=($page_no-1)*20; ?>
		<table class="table table-bordered table-striped" >
			<thead>
				<tr>
					<th>Sr. No.</th>
					<th>Date</th>
					<th>Item</th>
					<th>Quantity</th>
					<th>Rate</th>
					<th>Amout</th>
					<th>Serial Number Enable</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($ItemLedgers as $ItemLedger){ ?>
				<tr>
					<td><?= h(++$page_no) ?></td>
					<td><?= date('d-m-Y',strtotime($ItemLedger->processed_on)) ?></td>
					<td><?= h($ItemLedger->item->name) ?></td>
					<td><?= h((int)$ItemLedger->quantity) ?></td>
					<td><?= h($ItemLedger->rate) ?></td>
					<td><?= h($ItemLedger->quantity*$ItemLedger->rate) ?></td>
					<td><?= $ItemLedger->item->item_companies[0]->serial_number_enable ? 'Yes' : 'No'?></td>
					<td>
					<?= $this->Form->postLink('<i class="fa fa-trash"></i> ',
								['action' => 'DeleteItemOpeningBalance', $ItemLedger->id], 
								[
									'escape' => false,
									'class'=>'btn btn-xs red tooltips','data-original-title'=>'Delete',
									
									'confirm' => __('Are you sure ?', $ItemLedger->id)
								]
							) ?>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>
