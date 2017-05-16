<?php //pr($customers); exit;?>
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel uppercase">Overdues For CUSTOMERS</span>
		</div>
	</div>
	<input type="text" class="form-control input-sm pull-right" placeholder="Search..." id="search3"  style="width: 20%;">
	<div class="portlet-body">
	 
		<div class="table-scrollable">
			<table class="table table-bordered table-striped" id="main_tble">
				 <thead>
					<tr>
						<th>Sr. No.</th>
						<th>Customer Name</th>
						<th>Over-Due</th>
					</tr>
				</thead>
				<tbody>
					<?php  $page_no=0;
					foreach ($over_due_report as $key=>$over_due_reports){ 
						if($over_due_reports>0){
					?>
					<tr>
						<td><?= h(++$page_no) ?></td>
						<td><?php echo $custmer_name[$key]."(". $custmer_alise[$key].")"?></td>
						<td><?= h($over_due_reports) ?></td>
						
					</tr>
					<?php }} ?>
				</tbody>
			</table>
		</div>
		
	</div>
</div>

<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
<script>
$(document).ready(function() {
var $rows = $('#main_tble tbody tr');
	$('#search3').on('keyup',function() {
	
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