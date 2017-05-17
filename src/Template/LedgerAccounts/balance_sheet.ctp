<?php //pr($Ledgers_Assets); exit; ?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Balance Sheet
				</div>
			</div>
			<div class="portlet-body">
				<form method="get">
					<div class="input-group input-medium">
						<input type="text" name="date" class="form-control date-picker" placeholder="Date" data-date-format='dd-mm-yyyy' data-date-end-date='0d' value="<?php  echo $date; ?>">
						<span class="input-group-btn">
						<button class="btn blue" type="submit">Go</button>
						</span>
					</div>
				</form>
				<?php if($date){ ?>
				<div class="row">
					<table width="100%" style="margin-top: 10px;">
						<tr style="width:50%;">
						    <td><div align="center"><h4>Liablities</h4></div></td>
						    <td><div align="center"><h4>Assets</h4></div></td>
						</tr>
						<tr style="width:50%;">
						    <td valign="top">
								<div class="col-md-12">
									<table class="table table-condensed table-hover">
										<tbody>
										<?php 
										$lib_tr = 0; $ass_tr = 0; $liablitie_tr =0; $assets_tr = 0; $Total_Liablities=0; $Total_lib_Dr=0; $Total_lib_Cr=0;
										
										foreach($liablitie_groups as $liablitie_group){ 
										$Total_Liablities=$liablitie_group['debit']-$liablitie_group['credit']; ?>
											<tr> <?php $liablitie_tr++; ?>
												<td> 
													<a href='#' role='button' class="group_name" group_id='<?php echo $liablitie_group['group_id']; ?>' > 
														<?=  h($liablitie_group['name']) ?> 
													</a>  
												</td>
												<td style="text-align:right;">
													<?= h(abs($Total_Liablities)) ?>
													<?php if($Total_Liablities>=0){
														echo 'Dr';
													}else{
														echo 'Cr';
													} ?>
												</td>
											</tr>
										<?php } ?>
											<?php $Total_lib_Dr= abs($Total_lib_Dr);  $Total_lib_Cr= abs($Total_lib_Cr); ?>
											
											<tr>
												<th>Total Liablities </th>
												<?php  if($Total_lib_Dr>$Total_lib_Cr){ 
													$Total_Liablities=abs($Total_lib_Dr)-abs($Total_lib_Cr);?>
													<th style=" text-align: right; "><?= h (abs($Total_Liablities)); ?> Dr</th>
												<?php } else if ($Total_lib_Dr<$Total_lib_Cr) { 
													$Total_Liablities=abs($Total_lib_Dr)-abs($Total_lib_Cr); ?>
													<th style=" text-align: right; "><?= h(abs($Total_Liablities)); ?>Cr</th>
												<?php } else { ?>
												<th style=" text-align: right; "><?php echo "0" ?></th>
												<?php } ?>
											</tr>
										</tbody>
									</table>
								</div>
							</td>
						    <td valign="top">
								<div class="col-md-12">
										<table class="table table-condensed table-hover">
											<tbody>
											<?php  $Total_Assets=0; $Total_Dr=0; $Total_Cr=0;
											foreach($asset_groups as $asset_group){
											$Total_Assets= $asset_group['debit'] - $asset_group['credit'];?>
													<tr> <?php $assets_tr++; ?>
														<td><?= h($asset_group['name']) ?></td>
														<td style="text-align:right;">
															<?= h(abs($Total_Assets)) ?>
															<?php if($Total_Assets>=0){
																echo 'Dr';
															}else{
																echo 'Cr';
															} ?>
														</td>
													</tr>
											<?php } ?>
												<?php $Total_Dr= abs($Total_Dr);  $Total_Cr= abs($Total_Cr); ?>
													
												<tr>
												<th>Total Assets</th>
													<?php  if($Total_Dr>$Total_Cr){ $Total_Assets=abs($Total_Dr)-abs($Total_Cr);  ?>
														<th style=" text-align: right;" width="200px"><?= h($Total_Assets ); ?> Dr</th>
													<?php } else if($Total_Dr<$Total_Cr){ $Total_Assets=abs($Total_Dr)-abs($Total_Cr); ?>
														<th style=" text-align: right;" width="200px"><?= h(abs($Total_Assets)); ?>Cr</th>
													<?php } else { ?>
													<th style=" text-align: right; "><?php echo "0" ?></th>
													<?php } ?>
												</tr>
											</tbody>
									</table>
								</div>
							</td>
						</tr>
					</table>
				</div>
				<?php } ?>
				</ul>
			</div>
		</div>
	</div>
</div>

<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
<script>
$(document).ready(function() {
	$(".group_name").die().live('click',function(e){
	   var group_id=$(this).attr('group_id');
	   var date = $('.date-picker').val();
	  // alert(date);
		var url="<?php echo $this->Url->build(['controller'=>'LedgerAccounts','action'=>'firstSubGroups']); ?>";
		url=url+'/'+group_id +'/'+date,
		alert(url);
	    $.ajax({
			url: url,
		}).done(function(response) {
			console.log(response);
		});		
   });
});

</script>
