<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title><?= lang('accountreceivable') ?></title>
	
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
		<h2><?= lang('accountreceivable') ?></h2>
	</div>

	<div id="content" style="text-align:center;">
		<table width="100%" border="1" cellpadding="1" cellspacing="0">
			<tr >
				<th  align="center" width="5%" height="20px">No</th>
				<th  align="center"><?=lang('name')?></th>
				<th  align="center"><?=lang('nominal')?></th>
				<th  align="center"><?=lang('status')?></th>
			</tr>
			<?php 
			$i=0;
			if(count($accountreceivables) > 0){
				foreach($accountreceivables as $row){
					$i++;
					$row_si = Companyreportout::selectRaw('SUM(difference) as nominal')
							->where('customer_id', '=', $row->id)
							->where('payment_status', '!=', 3)
							->where('deleted', '=', 0)
							->first();

					$payment_status = 'Lunas';
					if($row->payment_status == '0'){
						$payment_status = 'Belum Bayar';
					}
					else if($row->payment_status == '1'){
						$payment_status = 'Cicil';
					}
					else if($row->payment_status == '2'){
						$payment_status = 'Sudah Lewat Jatuh Tempo';
					}
			?>
							
				<tr style="font-size:9px">
					<td align="center"><?= $i ?></td>
					<td><?= $row->name ?></td>
					<td align="right"><?= number_format($row_si->nominal, 0) ?></td>
					<td><?= $payment_status ?></td>
				</tr>
			<?php 
				}
			}
			else{
			?>
				<tr style="font-size:9px">
					<td align="center" colspan="4"><?= lang('no_data_available') ?></td>
				</tr>
			<?php
			}
			?>
		</table>
	</div>
</body>
</html>
