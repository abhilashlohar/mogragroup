<div class="form-group">
<label class="control-label">Customer</label>
<?php 
$options[]=['text' =>$Customer->customer_name.'('.$Customer->alias.')', 'value' => $Customer->id];
echo $this->Form->input('customer_id', ['label' => false,'options' => $options,'class' => 'form-control input-sm ']); ?>
</div>