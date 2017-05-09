<?php //pr($Ledgers_Assets); exit; ?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Profit & Loss Statement
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
						<div align="center"><h4>Expense</h4></div>
						<table class="table table-condensed table-hover">
							<tbody>
							<?php $Total_Liablities=0; $Total_exp_Dr=0; $Total_exp_Cr=0; 
							foreach($Ledgers_Expense as $Ledger){ 
							$Total_Liablities+=$Ledger->total_debit-$Ledger->total_credit; ?>
								<tr>
									<td>
									<?php if(!empty(h($Ledger->ledger_account->alias))){ ?><?= h($Ledger->ledger_account->name) ?> (<?= h($Ledger->ledger_account->alias) ?>)<?php }
									else{ ?><?= h($Ledger->ledger_account->name) ?><?php } ?>
									</td>
									<?php if($Ledger->total_debit>$Ledger->total_credit){?>
										<td style=" text-align: right; "><?= h($Ledger->total_debit-$Ledger->total_credit); echo "Dr" ;
										$Total_exp_Dr+=$Ledger->total_debit-$Ledger->total_credit; 
										?></td>
									<?php } else { ?>
											
										<td style=" text-align: right; "><?= h(abs($Ledger->total_debit-$Ledger->total_credit)); echo "Cr" ;
										$Total_exp_Cr+=$Ledger->total_debit-$Ledger->total_credit; 
										?></td>
									<?php } ?>
								</tr>
							<?php } ?>
								<?php $Total_exp_Dr= abs($Total_exp_Dr);  $Total_exp_Cr= abs($Total_exp_Cr); ?>
								<tr>
									<th>Total Expense</th>
									<?php  if($Total_exp_Dr>$Total_exp_Cr){ 
										$Total_Liablities=abs($Total_exp_Dr)-abs($Total_exp_Cr);?>
										<th style=" text-align: right; "><?= h (abs($Total_Liablities)); ?>Dr</th>
									<?php } else if($Total_exp_Dr<$Total_exp_Cr) { 
										$Total_Liablities=abs($Total_exp_Dr)-abs($Total_exp_Cr); ?>
										<th style=" text-align: right; "><?= h(abs($Total_Liablities)); ?>Cr</th>
									<?php } else { ?>
									<th style=" text-align: right; "><?php echo "0" ?></th>
									<?php } ?>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-md-6">
						<div align="center"><h4>Income</h4></div>
						<table class="table table-condensed">
							<tbody>
							<?php $Total_Assets=0; $Total_Dr=0; $Total_Cr=0;
							foreach($Ledgers_Income as $Ledger){ 
							$Total_Assets+=$Ledger->total_debit-$Ledger->total_credit; ?>
								<tr>
									<td>
									<?php if(!empty(h($Ledger->ledger_account->alias))){ ?><?= h($Ledger->ledger_account->name) ?> (<?= h($Ledger->ledger_account->alias) ?>)<?php }
									else{ ?><?= h($Ledger->ledger_account->name) ?><?php } ?>
									</td>
									<?php if($Ledger->total_debit>$Ledger->total_credit){?>
										<td style=" text-align: right; "><?= h($Ledger->total_debit-$Ledger->total_credit); echo "Dr" ;
										$Total_Dr+=$Ledger->total_debit-$Ledger->total_credit; 
										?></td>
									<?php } else { ?>
											
										<td style=" text-align: right; "><?= h(abs($Ledger->total_debit-$Ledger->total_credit)); echo "Cr" ;
										$Total_Cr+=$Ledger->total_debit-$Ledger->total_credit; 
										?></td>
									<?php } ?>
								</tr>
							<?php } ?>
								<?php $Total_Dr= abs($Total_Dr); ?>
								<?php $Total_Cr= abs($Total_Cr); ?>
								
								<tr>
									<th>Total Income</th>
									<?php  if($Total_Dr>$Total_Cr){ $Total_Assets=abs($Total_Dr)-abs($Total_Cr);  ?>
										<th style=" text-align: right; "><?= h(abs($Total_Assets)); ?>Dr</th>
									<?php } else if($Total_Dr<$Total_Cr) { $Total_Assets=abs($Total_Dr)-abs($Total_Cr); ?>
										<th style=" text-align: right; "><?= h(abs($Total_Assets)); ?>Cr</th>
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