<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption" >
			<i class="icon-globe font-blue-steel"></i>
				<span class="caption-subject font-blue-steel uppercase">Add Inventory Transfer Voucher</span>
		</div>
	</div>
	<div class="portlet-body form">
	<?= $this->Form->create($inventoryTransferVoucher,['id'=>'form_sample_3']) ?>
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-2">
						<div class="form-group">
							<label class="control-label">Item</label>
							<?php echo $this->Form->input('item_id', ['empty'=>'--Select-','options'=>$display_items,'label' => false,'class' => 'form-control input-sm select2me']); ?>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label class="control-label">Serial Number</label>
							<?php echo $this->Form->input('serial_number', ['label' => false,'class' => 'form-control input-sm select2me']); ?>
						</div>
					</div>
					<div class="col-md-1">
						<div class="form-group">
							<label class="control-label">Quantity</label>
							<?php echo $this->Form->input('quantity', ['label' => false,'class' => 'form-control input-sm']); ?>
						</div>
					</div>
				</div>	
			</div>
		</div>		
	</div>
</div>	


