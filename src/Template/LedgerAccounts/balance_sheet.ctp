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
					<div class="col-md-6">
						<div align="center"><h4>Liablities</h4></div>
						<table class="table table-condensed table-hover">
							<tbody>
							<?php $Total_Liablities=0; $Total_lib_Dr=0; $Total_lib_Cr=0;
							foreach($liablitie_groups as $liablitie_group){ 
							$Total_Liablities=$liablitie_group['debit']-$liablitie_group['credit']; ?>
								<tr>
									<td><?= h($liablitie_group['name']) ?></td>
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
									<th>Total Liablities</th>
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
					<div class="col-md-6">
						<div align="center"><h4>Assets</h4></div>
						<table class="table table-condensed table-hover">
							<tbody>
							<?php $Total_Assets=0; $Total_Dr=0; $Total_Cr=0;
							foreach($Ledgers_Assets as $Ledger){ 
							?>
								<tr>
									<td>
									<?php if(!empty(h($Ledger->ledger_account->alias))){ ?><?= h($Ledger->ledger_account->name) ?> (<?= h($Ledger->ledger_account->alias) ?>)<?php }
									else{ ?><?= h($Ledger->ledger_account->name) ?><?php } ?>
									</td>
									<?php if($Ledger->total_debit>$Ledger->total_credit){?>
										<td style=" text-align: right; "><?= h($Ledger->total_debit-$Ledger->total_credit); echo " Dr" ;
										$Total_Dr+=$Ledger->total_debit-$Ledger->total_credit; 
										?></td>
									<?php } else { ?>
											
										<td style="text-align: right;" width="100px" ><?= h(abs($Ledger->total_debit-$Ledger->total_credit)); echo " Cr" ;
										$Total_Cr+=$Ledger->total_debit-$Ledger->total_credit; 
										?></td>
									<?php } ?>
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
				</div>
				<?php } ?>
				</ul>
			</div>
		</div>
	</div>
</div>