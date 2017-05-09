<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel uppercase">Ledger Account</span>
		</div>
		<div class="actions">
			<?php echo $this->Html->link('Account Group','/AccountGroups/',array('escape'=>false,'class'=>'btn btn-default')); ?>
			<?php echo $this->Html->link('Account First Sub Group','/AccountFirstSubgroups/',array('escape'=>false,'class'=>'btn btn-default')); ?>
			<?php echo $this->Html->link('Account Second Sub Group','/AccountSecondSubgroups/',array('escape'=>false,'class'=>'btn btn-default')); ?>
			<?php echo $this->Html->link('Ledger Account','/LedgerAccounts/',array('escape'=>false,'class'=>'btn btn-primary')); ?>
		</div>
	</div>
	 <div class="portlet-body form">
		<!-- BEGIN FORM-->
		<div class="row ">
		<div class="col-md-12">
		<?= $this->Form->create($ledgerAccount,['id'=>'form_sample_3']) ?>
			<div class="form-body">
				<div class="form-group">
					<div class="col-md-4">
					<label class="control-label">Account Second Sub Group <span class="required" aria-required="true">*</span></label>
						<?php 
						echo $this->Form->input('account_second_subgroup_id', ['options' => $accountSecondSubgroups,'empty' => "--Select--",'label' => false,'class' => 'form-control input-sm select2me ','id'=>'search', 'required']); 
						?>
					</div>
					<div class="col-md-3">
						<label class="control-label">Name <span class="required" aria-required="true">*</span></label>
						<?php 
						echo $this->Form->input('name', ['label' => false,'class' => 'form-control input-sm','placeholder'=>'Name']); 
						?>
					</div>
					<div class="col-md-4">
						<label class="control-label">Create In Companies</label>
						<div class="checkbox-list" data-error-container="#form_2_services_error">
						<?php echo $this->Form->input('companies._ids', ['label' => false,'options' => $Companies,'multiple' => 'checkbox']); ?>
						</div>
						<div id="form_2_services_error"></div>

					</div>
					<div class="col-md-1">
					<label class="control-label"> <span class="required" aria-required="true"></span> </label><br/>
						<?php 
						echo $this->Form->button(__('ADD'),['class'=>'btn btn-primary']); 
						?>
					</div>
				</div>
			</div>
		<?= $this->Form->end() ?>
		</div>
		<!-- END FORM-->
		</div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<br/>
		<input type="text" class="form-control input-sm" placeholder="Search..." id="search2"  style="width: 20%;" >
		<div class="row ">
			<div class="col-md-12">
				<div class="table-scrollable">
				 <?php $page_no=$this->Paginator->current('LedgerAccounts'); $page_no=($page_no-1)*20; ?>
					<table class="table table-bordered table-striped table-hover" id="main_tble">
						 <thead>
							<tr>
								<th>Sr. No.</th>
								<th>Account Category</th>
								<th>Account Group</th>
								<th>Account First Subgroup </th>
								<th>Account Second Subgroup </th>	
								<th>Ledger Account </th>	
								<th width="80">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=0;foreach ($ledgerAccounts as $ledgerAccount): $i++; 
							$secondsubgroup=$ledgerAccount->account_second_subgroup->name;
							$firstsubgroup=$ledgerAccount->account_second_subgroup->account_first_subgroup->name;
							$group=$ledgerAccount->account_second_subgroup->account_first_subgroup->account_group->name;
							$category=$ledgerAccount->account_second_subgroup->account_first_subgroup->account_group->account_category->name;
							?>
							<tr>
								<td><?= h(++$page_no) ?></td>
								<td><?= h($category) ?></td>
								<td><?= h($group) ?></td>
								<td><?= h($firstsubgroup) ?></td>
								<td><?= h($secondsubgroup) ?></td>
								<td>
									<?= h($ledgerAccount->name) ?> 
									<?php if(!empty($ledgerAccount->alias)){ ?>  (<?= h($ledgerAccount->alias) ?>)<?php } ?>
								</td>
								<td>
								<?php if($ledgerAccount->source_model == 'Customers'){
									echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',['controller'=>'customers','action' => 'Edit', $ledgerAccount->source_id],array('escape'=>false,'class'=>'btn btn-xs blue tooltips','data-original-title'=>'Edit')); }
								if($ledgerAccount->source_model == 'SaleTax'){
									echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',['controller'=>'SaleTaxes','action' => 'Edit', $ledgerAccount->source_id],array('escape'=>false,'class'=>'btn btn-xs blue tooltips','data-original-title'=>'Edit')); }
								if($ledgerAccount->source_model == 'Employees'){
									echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',['controller'=>'Employees','action' => 'Edit', $ledgerAccount->source_id],array('escape'=>false,'class'=>'btn btn-xs blue tooltips','data-original-title'=>'Edit')); }
								if($ledgerAccount->source_model == 'Vendors'){
									echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',['controller'=>'Vendors','action' => 'Edit', $ledgerAccount->source_id],array('escape'=>false,'class'=>'btn btn-xs blue tooltips','data-original-title'=>'Edit')); }
								if($ledgerAccount->source_model == 'Ledger Account'){
								echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',['controller'=>'LedgerAccounts','action' => 'Edit', $ledgerAccount->id],array('escape'=>false,'class'=>'btn btn-xs blue tooltips','data-original-title'=>'Edit'));
								} ?>
								<?= $this->Form->postLink('<i class="fa fa-trash"></i> ',
										['action' => 'delete', $ledgerAccount->id], 
										[
											'escape' => false,
											'class' => 'btn btn-xs btn-danger',
											'confirm' => __('Are you sure ?', $ledgerAccount->id)
										]
									) ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
				
			</div>
		
		
		<!-- END FORM-->
	</div>
</div>
</div>
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
		rules: {
				'companies[_ids][]':{
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
	
var $rows = $('#main_tble tbody tr');
	$('#search').on('change',function() {
		var val = $.trim($(this).find('option:selected').text()).replace(/ +/g, ' ').toLowerCase();
		var v = $(this).find('option:selected').val();
		if(v){
			$rows.show().filter(function() {
				var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
				return !~text.indexOf(val);
			}).hide();
		}else{
			$rows.show();
		}
	});
	
	$('#search2').on('keyup',function() {
		var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
		var v = $(this).val();
		if(v){
			$rows.show().filter(function() {
				var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
				return !~text.indexOf(val);
			}).hide();
		}else{
			$rows.show();
		}
	});
});
</script>