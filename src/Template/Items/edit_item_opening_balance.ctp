
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel">Edit Item opening balance</span>
		</div>
		
		<div class="actions">
			<?= $this->Html->link(
				'Add',
				'/Items/Opening-Balance',
				['class' => 'btn btn-default']
			); ?>
			<?= $this->Html->link(
				'View',
				'/Items/Opening-Balance-View',
				['class' => 'btn btn-default']
			); ?>
		</div>
	</div>
	<div class="portlet-body form">
	<?= $this->Form->create($ItemLedger,['id'=>'form_sample_3']) ?>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label">Item <span class="required" aria-required="true">*</span></label>
					<br/>
					<label><?php echo $Items->name; ?></label>
					<?php echo $this->Form->input('item_id', ['type' => 'hidden','value' =>$Items->id]); ?>
					
				</div>
			</div>
			<div class="col-md-5"></div>
			<div class="col-md-3">
				<div class="form-group">
					<label class="control-label">Date <span class="required" aria-required="true">*</span></label>
					<?php echo $this->Form->input('date', ['type' => 'text','label' => false,'class' => 'form-control input-sm ','data-date-format' => 'dd-mm-yyyy','value' =>date("d-m-Y",strtotime($financial_year->date_from)),'readonly']); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label class="control-label">Old Quantity <span class="required" aria-required="true">*</span></label>
					<?php echo $this->Form->input('quantity', ['type'=>'text','label' => false,'class' => 'form-control input-sm','readonly','placeholder'=>'Quantity']); ?>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label class="control-label">New Quantity <span class="required" aria-required="true">*</span></label>
					<?php echo $this->Form->input('new_quantity', ['type'=>'text','label' => false,'class' => 'form-control input-sm','value' => 0,'placeholder'=>'New Quantity']); ?>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label class="control-label">Rate <span class="required" aria-required="true">*</span></label>
					<?php echo $this->Form->input('rate', ['type'=>'text','label' => false,'class' => 'form-control input-sm','placeholder'=>'Rate']); ?>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label class="control-label">Value <span class="required" aria-required="true">*</span></label>
					<?php 
					echo $this->Form->input('value', ['type'=>'text','label' => false,'class' => 'form-control input-sm','placeholder'=>'Value']); ?>
				</div>
			</div>
			<div class="col-md-3">
				<label class="control-label">serial_number_enable</label>
				<div class="checkbox-list">
					<?php  
					if($SerialNumberEnable[0]->serial_number_enable == '1' && $ItemLedger->quantity > 0){
						echo $this->Form->radio('serial_number_enable',[['value' => '1', 'text' => 'Yes', 'checked']]); 
					}
					
					
					if($SerialNumberEnable[0]->serial_number_enable == '1' && $ItemLedger->quantity == 0 ){
						echo $this->Form->radio('serial_number_enable',[['value' => '1', 'text' => 'Yes', 'checked'],['value' => '0', 'text' => 'No']]); 
					}
					
					if($SerialNumberEnable[0]->serial_number_enable == '0'){
					echo $this->Form->radio('serial_number_enable',[['value' => '1', 'text' => 'Yes'],['value' => '0', 'text' => 'No', 'checked']]); 	
					}
					?>
					
				</div>
			</div>
		</div>
		
		<div class="row" >
			<div class="col-md-3" id="itm_srl_num"></div>
			<div class="col-md-4"></div>
			<div class="col-md-5" id="show_data" >
			 <table   class="table table-hover" >
				 <thead>
					<tr>
						<th width="20%">Sr. No.</th>
						<th>Serial Number</th>
						<th width="10%">Action</th>
						
					</tr>
				</thead>
				<tbody>
				<?php $i=0; foreach ($ItemSerialNumbers as $ItemSerialNumber){ $i++;?>
				<tr>
						<td><?= h($i) ?></td>
						<td><?= h($ItemSerialNumber->serial_no); ?></td>
						<td>
						 	
							<?= $this->Html->link('<i class="fa fa-trash"></i> ',
									['action' => 'DeleteSerialNumbers', $ItemSerialNumber->id, $ItemSerialNumber->item_id], 
									[
										'escape' => false,
										'class' => 'btn btn-xs red',
										'confirm' => __('Are you sure, you want to delete {0}?', $ItemSerialNumber->id)
									]
								) ?>
							
						</td>
					</tr>
				<?php  } ?>
				</tbody>
			</table>
			</div>
		</div>
		
		
		
		<button type="submit" class="btn blue-hoki">Submit</button>
	<?= $this->Form->end() ?>
	</div>
