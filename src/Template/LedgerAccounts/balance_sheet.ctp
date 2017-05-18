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
									<table class="table table-condensed">
										<tbody>
										<?php $total_lib = 0;
										$lib_tr = 0; $ass_tr = 0; $liablitie_tr =0; $assets_tr = 0; $Total_Liablities=0; $Total_lib_Dr=0; $Total_lib_Cr=0;
										//pr($liablitie_groups);exit;
										foreach($liablitie_groups as $liablitie_group){ 
										$Total_Liablities=$liablitie_group['debit']-$liablitie_group['credit']; ?>
											<tr> <?php $liablitie_tr++; ?>
												<td> 
													<a href='#' role='button' status='close' class="group_name" group_id='<?php echo $liablitie_group['group_id']; ?>' style='color:black;'> 
														<?=  h($liablitie_group['name']) ?> 
													</a>  
												</td>
												<td style="text-align:right;">
													<span>
														<?= h(abs($Total_Liablities)) ?>
														<?php if($Total_Liablities>=0)
														     { $Total_lib_Dr += $Total_Liablities; echo 'Dr'; }
															 else{ $Total_lib_Cr += $Total_Liablities; echo 'Cr';} ?>
													</span>
												</td>
											</tr> 
										<?php } ?>
											
											<?php $Total_lib_Dr= abs($Total_lib_Dr);  $Total_lib_Cr= abs($Total_lib_Cr); ?>
										</tbody>
									</table>
								</div>
							</td>
						    <td valign="top">
								<div class="col-md-12">
										<table class="table table-condensed">
											<tbody>
											<?php  $Total_Assets=0; $Total_Dr=0; $Total_Cr=0;
											foreach($asset_groups as $asset_group){
											$Total_Assets= $asset_group['debit'] - $asset_group['credit'];?>
													<tr> <?php $assets_tr++; ?>
														<td> <a href="#" role='button' status='close' class="group_name" group_id='<?php      echo $asset_group['group_id']; ?>' style='color:black;'>
																<?= h($asset_group['name']) ?>
															 </a>  
														</td>
														<td style="text-align:right;">
															<?= h(abs($Total_Assets)) ?>
															<?php if($Total_Assets>=0)
															{ $Total_Dr += $Total_Assets;  echo 'Dr'; }
														    else{ $Total_Cr += $Total_Assets; echo 'Cr'; } ?>
														</td>
													</tr>
											<?php } ?>
												<?php $Total_Dr= abs($Total_Dr);  $Total_Cr= abs($Total_Cr); ?>
											</tbody>
									</table>
								</div>
							</td>
						</tr>
						<tr>
							<td> 
							    <table style='width:100%;'>	
									<tr> 
										<th style='padding-left: 20px;'>Total Liablities </th>
										<?php  if($Total_lib_Dr>$Total_lib_Cr){ 
											$Total_Liablities=abs($Total_lib_Dr)-abs($Total_lib_Cr);?>
											<th style=" text-align: right; "><?= h (abs($Total_Liablities)); ?> Dr</th>
										<?php } else if ($Total_lib_Dr<$Total_lib_Cr) { 
											$Total_Liablities=abs($Total_lib_Dr)-abs($Total_lib_Cr); ?>
											<th style=" text-align: right;padding-right: 20px;"><?= h(abs($Total_Liablities)); ?>Cr</th>
										<?php } else { ?>
										<th style=" text-align: right;padding-right: 20px;"><?php echo '0'; ?></th>
										<?php } ?>
									</tr>	

								</table>
							</td>
							<td>
								<table style='width:100%;'>
								  <tr>
									<th style='padding-left: 20px;'>Total Assets</th>
									<?php  if($Total_Dr>$Total_Cr){ $Total_Assets=abs($Total_Dr)-abs($Total_Cr);  ?>
										<th style=" text-align: right;padding-right: 20px;" width="200px"><?= h($Total_Assets ); ?> Dr</th>
									<?php } else if($Total_Dr<$Total_Cr){ $Total_Assets=abs($Total_Dr)-abs($Total_Cr); ?>
										<th style=" text-align: right;padding-right: 20px;" width="200px"><?= h(abs($Total_Assets)); ?>Cr</th>
									<?php } else { ?>
									<th style=" text-align: right;padding-right: 20px;"><?php echo "0" ?></th>
									<?php } ?>
								   </tr>
								</table>
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

<style>
	.group_a {
		font-weight: bold;
		
	}
</style>

<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>

<script>
$(document).ready(function() {
	$(".group_name").die().live('click',function(e){
	   //$('.append_tr').remove();
	 if($(this.attr('status') == 'open')
	   {
			$('.append_tr').hide();
	   }
	   else
	   {
		   $('table > tbody > tr > td> a').removeClass("group_a");
		   $('table > tbody > tr > td> span').removeClass("group_a");
		   var current_obj=$(this);
		   var group_id=$(this).attr('group_id');
		   var date = $('.date-picker').val();
		   var url="<?php echo $this->Url->build(['controller'=>'LedgerAccounts','action'=>'firstSubGroups']); ?>";
		   url=url+'/'+group_id +'/'+date,
			$.ajax({
				url: url,
			}).done(function(response) {
				current_obj.attr('status','open');
				 current_obj.addClass("group_a");
				current_obj.closest('tr').find('span').addClass("group_a");
				$('<tr class="append_tr"><td colspan="2">'+response+'</td></tr>').insertAfter(current_obj.closest('tr'));
			});			   
		}   
	});	   	
});	
</script>
