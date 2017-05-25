
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel uppercase">Bank Reconciliation Form</span>
		</div>
		
	
	
	<div class="portlet-body form">
	<form method="GET" >
				<table class="table table-condensed" >
				<tbody>
					<tr>
					<td>
						<div class="row">
							<div class="col-md-4">
									<?php echo $this->Form->input('ledger_account_id', ['empty'=>'--Select--','options' => $banks,'empty' => "--Select Ledger Account--",'label' => false,'class' => 'form-control input-sm select2me','required','value'=>@$ledger_account_id]); ?>
							</div>
							<div class="col-md-4">
								<input type="text" name="From" class="form-control input-sm date-picker" placeholder="Transaction From" value="<?php echo @date('01-04-Y');  ?>" required data-date-format="dd-mm-yyyy" >
							</div>
							<div class="col-md-4">
								<input type="text" name="To" class="form-control input-sm date-picker" placeholder="Transaction To"  value="<?php echo @date('d-m-Y'); ?>" required  data-date-format="dd-mm-yyyy" >
							</div>
						</div>
					</td>
					<td><button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-filter"></i> Filter</button></td>
					</tr>
				</tbody>
			</table>
	</form>
		<!-- BEGIN FORM-->
<?php if(!empty($Bank_Ledgers)){  ?>
	<div class="row ">
		<div class="col-md-12">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>Transaction Date</th>
						<th>Source</th>
						<th style="text-align:right;">Dr</th>
						<th style="text-align:right;">Cr</th>
						<th>Reconcilation Date</th>

					</tr>
				</thead>
				<tbody>
				<?php  $total_balance_acc=0; $total_debit=0; $total_credit=0;
				//pr($Bank_Ledgers->toArray()); exit;
				foreach($Bank_Ledgers as $ledger): 
				
				?>
				<tr>
						<td><?php echo date("d-m-Y",strtotime($ledger->transaction_date)); ?></td>
						<td><?= h($ledger->voucher_source); ?></td>
						
						<td align="right"><?= $this->Number->format($ledger->debit,[ 'places' => 2]); 
							$total_debit+=$ledger->debit; ?></td>
						<td align="right"><?= $this->Number->format($ledger->credit,[ 'places' => 2]); 
							$total_credit+=$ledger->credit; ?></td>
						<td><?php echo $this->Form->input('finalisation_date', ['type' => 'text','label' => false,'class' => 'form-control input-sm date-picker finalisation_date','data-date-format' => 'dd-mm-yyyy','data-date-start-date' => '+0d','data-date-end-date' => '+60d','placeholder' => 'Reconcilation Date','ledger_id'=>$ledger->id]); ?></td>
				</tr>
				<?php  endforeach; ?>
				<tr>
					<td colspan="2" align="right">Total</td>
					<td align="right" ><?= $total_debit ;?> Dr</td>
					<td align="right" ><?= $total_credit; ?> Cr</td>
					<td align="right" ></td>
				<tr>
				</tbody>
			</table>
			</div>
			
					<div class="form-actions">
			<div class="row">
				<div class="col-md-offset-9 col-md-3">
					<button type="submit" class="btn btn-primary" id='submitbtn'>ADD</button>
			</div>
			</div>
		</div>
		</div>
<?php } ?>
</div></div>
<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
<script>
$(document).ready(function() {
	$('.finalisation_date').die().change("blur",function() { 
		var ledger_id=$(this).attr('ledger_id');
		alert(ledger_id);
		var url="<?php echo $this->Url->build(['controller'=>'Ledgers','action'=>'dateUpdate']); ?>";
		url=url+'/'+customer_id,
		$.ajax({
			url: url,
		}).done(function(response) {
			$("#qt3_div").html(response);
		});
    });

});
</script>
