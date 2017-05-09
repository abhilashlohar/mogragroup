<style>
@media print{
.maindiv{
width:100% !important;
}	
	
}
</style>
<a class="btn  blue hidden-print margin-bottom-5 pull-right" onclick="javascript:window.print();">Print <i class="fa fa-print"></i></a>

<div style="border:solid 1px #c7c7c7;background-color: #FFF;padding: 10px;margin: auto;width: 55%;font-size:14px;" class="maindiv">	
<table width="100%" class="divHeader">
		<tr>
			<td width="30%"><?php echo $this->Html->image('/logos/'.$creditNote->company->logo, ['width' => '40%']); ?></td>
			<td align="center" width="40%" style="font-size: 12px;"><div align="center" style="font-size: 16px;font-weight: bold;color: #0685a8;">CREDIT NOTE</div></td>
			<td align="right" width="30%" style="font-size: 12px;">
			<span style="font-size: 14px;"><?= h($creditNote->company->name) ?></span>
			<span><?= $this->Text->autoParagraph(h($creditNote->company->address)) ?>
			<?= h($creditNote->company->mobile_no) ?></span>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<div style="border:solid 2px #0685a8;margin-bottom:5px;margin-top: 5px;"></div>
			</td>
		</tr>
	</table>
	<table width="100%">
		<tr>
			<td width="50%" valign="top" align="left">
				<table>
					<tr>
						<td>Voucher No</td>
						<td width="20" align="center">:</td>
						<td><?= h('#'.str_pad($creditNote->voucher_no, 4, '0', STR_PAD_LEFT)) ?></td>
					</tr>
				</table>
			</td>
			<td width="50%" valign="top" align="right">
				<table>
					<tr>
						<td>Date.</td>
						<td width="20" align="center">:</td>
						<td><?= h(date("d-m-Y",strtotime($creditNote->transaction_date))) ?></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	
	<div style="height:3px;" class="hdrmargin"></div>
	<table class="table-advance itmtbl">
		<tfoot>
			
			
			<tr>
				<td>In Favour of <?= h($creditNote->Parties->name) ?> </td>
			</tr>
			<tr>
				<td>Rupees <?php echo ucwords($this->NumberWords->convert_number_to_words($creditNote->amount)) ?> Only </td>
			</tr>
			<tr>
				<td><?= $this->Text->autoParagraph(h($creditNote->narration)) ?> </td>
			</tr>
		</tfoot>
	</table>
	
	<div style="border:solid 1px ;"></div>
	<table width="100%" class="divFooter">
		<tr>
			<td align="left" valign="top">
				<table>
					<tr>
						<td style="font-size: 16px;font-weight: bold;">
						Rs: <?=h($creditNote->amount) ?>
					</tr>
				</table>
			</td>
			
		</tr>
	</table>
	<br/>
	<table width="100%" class="table_rows ">
		<tr>
		<td align="center" width="25%"> 
		
		</td>
		   <td align="right" width="15%"> 
		
			 <?php 
			 echo $this->Html->Image('/signatures/'.$creditNote->creator->signature,['height'=>'50px','style'=>'height:50px;']); 
			 ?></br>
			 </hr>
			 <span><b>Prepared By</b></span><br/>
			 <span><?= h($creditNote->creator->name) ?></span><br/>
			</td>
		 </tr>
	</table>
</div>
</div>
