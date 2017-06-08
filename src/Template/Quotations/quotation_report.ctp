
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			
		</div>
		
	
	<div class="portlet-body">
		<div class="row">
			<div class="col-md-12">
			
				<?php $page_no=$this->Paginator->current('Quotations'); $page_no=($page_no-1)*20; 
					
				?>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="5%">Sr. No.</th>
							<th width="15%">Ref. No.</th>
							<th width="15%">Customer</th>
							<th width="15%">Salesman</th>
							<th width="15%">Product</th>
							<th width="10%">Items Name</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0; foreach ($quotations as $quotation): $i++;
						if($quotation->status=='Converted Into Sales Order'){ $tr_color='#f4f4f4'; }
						if($quotation->status=='Pending'){ $tr_color='#FFF'; }
						if($quotation->status=='Closed'){ $tr_color='#FFF'; }
						?>
						<tr>
							<td><?= h(++$page_no) ?>
							<?php if($quotation->revision > 0) { ?>
							<button type="button" class="btn btn-xs tooltips revision_show" value="<?=$quotation->id ?>" style="margin-left:5px;" data-original-title="Revisions"><i class="fa fa-plus-circle"></i></button>
							<button type="button" class="btn btn-xs tooltips revision_hide" id="revision_hide" value="<?=$quotation->id ?>" style="margin-left:5px; display:none;"><i class="fa fa-minus-circle"></i></button><?php } ?></td>
							
							<td><?= h(($quotation->qt1.'/QT-'.str_pad($quotation->qt2, 3, '0', STR_PAD_LEFT).'/'.$quotation->qt3.'/'.$quotation->qt4)) ?><?php if($quotation->revision > 0) { ?><?php echo ' (#R'.$quotation->revision.' )'; ?><?php } ?></td>
							<td><?= h($quotation->customer->customer_name).'('.h($quotation->customer->alias).')' ?></td>
							<td><?= h($quotation->employee->name) ?></td>
							<td><?= h($quotation->item_group->name) ?></td>
							<td>
								<div class="btn-group">
									<button id="btnGroupVerticalDrop5" type="button" class="btn  btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Items <i class="fa fa-angle-down"></i></button>
										<ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupVerticalDrop5">
										<?php foreach($quotation->quotation_rows as $quotation_rows){ 
											if($quotation_rows->quotation_id == $quotation->id){?>
											<li><p><?= h($quotation_rows->item->name) ?></p></li>
											<?php }}?>
										</ul>
								</div>
							</td>
							
						</tr>
						
						<?php endforeach; ?>
					</tbody>
				</table>
				
			</div>
		</div>
	</div>
</div>
\