<style>
	.toast-error {
background-color: white;
    color: #bd362f;
	}
</style>

<?php
$this->Form->templates([
    'inputContainer' => '{{content}}'
]);
?>
	
	
			
<?= $this->Flash->render() ?>
			
		
<!-- BEGIN LOGIN FORM -->
	<form method="get">
	<input type="hidden" name="request" value="<?php echo @$request; ?>">
	</form>
	<?= $this->Form->create($Employee) ?>
	 
		<h3 class="form-title">Login Using Mobile</h3>
      
       <div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label">Please Enter OTP Number you received </label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<?php echo $this->Form->input('otp_no', ['label'=>false,'class' => 'form-control','placeholder'=>'OTP Number','value'=>'']); ?>
			</div>
		</div>
		<div class="form-actions">
			<button type="submit" class="btn green-haze pull-right">
			LOGIN <i class="m-icon-swapright m-icon-white"></i>
			</button>
			<?php echo $this->Html->link('Resend code','/Logins/otpCodeConfirm/'.$Employee->id.'/?request=resendotp',array('escape'=>false)); ?>
			
		</div>
	<?= $this->Form->end() ?>
	<!-- END LOGIN FORM -->