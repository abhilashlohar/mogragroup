<?php
$this->Form->templates([
    'inputContainer' => '{{content}}'
]);
?>
<!-- BEGIN LOGIN FORM -->
	<?= $this->Form->create($Employee) ?>
		<h3 class="form-title">Login</h3>
       
       <div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Please Contact Your Admin for your mobile is not correct</label>
			
		</div>
		
	<?= $this->Form->end() ?>
	<!-- END LOGIN FORM -->