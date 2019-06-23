<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo lang('companyreport'); ?></title>
</head>

<body>

<style>
    body,table th,td{
        font-size: 11px;
        font-family: sans-serif;
    }
	
	 @page { margin: 10px 10px; }
     #header { left: 0px; top: 0px; right: 0px; text-align: center;  }
     #footer { left: 0px; bottom: 30px; right: 0px; font-size: 11px; font-family: sans-serif; text-align:right; }	
	  #content{
    	 border-bottom:0px solid #000000;
	 }
     #footer .page:after { content: counter(page, upper-roman); }
	#content{
	background-color:#FFFFFF;
	} 
</style>

<div id="header">
    <h2><?php echo lang('sell_in') . ' - ' . lang('companyreport'); ?></h2>
</div>

<div id="content" style="text-align:center;">
<table width="100%" border="1" cellpadding="1" cellspacing="0">
	<tr >
		<th align="center" width="5%" height="20px">No</th>
		<th align="center"><?=lang('po_date')?></th>
		<th align="center"><?=lang('receive_date')?></th>
		<th align="center"><?=lang('check_status')?></th>
		<th align="center"><?=lang('monthly_period')?></th>
		<th align="center"><?=lang('tax_status')?></th>
		<th align="center"><?=lang('tax_no')?></th>
		<th align="center"><?=lang('invoice_no')?></th>
		<th align="center"><?=lang('sp_no')?></th>
		<th align="center"><?=lang('sp_id')?></th>
		<th align="center"><?=lang('principle_code')?></th>
		<th align="center"><?=lang('principle_name')?></th>
		<th align="center"><?=lang('product_code')?></th>
		<th align="center"><?=lang('product_name')?></th>
		<th align="center"><?=lang('customer_code')?></th>
		<th align="center"><?=lang('ship_to_delivery')?></th>
		<th align="center"><?=lang('price_hna_per_ctn_before_tax')?></th>
		<th align="center"><?=lang('price_hna_per_ctn_after_tax')?></th>
		<th align="center"><?=lang('total_order_in_ctn')?></th>
		<th align="center"><?=lang('discount')?></th>
		<th align="center"><?=lang('discount_value')?></th>
		<th align="center"><?=lang('ppn')?></th>
		<th align="center"><?=lang('net_price_in_ctn_before_tax')?></th>
		<th align="center"><?=lang('net_price_in_ctn_after_tax')?></th>
		<th align="center"><?=lang('total_value_order_in_ctn_before_tax')?></th>
		<th align="center"><?=lang('total_value_order_in_ctn_after_tax')?></th>
		<th align="center"><?=lang('top')?></th>
		<th align="center"><?=lang('due_date_invoice')?></th>
		<th align="center"><?=lang('aging_invoice')?></th>
		<th align="center"><?=lang('due_date_ar')?></th>
		<th align="center"><?=lang('payment_status')?></th>
		<th align="center"><?=lang('payment_value')?></th>
		<th align="center"><?=lang('difference')?></th>
		<th align="center"><?=lang('selling_price')?></th>
		<th align="center"><?=lang('margin_percented')?></th>
		<th align="center"><?=lang('margin_value')?></th>
		<th align="center"><?=lang('margin_contibution')?></th>
		<th align="center"><?=lang('remark')?></th>
	</tr>
	<?php 
	$i=0;
	$indonesian_month = array( "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	
    if(count($companyreports) > 0){
        $total_margin_value = 0;
		foreach($companyreports as $companyreport){
            $total_margin_value += $companyreport->margin_value;	   
		}

		foreach($companyreports as $companyreport){
			$i++;

			$aging_invoice = round((strtotime(date('Y-m-d')) - strtotime($companyreport->due_date_invoice)) / (60 * 60 * 24));
			$due_date_ar = $companyreport->top - $aging_invoice;
			$margin_contibution = $companyreport->margin_value / $total_margin_value;

   	?>
					
	<tr style="font-size:9px">
		<td align="center"><?php echo $i;?></td>
		<td><?= date('d-m-Y', strtotime($companyreport->po_date)) ?></td>
		<td><?= date('d-m-Y', strtotime($companyreport->receive_date)) ?></td>
		<td><?= $companyreport->check_status == "0" ? lang('no') : lang('yes') ?></td>
		<td><?= $indonesian_month[(int) $companyreport->monthly_period - 1] ?></td>
		<td><?= $companyreport->tax_status == "0" ? lang('non_pkp') : lang('pkp') ?></td>
		<td><?= $companyreport->tax_no ?></td>
		<td><?= $companyreport->invoice_no ?></td>
		<td><?= $companyreport->sp_no ?></td>
		<td><?= substr($companyreport->sp_no,0,3) ?></td>
		<td><?= $companyreport->principle_code ?></td>
		<td><?= $companyreport->principle_name ?></td>
		<td><?= $companyreport->product_code ?></td>
		<td><?= $companyreport->product_name ?></td>
		<td><?= $companyreport->customer_code == "" ? "-" : $companyreport->customer_code ?></td>
		<td><?= $companyreport->customer_name == "" ? "-" : $companyreport->customer_name ?></td>
		<td><?= number_format($companyreport->price_hna_per_ctn_before_tax, 0) ?></td>
		<td><?= number_format($companyreport->price_hna_per_ctn_after_tax, 0) ?></td>
		<td><?= number_format($companyreport->total_order_in_ctn, 0) ?></td>
		<td><?= number_format($companyreport->discount, 0) ?></td>
		<td><?= number_format($companyreport->discount_value, 0) ?></td>
		<td><?= number_format($companyreport->ppn, 0) ?></td>
		<td><?= number_format($companyreport->net_price_in_ctn_before_tax, 0) ?></td>
		<td><?= number_format($companyreport->net_price_in_ctn_after_tax, 0) ?></td>
		<td><?= number_format($companyreport->total_value_order_in_ctn_before_tax, 0) ?></td>
		<td><?= number_format($companyreport->total_value_order_in_ctn_after_tax, 0) ?></td>
		<td><?= number_format($companyreport->top, 0) ?></td>
		<td><?= date('d-m-Y', strtotime($companyreport->due_date_invoice)) ?></td>
		<td><?= $aging_invoice ?></td>
		<td><?= $due_date_ar ?></td>
		<td><?= $companyreport->payment_status == "0" ? lang('not_yet') : lang('done') ?></td>
		<td><?= number_format($companyreport->payment_value, 0) ?></td>
		<td><?= number_format($companyreport->difference, 0) ?></td>
		<td><?= number_format($companyreport->selling_price, 0) ?></td>
		<td><?= number_format($companyreport->margin_percented, 0) ?></td>
		<td><?= number_format($companyreport->margin_value, 0) ?></td>
		<td><?= $margin_contibution ?></td>
		<td><?= $companyreport->remark ?></td>
	</tr>
	<?php 
        }
    }
    else{
    ?>
        <tr style="font-size:9px">
		  <td align="center" colspan="40"><?= lang('no_data_available') ?></td>
        </tr>
    <?php
    }
    ?>
</table>
</div>
</body>
</html>
