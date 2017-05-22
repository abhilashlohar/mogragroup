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
					<div class="col-md-5">
						<div class="form-group">
							<label class="col-md-5 control-label">Customer/Suppiler<span class="required" aria-required="true">*</span></label>
							<div class="col-md-7">
								<?php echo $this->Form->input('sales_acc_id', ['empty'=>'--Select-','label' => false,'class' => 'form-control input-sm select2me']); ?>
							</div>
						
						</div>
					</div>
					
					<div class="col-md-4">
						<div class="form-group">
							<label class="col-md-3 control-label">Date</label>
							<div class="col-md-9">
								<?php echo $this->Form->input('created_on', ['type' => 'text','label' => false,'class' => 'form-control input-sm','value' => date("d-m-Y"),'readonly']); ?>
							</div>
						</div>
					</div>
				</div>
				<br>
					<div style="overflow: auto;">
						<table width="100%" id="main_table">
							<thead>
								<th width="30%"><label class="control-label">Paid TO</label></th>
								<th width="30%"><label class="control-label">Amount</label></th>
								<th width="30%"><label class="control-label">Narration</label></th>
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

<br /> <br />
			<?php $ref_types=['New Reference'=>'New Ref','Against Reference'=>'Agst Ref','Advance Reference'=>'Advance']; ?>
				
				<div class="row">
					<div class="col-md-8">
					<table width="100%" class="main_ref_table">
						<thead>
							<tr>
								<th width="25%">Ref Type</th>
								<th width="40%">Ref No.</th>
								<th width="30%">Amount</th>
								<th width="5%"></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php echo $this->Form->input('ref_types', ['empty'=>'--Select-','options'=>$ref_types,'label' => false,'class' => 'form-control input-sm ref_type']); ?></td>
								<td class="ref_no"></td>
								<td><?php echo $this->Form->input('amount', ['label' => false,'class' => 'form-control input-sm ref_amount_textbox','placeholder'=>'Amount']); ?></td>
								<td><a class="btn btn-xs btn-default deleterefrow" href="#" role="button"><i class="fa fa-times"></i></a></td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td align="center" style="vertical-align: middle !important;">On Account</td>
								<td></td>
								<td><?php echo $this->Form->input('on_account', ['label' => false,'class' => 'form-control input-sm on_account','placeholder'=>'Amount','readonly']); ?></td>
								<td></td>
							</tr>
							<tr>
								<td colspan="2"><a class="btn btn-xs btn-default addrefrow" href="#" role="button"><i class="fa fa-plus"></i> Add row</a></td>
								<td><input type="text" class="form-control input-sm" placeholder="total" readonly></td>
								<td></td>
							</tr>
						</tfoot>
					</table>
					</div>
				</div>


			
			<div class="form-actions">
				<button type="submit" class="btn btn-primary">ADD DEBIT NOTE</button>
			</div>
		</div>
		<?= $this->Form->end() ?>
	</div>
</div>
<?php } ?>
<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>

<script>
$(document).ready(function() {


		function add_row(){
			 var tr=$("#sample_table tbody tr").clone();
			 $("#main_table tbody#main_tbody").append(tr);
			 rename_rows();
		}	

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
	
	$('.addrow').live("click",function() {
		add_row();
	});
	
	$('.deleterow').live("click",function() {
		$(this).closest("tr").remove();
	});
	
		function rename_rows(){
		var i=0;
		$("#main_table tbody#main_tbody tr.main_tr").each(function(){
			$(this).find("td:eq(0) select.received_from").select2().attr({name:"payment_rows["+i+"][received_from_id]", id:"quotation_rows-"+i+"-received_from_id"});

			$(this).find("td:eq(1) input").attr({name:"payment_rows["+i+"][amount]", id:"quotation_rows-"+i+"-amount"});

			$(this).find("td:nth-child(4) textarea").attr({name:"payment_rows["+i+"][narration]", id:"quotation_rows-"+i+"-narration"});
			
			i++;
		});
	}
	
		
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

	$('.addrefrow').live("click",function() {
		add_ref_row();
	});
	
	
	
	function add_ref_row(){
		var tr=$("#sample_ref table.ref_table tbody tr").clone();
		$("table.main_ref_table tbody").append(tr);
		rename_ref_rows();
	}


	rename_ref_rows();
	function rename_ref_rows(){
		var i=0;
		$("table.main_ref_table tbody tr").each(function(){
			$(this).find("td:nth-child(1) select").attr({name:"ref_rows["+i+"][ref_type]", id:"ref_rows-"+i+"-ref_type"}).rules("add", "required");
			var is_select=$(this).find("td:nth-child(2) select").length;
			var is_input=$(this).find("td:nth-child(2) input").length;
			
			if(is_select){
				$(this).find("td:nth-child(2) select").attr({name:"ref_rows["+i+"][ref_no]", id:"ref_rows-"+i+"-ref_no"}).rules("add", "required");
			}else if(is_input){
				var url='<?php echo $this->Url->build(['controller'=>'Invoices','action'=>'checkRefNumberUnique']); ?>';
				url=url+'/<?php echo $c_LedgerAccount->id; ?>/'+i;
				$(this).find("td:nth-child(2) input").attr({name:"ref_rows["+i+"][ref_no]", id:"ref_rows-"+i+"-ref_no", class:"form-control input-sm ref_number"}).rules('add', {
							required: true,
							noSpace: true,
							notEqualToGroup: ['.ref_number'],
							remote: {
								url: url,
							},
							messages: {
								remote: "Not an unique."
							}
						});
			}
			
			$(this).find("td:nth-child(3) input").attr({name:"ref_rows["+i+"][ref_amount]", id:"ref_rows-"+i+"-ref_amount"}).rules("add", "required");
			i++;
		});
		
		var is_tot_input=$("table.main_ref_table tfoot tr:eq(1) td:eq(1) input").length;
		if(is_tot_input){
			$("table.main_ref_table tfoot tr:eq(1) td:eq(1) input").attr({name:"ref_rows_total", id:"ref_rows_total"}).rules('add', { equalTo: "#grand-total" });
		}
	}	
	
			
});
</script>


<table id="sample_table" style="display:none; width:100%; ">
	<tbody>
		<tr class="main_tr">
			<td><?php echo $this->Form->input('party_id', ['empty'=>'--Select-','label' => false,'class' => 'form-control input-sm received_from','required']); ?></td>
			<td>
			<div class="row">
				<div class="col-md-7" style="padding-right: 0;">
					<?php echo $this->Form->input('amount', ['label' => false,'class' => 'form-control input-sm mian_amount','placeholder'=>'Amount','required']); ?>
				</div>
			</div>
			</td>
			
			<td><?php echo $this->Form->input('narration', ['type'=>'textarea','label' => false,'class' => 'form-control input-sm','placeholder'=>'Narration','required']); ?></td>
			<td><a class="btn btn-xs btn-default deleterow" href="#" role="button"><i class="fa fa-times"></i></a></td>
		</tr>
	</tbody>
</table>