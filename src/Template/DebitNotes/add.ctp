<style>
table > thead > tr > th, table > tbody > tr > th, table > tfoot > tr > th, table > thead > tr > td, table > tbody > tr > td, table > tfoot > tr > td{
	vertical-align: top !important;
	border-bottom:solid 1px #CCC;
}
.page-content-wrapper .page-content {
    padding: 5px;
}
.portlet.light {
    padding: 4px 10px 4px 10px;
}
.help-block-error{
	font-size: 10px;
}
</style>
<?php if(@$ErrorsalesAccs){
		?> 
		<div class="actions">
				<?php echo $this->Html->link('Create Ledger Account For Debit Notes -> Customer/Suppiler','/VouchersReferences/edit/'.$DebitNotesSalesAccount,array('escape'=>false,'class'=>'btn btn-primary')); ?>
		</div>
		<?php } 
		 else if(@$Errorparties){
		?> 
		<div class="actions">
				<?php echo $this->Html->link('Create Ledger Account For Debit Notes -> Heads','/VouchersReferences/edit/'.$DebitNotesParty,array('escape'=>false,'class'=>'btn btn-primary')); ?>
		</div>
		<?php }  else { ?>
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption" >
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel uppercase">Add Debit Note</span>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		 <?= $this->Form->create($debitNote,['type' => 'file','id'=>'form_sample_3']) ?>
			<div class="form-body">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Customer/Suppiler<span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->input('customer_suppiler_id', ['empty'=>'--Select-','options' => $customer_suppiler_id,'label' => false,'class' => 'form-control input-sm select2me']); ?>
						
						</div>
					</div>

				<div class="col-md-4" >
						<div class="form-group">
						<label class=" control-label">Transaction Date<span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->input('transaction_date', ['type' => 'text','label' => false,'class' => 'form-control input-sm date-picker','data-date-format' => 'dd-mm-yyyy','value' => date("d-m-Y"),'data-date-start-date' => date("d-m-Y",strtotime($financial_year->date_from)),'data-date-end-date' => date("d-m-Y",strtotime($financial_year->date_to))]); ?>
						
						</div>
					</div>					
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Date</label>
							
								<?php echo $this->Form->input('created_on', ['type' => 'text','label' => false,'class' => 'form-control input-sm','value' => date("d-m-Y"),'readonly']); ?>
							
						</div>
					</div>
				</div>

				<div class='row'>
				  <div class='col-md-12'>	
						<div style="overflow: auto;">
						 <table width="100%" id="main_table">
							<thead>
								<th width="25%"><label class="control-label">Paid TO</label></th>
								<th width="15%"><label class="control-label">Amount</label></th>
							    <th width="15%"><label class="control-label">Narration</label></th>
								<th width="3%"></th>
							</thead>
							<tbody id="main_tbody">
							
							</tbody>
							<tfoot>
								<td><a class="btn btn-xs btn-default addrow" href="#" role="button"><i class="fa fa-plus"></i> Add row</a></td>
								<td></td>
								<td></td>
								<td></td>
							</tfoot>
						</table>
						</div>
					</div>				
			   </div>
			</div>
		
			<div class="form-actions">
				<button type="submit" class="btn btn-primary">ADD DEBIT NOTE</button>
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
	jQuery.validator.addMethod("noSpace", function(value, element) { 
	  return value.indexOf(" ") < 0 && value != ""; 
	}, "No space allowed");

	jQuery.validator.addMethod("notEqualToGroup", function (value, element, options) {
		// get all the elements passed here with the same class
		var elems = $(element).parents('form').find(options[0]);
		// the value of the current element
		var valueToCompare = value;
		// count
		var matchesFound = 0;
		// loop each element and compare its value with the current value
		// and increase the count every time we find one
		jQuery.each(elems, function () {
			thisVal = $(this).val();
			if (thisVal == valueToCompare) {
				matchesFound++;
			}
		});
		// count should be either 0 or 1 max
		if (this.optional(element) || matchesFound <= 1) {
			//elems.removeClass('error');
			return true;
		} else {
			//elems.addClass('error');
		}
	}, jQuery.format("Reference number should unique for one party."))


	var form3 = $('#form_sample_3');
	var error3 = $('.alert-danger', form3);
	var success3 = $('.alert-success', form3);
	form3.validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-block help-block-error', // default input error message class
		focusInvalid: true, // do not focus the last invalid input
		

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
			$('#submitbtn').prop('disabled', true);
			$('#submitbtn').text('Submitting.....');
			success3.show();
			error3.hide();
			form[0].submit(); // submit the form
		}

	});
	
	add_row();
	function add_row(){
		var tr=$("#sample_table tbody tr.main_tr").clone();
		$("#main_table tbody#main_tbody").append(tr);
		rename_rows();
	}	

	$('.addrow').live("click",function() {
		add_row();
	});
	$('.deleterow').live("click",function() {
		$(this).closest("tr").remove();
	});	
	
	
	function rename_rows(){
		var i=0;
		$("#main_table tbody#main_tbody tr.main_tr").each(function(){
			$(this).find('td:eq(0)').find('select').select2().attr({name:"debit_notes_rows["+i+"][head_id]", id:"debit_notes_rows-"+i+"-head_id"}).rules('add', {
						required: true,
				   });
			$(this).find("td:eq(1) input").attr({name:"debit_notes_rows["+i+"][amount]", id:"debit_notes_rows-"+i+"-amount"}).rules('add', {
						required: true,
						min: 0.01,
					});
		    $(this).find("td:eq(2) textarea").attr({name:"debit_notes_rows["+i+"][narration]", id:"debit_notes_rows-"+i+"-narration"}).rules("add", "required");
			i++;
		});
	}




	
});	
</script>


<table id="sample_table" style="display:none;">
	<tbody>
		<tr class="main_tr">
			<td>
				<div class="row">
						<div class="col-md-10" style="padding-right: 0;">
					<?php echo $this->Form->input('heads', ['empty'=>'--Select-','options'=>$heads,'label' => false,'class' => 'form-control input-sm select2me']); ?>
					</div>
				</div>	
			</td>
			<td>
				<div class="row">
					<div class="col-md-10" style="padding-right: 0;">
						<?php echo $this->Form->input('amount', ['label' => false,'class' => 'form-control input-sm mian_amount','placeholder'=>'Amount']); ?>
					</div>
				</div>
			</td>
			<td>
				<div class="row">
					<div class="col-md-10" style="padding-right: 0;">
						<?php echo $this->Form->input('narration', ['type'=>'textarea','label' => false,'class' => 'form-control input-sm','placeholder'=>'Narration']); ?>
					</div>
				</div>	
			</td>
			<td>
			     <a class="btn btn-xs btn-default deleterow" href="#" role="button"><i class="fa fa-times"></i></a>
			</td>
		</tr>
	</tbody>
</table>