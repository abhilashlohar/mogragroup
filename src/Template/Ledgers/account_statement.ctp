<?php 

	if(empty($transaction_from_date)){
			$transaction_from_date=" ";
		}else{
			$transaction_from_date=$transaction_from_date;
		} 

		if(empty($transaction_to_date)){
			$transaction_to_date=" ";
		}else{
			$transaction_to_date=$transaction_to_date;
		} 
?>
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel uppercase">Account Statement</span>
		</div>
		
	</div>
	<div class="portlet-body form">
	<form method="GET" >
				<table class="table table-condensed" style="width:90%;">
				<tbody>
					<tr>
					<td>
						<div class="row">
							<div class="col-md-4">
									<?php echo $this->Form->input('ledger_account_id', ['empty'=>'--Select--','options' => $ledger,'empty' => "--Select Ledger Account--",'label' => false,'class' => 'form-control input-sm select2me','required','value'=>$ledger_account_id]); ?>
							</div>
							<div class="col-md-4">
								<input type="text" name="From" class="form-control input-sm date-picker" placeholder="Transaction From" value="<?php echo @date('d-m-Y', strtotime($transaction_from_date));  ?>" required data-date-format="dd-mm-yyyy" >
							</div>
							<div class="col-md-4">
								<input type="text" name="To" class="form-control input-sm date-picker" placeholder="Transaction To"  value="<?php echo @date('d-m-Y', strtotime($transaction_to_date)); ?>" required  data-date-format="dd-mm-yyyy" >
							</div>
						</div>
					</td>
					
							
						<td><button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-filter"></i> Filter</button></td>
					</tr>
				</tbody>
			</table>
	</form>
		<!-- BEGIN FORM-->
<?php if(!empty($Ledger_Account_data)){ ?>
		<div class="row ">
			<div class="col-md-12">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="col-md-12 " style="text-align:center; font-size: 20px;"><?php echo $Ledger_Account_data->name; ?></div>
					<div class="col-md-12" style="text-align:left; font-size: 16px;"> <?php echo $Ledger_Account_data->account_second_subgroup->account_first_subgroup->account_group->account_category->name; ?>->
					<?php echo $Ledger_Account_data->account_second_subgroup->account_first_subgroup->account_group->name; ?>->
					<?php echo $Ledger_Account_data->account_second_subgroup->account_first_subgroup->name; ?>->
					<?php echo $Ledger_Account_data->account_second_subgroup->name; ?></div>
				</div>
				<div class="col-md-3"></div>
			</div>
		</div><br/>


		<div class="row ">
		<div class="col-md-12">
			<div class="col-md-8"></div>	
			<div class="col-md-4 caption-subject " align="left" style="background-color:#E7E2CB; font-size: 16px;"><b>Opening Balance : </b>
				<?php $opening_balance=0; 
					if($total_balance[0]->total_debit> $total_balance[0]->total_credit){ 
						$opening_balance=$total_balance[0]->total_debit-$total_balance[0]->total_credit;?>
						<?= $this->Number->format(abs($opening_balance),[ 'places' => 2])?>
						<?php echo " Dr"; 
					}else if($total_balance[0]->total_debit< $total_balance[0]->total_credit){ 
						$opening_balance=$total_balance[0]->total_debit-$total_balance[0]->total_credit;?>
						<?= $this->Number->format(abs($opening_balance),[ 'places' => 2])?>
						<?php echo " Cr"; } 
					else{ 
						echo "0.00"; }
					?>
			</div>
		</div>
		<div class="col-md-12">
				
		 
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>Transaction Date</th>
						<th>Source</th>
						<th>Reference</th>
						<th style="text-align:right;">Dr</th>
						<th style="text-align:right;">Cr</th>
					</tr>
				</thead>
				<tbody>
				<?php $total_balance_acc=0; $total_debit=0; $total_credit=0;
				foreach ($Ledgers_rows as $ledger): 
				$url_path="";
				if($ledger->voucher_source=="Journal Voucher"){
					$url_path="/JournalVouchers/view/".$ledger->voucher_id;
				}else if($ledger->voucher_source=="Payment Voucher"){
					$url_path="/Payments/view/".$ledger->voucher_id;
				}else if($ledger->voucher_source=="PettyCashReceipt Voucher"){
					$url_path="/petty-cash-receipt-vouchers/view/".$ledger->voucher_id;
				}else if($ledger->voucher_source=="Contra Voucher"){
					$url_path="/contra-vouchers/view/".$ledger->voucher_id;
				}else if($ledger->voucher_source=="Receipt Voucher"){
					$url_path="/receipts/view/".$ledger->voucher_id;
				}
				
				?>
				<tr>
						<td><?php echo date("d-m-Y",strtotime($ledger->transaction_date)); ?></td>
						<td><?= h($ledger->voucher_source); ?></td>
						<td>
						<?php if(!empty($url_path)){
								echo $this->Html->link(str_pad($ledger->voucher_id,4,'0',STR_PAD_LEFT),$url_path,['target' => '_blank']);
							}else{
								echo str_pad($ledger->voucher_id,4,'0',STR_PAD_LEFT);
							}
						
						?>
						</td>
						<td align="right"><?= $this->Number->format($ledger->debit,[ 'places' => 2]); 
							$total_debit+=$ledger->debit; ?></td>
						<td align="right"><?= $this->Number->format($ledger->credit,[ 'places' => 2]); 
							$total_credit+=$ledger->credit; ?></td>
				</tr>
				<?php endforeach; ?>
				<tr>
					<td colspan="3" align="right">Total</td>
					<td align="right" ><?= $this->Number->format( $total_debit,[ 'places' => 2])?> Dr</td>
					<td align="right" ><?= $this->Number->format( $total_credit,[ 'places' => 2])?> Cr</td>
					
				<tr>
				</tbody>
			</table>
			</div>
			
			<div class="col-md-12">
				<div class="col-md-8"></div>	
				<div class="col-md-4 caption-subject " align="left" style="background-color:#E3F2EE; font-size: 16px;"><b>Closing Balance:- </b>
				<?php 
				if($total_balance[0]->total_debit > $total_balance[0]->total_credit ){
						$total_debit=$total_debit+$opening_balance;
				}
				else {
						$total_credit=$total_credit + abs($opening_balance);
						 
				}
				
					if($total_debit>$total_credit){ 
						//echo $opening_balance;
						//$total_credit1=$total_credit+abs($opening_balance);
						$total_balance_acc=$total_debit-$total_credit;?>
						<?= $this->Number->format(abs($total_balance_acc),[ 'places' => 2])?>
						<?php echo " Dr"; 
					}else{ 
						//$total_credit1=$total_credit+abs($opening_balance);
						$total_balance_acc=$total_debit-$total_credit;?>
						<?= $this->Number->format(abs($total_balance_acc),[ 'places' => 2])?>
						<?php echo " Cr"; } ?>
				</div>
			</div>
			
		</div>
<?php } ?>
</div>