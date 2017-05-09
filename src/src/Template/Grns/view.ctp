<style>
@media print{
	.maindiv{
		width:100% !important;
	}	
	.hidden-print{
		display:none;
	}
}
</style>
<style type="text/css" media="print">
@page {
    size: auto;   /* auto is the initial value */
    margin: 0 5px 0 20px;  /* this affects the margin in the printer settings */
}
</style>

<a class="btn  blue hidden-print margin-bottom-5 pull-right" onclick="javascript:window.print();">Print <i class="fa fa-print"></i></a>
<div style="border:solid 1px #c7c7c7;background-color: #FFF;padding: 10px;margin: auto;width: 70%;font-size:14px;" class="maindiv">	
<table width="100%" class="divHeader">
		
		<tr>
			<td width="30%"><?php echo $this->Html->image('/logos/'.$grn->company->logo, ['width' => '40%']); ?></td>
			<td align="center" width="40%" style="font-size: 12px;"><div align="center" style="font-size: 16px;font-weight: bold;color: #0685a8;">GOOD RECEIPT NOTE</div></td>
			<td align="right" width="30%" style="font-size: 12px;">
			<span style="font-size: 14px;"><?= h($grn->company->name) ?></span>
			<span><?= $this->Text->autoParagraph(h($grn->company->address)) ?>
			<?= h($grn->company->mobile_no) ?></span>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<div style="border:solid 2px #0685a8;margin-bottom:5px;margin-top: 5px;"></div>
			</td>
		</tr>
	</table>
</br>
<table width="100%">
		<tr>
			<td width="50%" valign="top" align="left">
				<table>
					<tr>
						<td  width="38%" valign="top">GRN No</td>
						<td width="2%" valign="top">:</td>
						<td valign="top"><?= h(($grn->grn1.'/GRN-'.str_pad($grn->grn2, 3, '0', STR_PAD_LEFT).'/'.$grn->grn3.'/'.$grn->grn4)) ?></td>
					</tr>
					<tr>
						<td  width="38%" valign="top">Purchase Order No</td>
						<td width="2%" valign="top">:</td>
						<td valign="top"><?= h(($grn->purchase_order->po1.'/PO-'.str_pad($grn->purchase_order->po2, 3, '0', STR_PAD_LEFT).'/'.$grn->purchase_order->po3.'/'.$grn->purchase_order->po4)) ?></td>
					</tr>
				</table>
			</td>
			<td width="50%" valign="top" align="center">
				<table>
					<tr>
						<td  width="48%" valign="top">Date.</td>
						<td  width="2%" valign="top">:</td>
						<td valign="top"><?= h(date("d-m-Y",strtotime($grn->date_created))) ?></td>
					</tr>
					<tr>
						<td  width="38%" valign="top">Road Permit No</td>
						<td  width="2%" valign="top">:</td>
						<td valign="top"><?= h(($grn->road_permit_no)) ?></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	
</br>
<?php $page_no=$this->Paginator->current('Grns'); $page_no=($page_no-1)*20; ?>
<table width="100%" class="table tableitm"  border="0">	
<thead>
	<tr>
		<th width="20%">S.No</th>
		<th>Item Name</th>
		<th width="28%">Quantity</th>
	</tr>
</thead>
<tbody>
<?php foreach ($grn->grn_rows as $grn_row): ?>
	<tr>
		<td><?= h(++$page_no) ?></td>
		<td><?= $grn_row->item->name; ?></td>
		<td><?= $grn_row->quantity; ?></td>
	</tr>
<?php endforeach; ?>
</tbody>
</table>
<table width="100%" class="divFooter">
	<tr>
		<td align="right">
		<table>
			<tr>
				<td align="center">
				<span>For</span> <span style="font-weight: bold;"><?= h($grn->company->name)?><br/></span>
				<?php 
				 echo $this->Html->Image('/signatures/'.$grn->creator->signature,['height'=>'50px','style'=>'height:50px;']); 
				 ?></br>
				<span style="font-weight: bold;">Authorised Signatory</span>
				</br>
				<span><?= h($grn->creator->name) ?></span><br/>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>	
<style>
.table thead tr th {
    color: #FFF;
	background-color: #254b73;
}
.padding-right-decrease{
	padding-right: 0;
}
.padding-left-decrease{
	padding-left: 0;
}
</style>
</div>