</div>
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
			item_id :{
				required: true,
			},
			quantity  : {
				  required: true,
			},
			rate    : {
				  required: true,
			}
		},

		messages: { // custom messages for radio buttons and checkboxes
			membership: {
				required: "Please select a Membership type"
			},
			service: {
				required: "Please select  at least 2 types of Service",
				minlength: jQuery.validator.format("Please select  at least {0} types of Service")
			}
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
			//Metronic.scrollTo(error3, -200);
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
			success3.show();
			error3.hide();
			form[0].submit(); // submit the form
		}

	});
	//--	 END OF VALIDATION
	function calculate_value()
	{
		var quantity=parseFloat($('input[name="quantity"]').val());
		var newquantity=parseFloat($('input[name="new_quantity"]').val());
		
		var totalquantity = quantity+newquantity;
		if(isNaN(totalquantity)) { var totalquantity = 0; }
		var rate=parseFloat($('input[name="rate"]').val());
		if(isNaN(rate)) { var rate = 0; }
		var total=totalquantity*rate;
		$('input[name="value"]').val(total.toFixed(2));
	}	
	
	calculate_value();
	
	$('input[name="new_quantity"],input[name="rate"]').die().live("blur",function() { 
		calculate_value();
    });
	
	$('input[name="value"]').die().live("blur",function() { 
		var quantity=parseFloat($('input[name="quantity"]').val());
		var newquantity=parseFloat($('input[name="new_quantity"]').val());
		var totalquantity = quantity+newquantity;
		if(isNaN(totalquantity)) { var totalquantity = 0; }
		var value=parseFloat($('input[name="value"]').val());
		if(isNaN(value)) { var value = 0; }
		
		var total=value/totalquantity;
	
		$('input[name="rate"]').val(total.toFixed(6));
    });



 
	$('input[name="serial_number_enable"]').die().live("change",function() {
		add_sr_textbox();
		
	});
	
	
		
  
   $('input[name="quantity"]').die().live("keyup",function() {
	  $('#itm_srl_num').find('input.sr_no').remove();
		add_sr_textbox();
	
    });
	$('input[name="new_quantity"]').die().live("keyup",function() {
	  $('#itm_srl_num').find('input.sr_no').remove();
		add_sr_textbox();
	
    });
	
	show_table();
	
	function show_table(){
		var serial_numbers=$('input[name=serial_number_enable]:checked').val(); 
		if(serial_numbers == '1'){
			$('#show_data').css("display", "block");
		}else{
			$('#show_data').css("display", "none");
		}
	}
	
	 function add_sr_textbox(){
	   var serial_number=$('input[name=serial_number_enable]:checked').val(); 
	   var itemserial_number_status = '<?php echo $SerialNumberEnable[0]->serial_number_enable;?>';
		if(itemserial_number_status == '1'){
				var tq=parseInt($('input[name="new_quantity"]').val());
		}else{
			    var old_quantity=parseInt($('input[name="quantity"]').val());
				var new_quantity=parseInt($('input[name="new_quantity"]').val());
				var tq=old_quantity+new_quantity;
		}
	   
	   
		if(serial_number=='1'){ 
			var p=1;
			var r=0;
			$('#itm_srl_num').find('input.sr_no').remove();
			$('#itm_srl_num').find('span.help-block-error').remove();
			for (i = 0; i < tq; i++) {
			$('#itm_srl_num').append('<input type="text" class="sr_no" name="serial_numbers['+r+'][]" placeholder="'+p+' serial number" id="sr_no'+r+'" />');
			
			$('#itm_srl_num').find('input#sr_no'+r).rules('add', {required: true});
			p++;
			r++;
			}
			
			$('#show_data').css("display", "block");
		}
		else if(serial_number=='0'){ 
			$('#itm_srl_num').html('');
			$('#show_data').css("display", "none");
			
		}
	   
   }
   old_quantity();
   function old_quantity(){
	   var total_out=$('input[name="new_quantity"]').val();
			if(total_out < 1){
				$('#itm_srl_num').find('input.sr_no').remove();
				}
			if(total_out > 1){
				add_sr_textbox();
			}
   }
	
	function update_sr_textbox(){
		var r=0;
		var serial_number=$('input[name=serial_number_enable]:checked').val(); 
		var quantity=$('input[name="quantity"]').val();
		var l=$('#itm_srl_num').find('input').length;
		
		if(serial_number=='1'){ 
			
					if(quantity < l){
				
						for(i=l;i>=quantity;i--){ 
						
						$('input[ids="sr_no['+i+']"]').remove();
						//$('botmdiv['+i+']').remove();
						}
					}
					//
					if(quantity > l){
						//l=l+1;
						for(i=l;i<quantity;i++){
						$('#itm_srl_num').append('<div style="margin-bottom:6px;" class="botmdiv['+i+']"><input type="text" class="sr_no" name="serial_numbers['+i+'][]" ids="sr_no['+i+']" id="sr_no'+l+'"/></div>');
						
						$('#itm_srl_num').find('input#sr_no'+l).rules('add', {required: true});
						l++;
						}
					}
				}
				
		else{
				$('#itm_srl_num').find('input.sr_no').remove();
		}
	}
	
   
});
</script>