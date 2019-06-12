<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title><?= lang('jurnal') ?></title>
	
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
		<h2><?= lang('jurnal') ?></h2>
	</div>

	<div id="content" style="text-align:center;">
		<table width="100%" border="1" cellpadding="1" cellspacing="0">
			<tr >
				<th  align="center" width="5%" height="20px">No</th>
				<th  align="center">Tanggal</th>
				<th  align="center">Bulan</th>
				<th  align="center">Reff</th>
				<th  align="center">Code</th>
				<th  align="center">Keterangan</th>
				<th  align="center">D/K</th>
				<th  align="center"><?=lang('pic')?></th>
				<th  align="center"><?=lang('debet')?></th>
				<th  align="center"><?=lang('kredit')?></th>
				<th  align="center"><?=lang('created_date')?></th>
			</tr>
			<?php 
			$i=0;
			$total_debit = 0;
			$total_kredit = 0;

			if(count($jurnals) > 0){
				foreach($jurnals as $row){
				$i++;
			?>
							
				<tr style="font-size:9px">
					<td align="center"><?= $i ?></td>
					<td><?= date('d-m-Y',strtotime($row->jurnal_date)) ?></td>
					<td><?= $row->month ?></td>
					<td><?= $row->reff ?></td>
					<td align="center"><?= $row->coa_code ?></td>
					<td><?= $row->coa_name ?></td>
					<td align="center"><?= $row->d_k ?></td>
					<td><?= $row->pic ?></td>
					<?php
						if($row->d_k == 'D'){
							$total_debit = $row->total;
							echo "
								<td align='right'>" . number_format($row->total, 0) . "</td>
								<td align='right'>0</td>
							";
						}elseif($row->d_k == 'K'){
							$total_kredit = $row->total;
							echo "
								<td align='right'>0</td>
								<td align='right'>" . number_format($row->total, 0) . "</td>
							";
						}
					?>
					<td><?= date('d-m-Y',strtotime($row->date_created)) ?></td>
				</tr>
				<tfoot>
					<tr>
						<td align="right" colspan="8">Total &nbsp; </td>
						<td align="right"><?= number_format($total_debit, 0) ?></td>
						<td align="right"><?= number_format($total_kredit, 0) ?></td>
						<td>&nbsp;</td>
					</tr>
				</tfoot>
			<?php 
				}
			}
			else{
			?>
				<tr style="font-size:9px">
					<td align="center" colspan="11"><?= lang('no_data_available') ?></td>
				</tr>
			<?php
			}
			?>
		</table>
	</div>
</body>
</html>
