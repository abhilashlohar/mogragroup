<style>
.help-block-error{
	font-size: 10px;
}

</style>

<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption" >
			<i class="icon-globe font-blue-steel"></i>
				<span class="caption-subject font-blue-steel uppercase">Create Inventory Transfer Voucher</span>
		</div>
	</div>
	<div class="portlet-body form">
	<?= $this->Form->create($inventoryTransferVoucher,['id'=>'form_sample_3']) ?>
		<div class="row">
		
			<div class="col-md-6">
			<h5>For Out -</h5>
				
					<table id="main_table" width="50%"  class="table table-condensed table-hover">
						<thead>
							<tr>
								<th>Item</th>
								<th >Quantity</th>
								<th >Serial Number</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
					<tbody id="maintbody"></tbody>
				</table>
			</div>
			
			<div class="col-md-6">
			<h5>For In -</h5>
				<table id="main_table_1" width="50%"  class="table table-condensed table-hover">
					<thead>
						<tr>
							<th>Item</th>
							<th >Quantity</th>
							<th >Serial Number</th>
							<th >Amount</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody id="maintbody_1"></tbody>
				</table>
			</div>
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
<?= $this->Form->end() ?>		
	</div>
</div>	

<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
<script>
$(document).ready(function() {
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
	}, jQuery.format(""))
	//--------- FORM VALIDATION
	var form3 = $('#form_sample_3');
	var error3 = $('.alert-danger', form3);
	var success3 = $('.alert-success', form3);
	form3.validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-block help-block-error', // default input error message class
		focusInvalid: true, // do not focus the last invalid input
		rules: {
				
			},

		messages: { // custom messages for radio buttons and checkboxes
			
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
			validate_serial();
			validate_serial_in();
			success3.show();
			error3.hide();
			form[0].submit(); // submit the form
		}

	});
	add_row();
	add_row_1();
	$('.addrow').die().live("click",function() { 
		add_row();
    });
	$('.addrow_1').die().live("click",function() { 
		add_row_1();
	});
	
	function add_row(){
		var tr1=$("#sampletable tbody tr").clone();
		$("#main_table tbody#maintbody").append(tr1);
		rename_rows();
	}
	function add_row_1(){
		var tr2=$("#sampletable_1 tbody tr").clone();
		$("#main_table_1 tbody#maintbody_1").append(tr2);
		rename_rows_1();
	}
	rename_rows();
	rename_rows_1();
	$('.qty_bx_in').die().live("blur",function() {
		validate_serial_in();
		rename_rows_1();
		
    });
	
	

	function rename_rows(){
		var i=0;
		$("#main_table tbody#maintbody tr.main").each(function(){
			$(this).find('span.help-block-error').remove();
			$(this).attr('row_no',i);
			$(this).find("td:nth-child(1) select").select2().attr({name:"inventory_transfer_voucher_rows[out]["+i+"][item_id]", id:"inventory_transfer_voucher_rows-"+i+"-item_id"}).rules("add", "required");
			$(this).find('td:nth-child(2) input').attr({name:"inventory_transfer_voucher_rows[out]["+i+"][quantity]", id:"inventory_transfer_voucher_rows-"+i+"-quantity"}).rules("add", "required");
			if($(this).find('td:nth-child(3) select').length>0){
				$(this).find('td:nth-child(3) select').attr({name:"inventory_transfer_voucher_rows[out]["+i+"][serial_number_data][]", id:"inventory_transfer_voucher_rows-"+i+"-serial_number_data"}).rules("add", "required");
			}
		i++; });
	}
	
	$('.select_item_in').die().live("change",function() {
		rename_rows_1();
	});
	$('.qty_bx_in').die().live("change",function() {
		rename_rows_1();
    });
	
	
	function rename_rows_1(){
		var j=0;
		$("#main_table_1 tbody#maintbody_1 tr.main").each(function(){
			$(this).find('span.help-block-error').remove();
			$(this).attr('row_no',j);
			$(this).find("td:nth-child(1) select").select2().attr({name:"inventory_transfer_voucher_rows[in]["+j+"][item_id_in]", id:"inventory_transfer_voucher_rows-"+j+"-item_id_in"}).rules("add", "required");
			$(this).find('td:nth-child(2) input').attr({name:"inventory_transfer_voucher_rows[in]["+j+"][quantity_in]", id:"inventory_transfer_voucher_rows-"+j+"-quantity_in"}).rules("add", "required");
			var v = $(this).find('td:nth-child(1) option:selected').attr('serial_number_enable')
			var qty=$(this).find('td:nth-child(2) input').val();
			var d =$(this).find("td:nth-child(1) select").select2().attr({name:"inventory_transfer_voucher_rows[in]["+j+"][item_id_in]", id:"inventory_transfer_voucher_rows-"+j+"-item_id_in"}).val();
			
			if(v > 0){
				var row_no=$(this).closest('tr').attr('row_no');
				$(this).closest('tr').find('td:nth-child(3) div.sr_container').html('');
				for(var i=0; i<qty; i++){
				$(this).closest('tr').find('td:nth-child(3) div.sr_container').append('<input name="inventory_transfer_voucher_rows[in]['+j+'][sr_no][]" type="text" required="required" id="inventory_transfer_voucher_rows-'+i+'-sr_no-'+d+'" />');
				}
			}else if(v==0){
				$(this).closest('tr').find('td:nth-child(3) div.sr_container').remove();
			}
			$(this).find('td:nth-child(4) input').attr({name:"inventory_transfer_voucher_rows[in]["+j+"][amount]", id:"inventory_transfer_voucher_rows-"+j+"-amount"}).rules("add", "required");
		j++; });
	}

	$('.select_item_out').die().live("change",function() {
		var t=$(this);
		var row_no=t.closest('tr').attr('row_no');
		var select_item_id=$(this).find('option:selected').val();
		var url1="<?php echo $this->Url->build(['controller'=>'InventoryTransferVouchers','action'=>'ItemSerialNumber']); ?>";
		url1=url1+'/'+select_item_id,
		$.ajax({
			url: url1,
		}).done(function(response) { 
		$(t).closest('tr').find('td:nth-child(3)').html(response);
		$(t).closest('tr').find('td:nth-child(3) select').attr({name:"inventory_transfer_voucher_rows[out]["+row_no+"][serial_number_data][]", id:"inventory_transfer_voucher_rows-"+row_no+"-serial_number_data"});
			$(t).closest('tr').find('td:nth-child(3) select').select2({ placeholder: "Serial Number"});
  			
		});
	});
	

	
	
	
	
	$('.deleterow').die().live("click",function() {
		var l=$(this).closest("table tbody").find("tr").length;
		//alert(l);
		if (confirm("Are you sure to remove row ?") == true) {
			if(l>1){
				//var row_no=$(this).closest("tr");
				var del=$(this).closest("tr");
				$(del).remove();
				rename_rows();
			}
		} 
    });
	$('.deleterow_1').die().live("click",function() {
		var l=$(this).closest("table tbody").find("tr").length;
		if (confirm("Are you sure to remove row ?") == true) {
			if(l>1){
				//var row_no=$(this).closest("tr").attr("row_no");
				var del=$(this).closest("tr");
				$(del).remove();
				rename_rows();
			}
		} 
    });
	
	
	$('.qty_bx').die().live("keyup",function() {
		validate_serial();
    });
	
	function validate_serial(){
		$("#main_table tbody#maintbody tr.main").each(function(){
			var qty=$(this).find('td:nth-child(2) input').val();
			if($(this).find('td:nth-child(3) select').length>0){
				$(this).find('td:nth-child(3) select').attr('test',qty).rules('add', {
							required: true,
							minlength: qty,
							maxlength: qty,
							messages: {
								maxlength: "select serial number equal to quantity.",
								minlength: "select serial number equal to quantity."
							}
					});
			}
		});	
	}
	
	
	function validate_serial_in(){
		$("#main_table_1 tbody#maintbody_1 tr.main").each(function(){
			var qty=$(this).find('td:nth-child(2) input').val();
			if($(this).find('td:nth-child(3) input').length>0){
				$(this).find('td:nth-child(3) input').attr('test',qty).rules('add', {
							required: true,
							minlength: qty,
							maxlength: qty,
							messages: {
								maxlength: " serial number equal to quantity.",
								minlength: " serial number equal to quantity."
							}
					});
			}
		});	
	}
});


