<?php
$this->Form->templates([
    'inputContainer' => '{{content}}'
]);
?>
<!-- BEGIN LOGIN FORM -->
	<?= $this->Form->create($Employee) ?>
		<h3 class="form-title">Login Using Mobile</h3>
       
       <div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Please Enter OTP Number you received </label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<?php echo $this->Form->input('otp_no', ['label'=>false,'class' => 'form-control','placeholder'=>'OTP Number']); ?>
			</div>
		</div>
		<div class="form-actions">
			<button type="submit" class="btn green-haze pull-right">
			LOGIN <i class="m-icon-swapright m-icon-white"></i>
			</button>
			<a href="#">Didn't get the code</a>
		</div>
	<?= $this->Form->end() ?>
	<!-- END LOGIN FORM -->