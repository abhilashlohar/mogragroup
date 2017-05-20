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
				<?php echo $this->Html->link('Create Ledger Account For Debit Notes -> Sales Account','/VouchersReferences/edit/'.$DebitNotesSalesAccount,array('escape'=>false,'class'=>'btn btn-primary')); ?>
		</div>
		<?php } 
		 else if(@$Errorparties){
		?> 
		<div class="actions">
				<?php echo $this->Html->link('Create Ledger Account For Debit Notes -> Party','/VouchersReferences/edit/'.$DebitNotesParty,array('escape'=>false,'class'=>'btn btn-primary')); ?>
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
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Sales Account<span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->input('sales_acc_id', ['empty'=>'--Select-','label' => false,'class' => 'form-control input-sm select2me']); ?>
						
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Party<span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->input('party_id', ['empty'=>'--Select-','label' => false,'class' => 'form-control input-sm select2me']); ?>
						
						</div>
					</div>
				</div>

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
							<td id="receipt_amount" style="font-size: 14px;font-weight: bold;"></td>
							<td></td>
							<td>
								
							</td>
							
							<td></td>
						</tfoot>
					</table>
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
			$("#main_tb tbody tr").each(function(){
				var t=$(this).find("td:nth-child(2) input").val();
				var w=$(this).find("td:nth-child(3) input").val();
				var r=$(this).find("td:nth-child(4) input").val();
				if(t=="" || w=="" || r==""){
					q="e";
				}
			});
			if(q=="e"){
				$("#row_error").show();
				return false;
			}else{
				success3.show();
				error3.hide();
				form[0].submit(); // submit the form
			}
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

	add_row();
	function add_row(){
		var tr=$("#sample_table tbody tr").clone();
		$("#main_table tbody#main_tbody").append(tr);
		rename_rows();
	}
	
	function rename_rows(){
		var i=0;
		$("#main_table tbody#main_tbody tr.main_tr").each(function(){
			$(this).find("td:eq(0) select.received_from").select2().attr({name:"payment_rows["+i+"][received_from_id]", id:"quotation_rows-"+i+"-received_from_id"}).rules('add', {
						required: true,
						notEqualToGroup: ['.received_from'],
						messages: {
							notEqualToGroup: "Do not select same party again."
						}
					});
			$(this).find("td:eq(1) input").attr({name:"payment_rows["+i+"][amount]", id:"quotation_rows-"+i+"-amount"}).rules('add', {
						required: true,
						min: 0.01,
					});

			$(this).find("td:nth-child(4) textarea").attr({name:"payment_rows["+i+"][narration]", id:"quotation_rows-"+i+"-narration"}).rules("add", "required");
			i++;
		});
	}
	
	$('.addrow').live("click",function() {
		add_row();
	});
	$('.deleterow').live("click",function() {
		$(this).closest("tr").remove();
	});
	
	
	
});
</script>



<table id="sample_table" style="display:none; width:100%; ">
	<tbody>
		<tr class="main_tr">
			<td><?php echo $this->Form->input('party_id', ['empty'=>'--Select-','label' => false,'class' => 'form-control input-sm received_from']); ?></td>
			<td>
			<div class="row">
				<div class="col-md-7" style="padding-right: 0;">
					<?php echo $this->Form->input('amount', ['label' => false,'class' => 'form-control input-sm mian_amount','placeholder'=>'Amount']); ?>
				</div>
			</div>
			</td>
			
			<td><?php echo $this->Form->input('narration', ['type'=>'textarea','label' => false,'class' => 'form-control input-sm','placeholder'=>'Narration']); ?></td>
			<td><a class="btn btn-xs btn-default deleterow" href="#" role="button"><i class="fa fa-times"></i></a></td>
		</tr>
	</tbody>
</table>