<?php if(@$ErrorreceivedFroms){
		?> 
		<div class="actions">
				<?php echo $this->Html->link('Create Ledger Account For Petty Cash Receipt -> Received From','/VouchersReferences/edit/'.$PettyCashReceiptVouchersReceived,array('escape'=>false,'class'=>'btn btn-primary')); ?>
		</div>
		<?php } 
		 else if(@$ErrorbankCashes){
		?> 
		<div class="actions">
				<?php echo $this->Html->link('Create Ledger Account For Petty Cash Receipt -> Cash/Bank','/VouchersReferences/edit/'.$PettyCashReceiptVouchersCashBank,array('escape'=>false,'class'=>'btn btn-primary')); ?>
		</div>
<?php }  else { ?>

<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption" >
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel uppercase">Add Petty Cash Receipt Voucher</span>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		 <?= $this->Form->create($pettyCashReceiptVoucher,['type' => 'file','id'=>'form_sample_3']) ?>
			<div class="form-body">
			<div class="row">
				<div class="col-md-9">
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="col-md-3 control-label">Date</label>
						<div class="col-md-9">
							<?php echo $this->Form->input('created_on', ['type' => 'text','label' => false,'class' => 'form-control input-sm','value' => date("d-m-Y"),'readonly']); ?>
						</div>
					</div>
				</div>
			</div>
				<div class="row" style="margin-top:30px;">
					<div class="col-md-4" >
						<div class="form-group">
							<label class=" control-label">Transaction Date<span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->input('transaction_date', ['type' => 'text','label' => false,'class' => 'form-control input-sm date-picker','data-date-format' => 'dd-mm-yyyy','value' => date("d-m-Y"),'data-date-start-date' => date("d-m-Y",strtotime($financial_year->date_from)),'data-date-end-date' => date("d-m-Y",strtotime($financial_year->date_to))]); ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Recived From<span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->input('received_from_id', ['empty'=>'--Select-','label' => false,'class' => 'form-control input-sm select2me']); ?>
						
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Bank/Cash<span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->input('bank_cash_id', ['empty'=>'--Select-','label' => false,'class' => 'form-control input-sm select2me']); ?>
						
						</div>
					</div>
					
					
				</div>
				<div class="row">
				<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Mode of Payment<span class="required" aria-required="true">*</span></label></label>
							<div class="radio-list">
								<div class="radio-inline" >
								<?php echo $this->Form->radio(
									'payment_mode',
									[
										['value' => 'Cheque', 'text' => 'Cheque','checked'],
										['value' => 'Cash', 'text' => 'Cash']
									]
								); ?>
								</div>
                            </div>
						</div>
						<div class="form-group" id="chq_no">
							<label class="control-label">Cheque No<span class="required" aria-required="true">*</span></label>
							<?php 
							echo $this->Form->input('cheque_no', ['type'=>'text','label' => false,'class' => 'form-control input-sm','placeholder'=>'Cheque No','checked']); ?>
						</div>
					</div>
				<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Amount<span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->input('amount', ['label' => false,'class' => 'form-control input-sm quantity']); ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Narration <span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->input('narration', ['label' => false,'class' => 'form-control input-sm','placeholder'=>'Narration']); ?>
						</div>
					</div>
				</div>
				
			</div>
		
			<div class="form-actions">
				<button type="submit" class="btn btn-primary">ADD PETTYCASH VOUCHER</button>
			</div>
		</div>
		<?= $this->Form->end() ?>
		<!-- END FORM-->
	</div>
</div>
<?php } ?>

<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
<script>
$(document).ready(function() {
	//--------- FORM VALIDATION
	var form3 = $('#form_sample_3');
	var error3 = $('.alert-danger', form3);
	var success3 = $('.alert-success', form3);
	form3.validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-block help-block-error', // default input error message class
		focusInvalid: true, // do not focus the last invalid input
		rules: {
			cheque_no :{
				required: true,
			},
		},

		errorPlacement: function (error, element) { // render error placement for each input type
			if (element.parent(".input-group").size() > 0) {
				error.insertAfter(element.parent(".input-group"));
			} else if (element.attr("data-error-container")) { 
				error.appendTo(element.attr("data-error-container"));
			} else if (element.parents('.radio-list').size() > 0) { 
				error.appendTo(element.parents('.radio-list').attr("data-error-container"));
			} else if (element.parents('.radio-inline').size() > 0) { 
				error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
			} else if (element.parents('.checkbox-list').size() > 0) {
				error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
			} else if (element.parents('.checkbox-inline').size() > 0) { 
				error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
			} else {
				error.insertAfter(element); // for other inputs, just perform default behavior
			}
		},

		invalidHandler: function (event, validator) { //display error alert on form submit   
			success3.hide();
			error3.show();
			Metronic.scrollTo(error3, -200);
		},

		highlight: function (element) { // hightlight error inputs
		   $(element)
				.closest('.form-group').addClass('has-error'); // set error class to the control group
		},

		unhighlight: function (element) { // revert the change done by hightlight
			$(element)
				.closest('.form-group').removeClass('has-error'); // set error class to the control group
		},

		success: function (label) {
			label
				.closest('.form-group').removeClass('has-error'); // set success class to the control group
		},

		submitHandler: function (form) {
			q="ok";
			success3.show();
			error3.hide();
			form[0].submit(); // submit the form
			
		}

	});
		$('.quantity').die().live("keyup",function() {
		var asc=$(this).val();
		var numbers =  /^[0-9]*\.?[0-9]*$/;
		if(asc==0)
		{
			$(this).val('');
			return false; 
		}
		else if(asc.match(numbers))  
		{  
		} 
		else  
		{  
			$(this).val('');
			return false;  
		}
	});
	$('input[name="amount"]').die().live("keyup",function() { 
		var asc=$(this).val();
			var numbers =  /^[0-9]*\.?[0-9]*$/;
			if(asc.match(numbers))  
			{  
			} 
			else  
			{  
				$(this).val('');
				return false;  
			}
	});
	
	$('input[name="payment_mode"]').die().live("click",function() {
		var payment_mode=$(this).val();
		
		if(payment_mode=="Cheque"){
			$("#chq_no").show();
		}else{
			$("#chq_no").hide();
		}
	});
});
</script>