</script>

<table id="sampletable" style="display:none;">
	<tbody>
		<tr class="main">
			<td width="20%">
				<?php 
				$item_option=[];
				foreach($display_items as $Item){ 
					$item_option[]=['text' =>$Item->name, 'value' => $Item->id, 'serial_number_enable' => (int)$Item->serial_number_enable];
				}
				echo $this->Form->input('q', ['empty'=>'Select','options' => $item_option,'label' => false,'style'=>'width: 200px; display: block;','class' => 'form-control input-sm select_item_out item_id']); ?>
			</td>
			<td>
				<?php echo $this->Form->input('q', ['type' => 'text','label' => false,'class' => 'form-control input-sm qty_bx','placeholder' => 'Quantity']); ?>
			</td>
			<td></td>
			<td><a class="btn btn-xs btn-default addrow" href="#" role='button'><i class="fa fa-plus"></i></a><a class="btn btn-xs btn-default deleterow" href="#" role='button'><i class="fa fa-times"></i></a></td>
		</tr>
	</tbody>
</table>
<table id="sampletable_1" style="display:none;">
	<tbody>
		<tr class="main">
			<td width="20%">
				<?php 
				$item_option=[];
				foreach($display_items as $Item){ 
					$item_option[]=['text' =>$Item->name, 'value' => $Item->id, 'serial_number_enable' => (int)$Item->serial_number_enable];
				}
				echo $this->Form->input('q', ['empty'=>'Select','options' => $item_option,'label' => false,'style'=>'width: 150px; display: block;','class' => 'form-control input-sm select_item_in item_id']); ?>
			</td>
			<td width="20%"> 
				<?php echo $this->Form->input('q', ['type' => 'text','label' => false,'class' => 'form-control input-sm qty_bx_in','placeholder' => 'Quantity']); ?>
			</td>
			<td width="20%" ><div class="sr_container"></div></td>
			<td width="20%">
				<?php echo $this->Form->input('amount', ['type' => 'text','label' => false,'class' => 'form-control input-sm ','placeholder' => 'Amount']); ?>
			</td>
			<td width="20%"><a class="btn btn-xs btn-default addrow_1" href="#" role='button'><i class="fa fa-plus"></i></a><a class="btn btn-xs btn-default deleterow_1" href="#" role='button'><i class="fa fa-times"></i></a></td>
		</tr>
	</tbody>
</table>
