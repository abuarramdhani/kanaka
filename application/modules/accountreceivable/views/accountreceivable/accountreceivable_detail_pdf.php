<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title><?= lang('accountreceivable') ?> - <?= $customer->name ?></title>
	
	<style>
		body,table th,td{
			font-size: 11px;
			font-family: sans-serif;
		}
		
		@page { margin: 10px 10px; }
		#header { left: 0px; top: 0px; right: 0px; text-align: center;  }
		#footer { left: 0px; bottom: 30px; right: 0px; font-size: 11px; font-family: sans-serif; text-align:right; }	
		#content{ border-bottom:0px solid #000000; }
		#footer .page:after { content: counter(page, upper-roman); }
		#content{ background-color:#FFFFFF; }
	</style>
</head>

<body>
	<div id="header">
		<h2><?= lang('accountreceivable') ?> - <?= $customer->name ?></h2>
	</div>

	<div id="content" style="text-align:center;">
		<table width="100%" border="1" cellpadding="1" cellspacing="0">
			<tr >
				<th align="center" width="5%" height="20px">No</th>
				<th align="center"><?=lang('name')?></th>
				<th align="center"><?=lang('nominal')?></th>
				<th align="center"><?=lang('invoice_no')?></th>
				<th align="center"><?=lang('due_date')?></th>
				<th align="center">0-30</th>
				<th align="center">31-60</th>
				<th align="center">61-90</th>
				<th align="center">> 90</th>
			</tr>
			<?php 
			$i=0;
			if(count($accountreceivables) > 0){
				foreach($accountreceivables as $row){
					$i++;
					// $due_date_invoice = date('Y-m-d', strtotime($row->receive_date . ' + ' . $row->top . ' days'));
					$due_date_invoice = $row->due_date_invoice;
					$aging_invoice = round((strtotime($due_date_invoice) - strtotime(date('Y-m-d'))) / (60 * 60 * 24));
		
			?>
							
				<tr style="font-size:9px">
					<td align="center"><?= $i ?></td>
					<td><?= $row->customer_name == "" ? "-" : $row->customer_name ?></td>
					<td align="right"><?=  number_format($row->total_value_order_in_ctn_after_tax, 0) ?></td>
					<td><?= $row->invoice_no ?></td>
					<td><?= date('d-m-Y', strtotime($due_date_invoice)) ?></td>
					<td><?= $aging_invoice <= 30 ? number_format($row->difference, 0) : 0 ?></td>
					<td><?= $aging_invoice >= 31 && $aging_invoice <= 60 ? number_format($row->difference, 0) : 0 ?></td>
					<td><?= $aging_invoice >= 61 && $aging_invoice <= 90 ? number_format($row->difference, 0) : 0 ?></td>
					<td><?= $aging_invoice >= 91 ? number_format($row->difference, 0) : 0 ?></td>
				</tr>
			<?php 
				}
			}
			else{
			?>
				<tr style="font-size:9px">
					<td align="center" colspan="9"><?= lang('no_data_available') ?></td>
				</tr>
			<?php
			}
			?>
		</table>
	</div>
</body>
</html>
