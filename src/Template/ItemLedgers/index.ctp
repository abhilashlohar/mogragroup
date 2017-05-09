<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel ">Item Ledger for "<?php foreach ($itemLedgers as $itemLedger){ echo $itemLedger->item->name; break; } ?>"</span>
		</div>
		<div class="portlet-body">
			<div class="row">
				<div class="col-md-12">
				<?php $page_no=$this->Paginator->current('ItemLedgers'); $page_no=($page_no-1)*20; ?>
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>Sr. No.</th>
							<th><?= $this->Paginator->sort('processed_on') ?></th>
							<th>Customer/Supplier/Vendor Name</th>
							<th>Party</th>
							<th>Voucher No.</th>
							<th>Voucher Source</th>
							<th>In</th>
							<th>Out</th>
							<th>Rate</th>
						</tr>
					</thead>
					<tbody>

						<?php


						 foreach ($itemLedgers as $itemLedger): 
						$rate = $itemLedger->rate;
						$in_out_type=$itemLedger->in_out;
						$party=$itemLedger->party_type;
						
						$source_model=$itemLedger->source_model;
						if($source_model=='Challan')
						{
							//pr($itemLedger->party_info); exit;
							if($itemLedger->party_type=='Vendor'){
								$party_name=$itemLedger->party_info->company_name;
							}else{
								$party_name=$itemLedger->party_info->customer_name;
							}
							$voucher_no=$itemLedger->voucher_info->ch1.'/CH-'.str_pad($itemLedger->voucher_info->ch2, 3, '0', STR_PAD_LEFT).'/'.$itemLedger->voucher_info->ch3.'/'.$itemLedger->voucher_info->ch4;
						}
						else if($party=='Customer')
						{
							$party_name=$itemLedger->party_info->customer_name;
							$voucher_no=$itemLedger->voucher_info->in1.'/IN-'.str_pad($itemLedger->voucher_info->in2, 3, '0', STR_PAD_LEFT).'/'.$itemLedger->voucher_info->in3.'/'.$itemLedger->voucher_info->in4;
						}
						else if($party=='Supplier')
						{
							$party_name=$itemLedger->party_info->company_name;
							$voucher_no='-';
							
						}
						else if($party=='Item')
						{
							$party_name='-';
							$voucher_no='-';
						}
						else{
							$party_name='-';
							$voucher_no=$itemLedger->voucher_info->iv_number;
						}
						$status_color=false;
						$status= '-';
						if($in_out_type=='Out'){
							if($itemLedger->voucher_info->challan_type=='Returnable'){
								$status_color=true;
								$status=$this->Number->format($itemLedger->quantity);
							} else{
								$status= $this->Number->format($itemLedger->quantity);
							}
						}
							
						?>
						<tr <?php if($status_color==true){ echo 'style="background-color:red;color:white"'; } ?>>
							
							<td><?= h(++$page_no) ?></td>
							<td><?= h(date("d-m-Y",strtotime($itemLedger->processed_on))) ?></td>
							<?php if($party=='Item'){ ?>
							<td><?php echo "-"; ?></td>
						    <?php } else { ?>
							<td><?= h($itemLedger->party_type)?></td><?php } ?>
							<td><?= h($party_name) ?></td>
							<td><?= h($voucher_no) ?></td>
							<td><?= h($itemLedger->source_model) ?></td>
							<td><?php if($in_out_type=='In'){ echo $this->Number->format($itemLedger->quantity); } else { echo '-'; } ?></td>
							<td><?php echo $status; ?></td>
							<td><?php echo $rate; ?></td>
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


<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>

<script>
$(document).ready(function() 
}
</script>