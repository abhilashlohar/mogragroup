<<<<<<< HEAD
<style>
@media print{
    .maindiv{
        width:100% !important;
    }   
    .hidden-print{
        display:none;
    }
}
p{
margin-bottom: 0;
}
</style>
<style type="text/css" media="print">
@page {
    size: auto;   /* auto is the initial value */
    margin: 0 5px 0 20px;  /* this affects the margin in the printer settings */
}
</style>
<a class="btn  blue hidden-print margin-bottom-5 pull-right" onclick="javascript:window.print();">Print <i class="fa fa-print"></i></a>

<div style="border:solid 1px #c7c7c7;background-color: #FFF;padding: 10px;margin: auto;width: 55%;font-size: 14px;" class="maindiv">    
    <table width="100%" class="divHeader">
        <tr>
            <td width="30%"><?php echo $this->Html->image('/logos/'.$contravouchers->company->logo, ['width' => '40%']); ?></td>
            <td align="center" width="30%" style="font-size: 12px;"><div align="center" style="font-size: 16px;font-weight: bold;color: #0685a8;">PAYMENT VOUCHER</div></td>
            <td align="right" width="40%" style="font-size: 12px;">
            <span style="font-size: 14px;"><?= h($contravouchers->company->name) ?></span>
            <span><?= $this->Text->autoParagraph(h($contravouchers->company->address)) ?>
            <?= h($contravouchers->company->mobile_no) ?></span>
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
                        <td><?= h('#'.str_pad($contravouchers->voucher_no, 4, '0', STR_PAD_LEFT)) ?></td>
                    </tr>
                </table>
            </td>
            <td width="50%" valign="top" align="right">
                <table>
                    <tr>
                        <td>Date.</td>
                        <td width="20" align="center">:</td>
                        <td><?= h(date("d-m-Y",strtotime($contravouchers->transaction_date))) ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br/>
    <table width="100%" class="table" style="font-size:12px">
        <tr>
            <th><?= __('Paid to') ?></th>
            <th><?= __('Amount') ?></th>
            <th><?= __('Narration') ?></th>
        </tr>
        <?php $total_cr=0; $total_dr=0; foreach ($contravouchers->payment_rows as $contravouchersRows): ?>
        <tr>
            <td style="white-space: nowrap;"><?= h($contravouchersRows->ReceivedFrom->name) ?></td>
            <td style="white-space: nowrap;"><?= h($this->Number->format($contravouchersRows->amount,[ 'places' => 2])) ?> <?= h($contravouchersRows->cr_dr) ?></td>
            <td><?= h($contravouchersRows->narration) ?></td>
        </tr>
        <?php if($contravouchersRows->cr_dr=="Cr"){
            $total_cr=$total_cr+$contravouchersRows->amount;
        }else{
            $total_dr=$total_dr+$contravouchersRows->amount;
        }
        $total=$total_dr-$total_cr; endforeach; ?>
    </table>
    
    
    
    <div style="border:solid 1px ;"></div>
    <table width="100%" class="divFooter">
        <tr>
            <td align="left" valign="top">
                <table>
                    <tr>
                        <td style="font-size: 16px;font-weight: bold;">
                        Rs: <?= h($this->Number->format($total,[ 'places' => 2])) ?></td>
                    </tr>
                    <tr>
                        <td style="font-size: 12px;">Rupees<?php echo ucwords($this->NumberWords->convert_number_to_words($total)) ?> Only </td>
                    </tr>
                    <tr>
                        <td style="font-size: 12px;">
                        via <?= h($contravouchers->payment_mode) ?> 
                        <?php if($contravouchers->payment_mode=="Cheque"){
                            echo ' ('.$contravouchers->cheque_no.')';
                        } ?>
                        </td>
                    </tr>
                </table>
            </td>
            <td align="right" valign="top" width="35%">
                <table style="margin-top:3px;">
                    <tr>
                       <td width="15%" align="center"> 
                        <?php 
                         echo $this->Html->Image('/signatures/'.$contravouchers->creator->signature,['height'=>'40px','style'=>'height:40px;']); 
                         ?></br>
                         </hr>
                         <span><b>Prepared By</b></span><br/>
                         <span><?= h($contravouchers->company->name) ?></span><br/>
                        </td>
                    </tr>
                </table>
             </td>
        </tr>
    </table>
=======
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Contra Voucher'), ['action' => 'edit', $contraVoucher->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Contra Voucher'), ['action' => 'delete', $contraVoucher->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contraVoucher->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Contra Vouchers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Contra Voucher'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Contra Voucher Rows'), ['controller' => 'ContraVoucherRows', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Contra Voucher Row'), ['controller' => 'ContraVoucherRows', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="contraVouchers view large-9 medium-8 columns content">
    <h3><?= h($contraVoucher->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Payment Mode') ?></th>
            <td><?= h($contraVoucher->payment_mode) ?></td>
        </tr>
        <tr>
            <th><?= __('Company') ?></th>
            <td><?= $contraVoucher->has('company') ? $this->Html->link($contraVoucher->company->name, ['controller' => 'Companies', 'action' => 'view', $contraVoucher->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Cheque No') ?></th>
            <td><?= h($contraVoucher->cheque_no) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($contraVoucher->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Voucher No') ?></th>
            <td><?= $this->Number->format($contraVoucher->voucher_no) ?></td>
        </tr>
        <tr>
            <th><?= __('Bank Cash Id') ?></th>
            <td><?= $this->Number->format($contraVoucher->bank_cash_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created By') ?></th>
            <td><?= $this->Number->format($contraVoucher->created_by) ?></td>
        </tr>
        <tr>
            <th><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($contraVoucher->edited_by) ?></td>
        </tr>
        <tr>
            <th><?= __('Created On') ?></th>
            <td><?= h($contraVoucher->created_on) ?></td>
        </tr>
        <tr>
            <th><?= __('Transaction Date') ?></th>
            <td><?= h($contraVoucher->transaction_date) ?></td>
        </tr>
        <tr>
            <th><?= __('Edited On') ?></th>
            <td><?= h($contraVoucher->edited_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Contra Voucher Rows') ?></h4>
        <?php if (!empty($contraVoucher->contra_voucher_rows)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Contra Voucher Id') ?></th>
                <th><?= __('Received From Id') ?></th>
                <th><?= __('Amount') ?></th>
                <th><?= __('Cr Dr') ?></th>
                <th><?= __('Narration') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($contraVoucher->contra_voucher_rows as $contraVoucherRows): ?>
            <tr>
                <td><?= h($contraVoucherRows->id) ?></td>
                <td><?= h($contraVoucherRows->contra_voucher_id) ?></td>
                <td><?= h($contraVoucherRows->received_from_id) ?></td>
                <td><?= h($contraVoucherRows->amount) ?></td>
                <td><?= h($contraVoucherRows->cr_dr) ?></td>
                <td><?= h($contraVoucherRows->narration) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ContraVoucherRows', 'action' => 'view', $contraVoucherRows->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ContraVoucherRows', 'action' => 'edit', $contraVoucherRows->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ContraVoucherRows', 'action' => 'delete', $contraVoucherRows->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contraVoucherRows->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
>>>>>>> origin/master
</div>

