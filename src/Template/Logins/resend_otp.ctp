<?php
$this->Form->templates([
    'inputContainer' => '{{content}}'
]);
?>
<!-- BEGIN LOGIN FORM -->
	<?= $this->Form->create($Employee,['url'=>'/Logins/index']) ?>
		<h3 class="form-title">Login Using Mobile</h3>
       
       <div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Please Enter Mobile Number to received code</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<?php echo $this->Form->input('mobile', ['label'=>false,'class' => 'form-control','placeholder'=>'Mobile Number']); ?>
			</div>
		</div>
		<div class="form-actions">
			<label class="checkbox">
			<input type="hidden" name="remember" value="1"/> </label>
			<button type="submit" name="login_submit" class="btn green-haze pull-right">
			Get Code <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
	<?= $this->Form->end() ?>
	<!-- END LOGIN FORM -->