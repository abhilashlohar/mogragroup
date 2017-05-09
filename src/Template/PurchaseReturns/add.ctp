<style>
.row_textbox{
	width: 100px;
}
.check_text{
	font-size:9px;
}
.add_check_text{
	font-size:9px;
}	
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
	vertical-align: top !important;
}
#main_tb thead th {
	font-size:10px;
}
</style>
<?php 
$this->Form->templates([
				'inputContainer' => '{{content}}'
			]);
			
    if($financial_year_data['Response'] == "Close" ){
 			echo "Financial Year Closed"; 

 		} else { ?>
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel uppercase">Add Purchase Return</span>
		</div>
		
	</div>
	
	
	<div class="portlet-body form">
		<?= $this->Form->create($purchaseReturn,['id'=> 'form_sample_3']) ?>
		
			<div class="form-body">
			
				<div class="row">
					
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">GRN No.</label>
							<br/>
							<?= h(($invoiceBooking->grn->grn1.'/GRN-'.str_pad($invoiceBooking->grn->grn2, 3, '0', STR_PAD_LEFT).'/'.$invoiceBooking->grn->grn3.'/'.$invoiceBooking->grn->grn4)) ?>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">Supplier </label>
							<br/>
							<?php  echo @$invoiceBooking->grn->vendor->company_name; ?>
						</div>
					</div>
					<div class="col-md-3" >
						<div class="form-group">
							<label class="control-label">Invoice Booking No</label></br>
							<?php echo $invoiceBooking->ib1.'/IB-'.str_pad($invoiceBooking->ib2, 3, '0', STR_PAD_LEFT).'/'.$invoiceBooking->ib3.'/'.$invoiceBooking->ib4; ?>
							<br/>
							<? ?>
						</div>
					</div>
					<div class="col-md-2 pull-right">
									<div class="form-group">
										<label class="control-label">Date</label>
										<br/>
										<?php echo date("d-m-Y"); ?>
									</div>
								</div>
				</div><br/>
			<div style="overflow: auto;">
			<input type="text"  name="checked_row_length" id="checked_row_length" style="height: 0px;padding: 0;border: none;" value="" />
				<table class="table tableitm" id="main_tb">
				<thead>
					<tr>
						<th width="5%">Sr.No. </th>
						<th >Items</th>
						<th  width="4%"></th>
						<th align="center" width="10%">Quantity</th>
						<th align="center" width="10%">Ammount</th>
						<th  width="4%"></th>
						
					</tr>
				</thead>
				<tbody>
					<?php
					$q=0; foreach ($invoiceBooking->invoice_booking_rows as $invoice_booking_row): ?>
						<tr class="tr1" row_no='<?php echo @$invoice_booking_row->id; ?>'>
							<td ><?php echo ++$q; ?></td>
							<td style="white-space: nowrap;"><?php echo $invoice_booking_row->item->name; ?>
							<?php echo $this->Form->input('invoice_booking_rows.'.$q.'.item_id', ['label' => false,'class' => 'form-control input-sm','type'=>'hidden','value' => @$invoice_booking_row->item->id]); ?>
							</td>
							<td><?php echo $this->Form->input('invoice_booking_rows.'.$q.'.ib_ammount',['label' => false,'class' => 'form-control input-sm','type'=>'hidden','value'=>$invoice_booking_row->total]); ?>
							</td>
							<td><?php echo $this->Form->input('invoice_booking_rows.'.$q.'.quantity',['label' => false,'class' => 'form-control input-sm quantity','type'=>'text','value'=>$invoice_booking_row->quantity,'max'=>$invoice_booking_row->quantity]); ?></td>
							<td><?php echo $this->Form->input('invoice_booking_rows.'.$q.'.ib_ammount',['label' => false,'class' => 'form-control input-sm','type'=>'hidden','value'=>$invoice_booking_row->total]); ?>
							<?php echo $this->Form->input('invoice_booking_rows.'.$q.'.total',['label' => false,'class' => 'form-control input-sm','type'=>'text','value'=>$invoice_booking_row->total]); ?></td>
							<td>
								<label><?php echo $this->Form->input('check.'.$q, ['label' => false,'type'=>'checkbox','class'=>'rename_check','value' => @$invoice_booking_row->item->id]); ?></label>
							</td>
						</tr>
					<?php   endforeach; ?>
				</tbody>
			</table>
			</div>
			
		</div>
		<div class="form-actions">
			<div class="row">
				<div class="col-md-3">
				<?= $this->Form->button(__('UPDATE BOOK INVOICE'),['class'=>'btn btn-primary','id'=>'add_submit','type'=>'Submit']) ?>
					
				</div>
			</div>
		</div>
	</div>	
		<?= $this->Form->end() ?>
</div>	
						

<style>
.table thead tr th {
    color: #FFF;
	background-color: #254b73;
}
</style>
<?php echo $this->Html->css('/drag_drop/jquery-ui.css'); ?>
<?php echo $this->Html->script('/drag_drop/jquery-1.12.4.js'); ?>
<?php echo $this->Html->script('/drag_drop/jquery-ui.js'); ?>
<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
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
			checked_row_length: {
				required: true,
				min : 1,
			},
		},

		messages: { // custom messages for radio buttons and checkboxes
			checked_row_length: {
				required : "Please select atleast one row.",
				min: "Please select atleast one row."
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
			rename_rows();
			success3.show();
			error3.hide();
			form[0].submit();
		}
	});	

	$('.rename_check').die().live("click",function() {
		rename_rows();    calculate_total();
    });	
	$('.quantity').die().live("keyup",function() {
		var qty =$(this).val();
			rename_rows(); 
    });
	rename_rows();
	function rename_rows(){
		var i=0;
		$("#main_tb tbody tr.tr1").each(function(){  //alert();
			var row_no=$(this).attr('row_no');
			var val=$(this).find('td:nth-child(6) input[type="checkbox"]:checked').val();
			if(val){
				i++;
				$(this).find('td:nth-child(2) input').attr("name","purchase_return_rows["+row_no+"][item_id]").attr("id","purchase_return_rows-"+row_no+"-item_id").rules("add", "required");
				$(this).find('td:nth-child(3) input').attr("name","purchase_return_rows["+row_no+"][ib_ammount]").attr("id","purchase_return_rows-"+row_no+"-ib_ammount").removeAttr("readonly").rules("add", "required");
				$(this).find('td:nth-child(4) input').attr("name","purchase_return_rows["+row_no+"][quantity]").attr("id","purchase_return_rows-"+row_no+"-quantity").removeAttr("readonly").rules("add", "required");
				$(this).find('td:nth-child(5) input').attr("name","purchase_return_rows["+row_no+"][total]").attr("id","purchase_return_rows-"+row_no+"-total").rules("add", "required");
				$(this).css('background-color','#fffcda');
			}else{
				$(this).find('td:nth-child(2) input').attr({ name:"q" , readonly:"readonly"}).rules( "remove", "required" );
				$(this).find('td:nth-child(3) input').attr({ name:"q" , readonly:"readonly"}).rules( "remove", "required" );
				$(this).find('td:nth-child(3) input').attr({ name:"q" , readonly:"readonly"}).rules( "remove", "required" );
				$(this).find('td:nth-child(4) input').attr({ name:"q" , readonly:"readonly"}).rules( "remove", "required" );
				$(this).find('td:nth-child(5) input').attr({ name:"q" , readonly:"readonly"}).rules( "remove", "required" );
				$(this).css('background-color','#FFF');
			} 
			$('input[name="checked_row_length"]').val(i);
			
		});
	}
	
	function calculate_total(){
		$("#main_tb tbody tr.tr1").each(function(){  
			var val=$(this).find('td:nth-child(6) input[type="checkbox"]:checked').val();
			if(val){
				var qty=parseInt($(this).find("td:nth-child(3) input").val());
				
				var Rate=parseFloat($(this).find("td:nth-child(4) input").val());
				var Amount=Rate/qty;
				alert(qty);alert(Rate);
				//alert(qty);
				$(this).find("td:nth-child(5) td:eq(1) input").val(Amount.toFixed(2));
					//alert(val);
				}
		});
	}
});

</script>
<?php } ?>
