<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title><?= lang('partner') ?></title>
	
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
		<h2><?= lang('partner') ?></h2>
	</div>

	<div id="content" style="text-align:center;">
		<table width="100%" border="1" cellpadding="1" cellspacing="0">
			<tr >
				<th  align="center" width="5%" height="20px">No</th>
				<th  align="center"><?=lang('code')?></th>
				<th  align="center"><?=lang('name')?></th>
				<th  align="center"><?=lang('dipo_name')?></th>
				<th  align="center"><?=lang('address')?></th>
				<th  align="center"><?=lang('phone')?></th>
				<th  align="center"><?=lang('email')?></th>
				<th  align="center"><?=lang('city')?></th>
				<th  align="center"><?=lang('subdistrict')?></th>
				<th  align="center"><?=lang('zona')?></th>
				<th  align="center"><?=lang('latitude')?></th>
				<th  align="center"><?=lang('longitude')?></th>
				<th  align="center"><?=lang('pic')?></th>
				<th  align="center"><?=lang('top')?></th>
				<th  align="center"><?=lang('created_date')?></th>
			</tr>
			<?php 
			$i=0;
			if(count($partners) > 0){
				foreach($partners as $partner){
				$i++;
			?>
							
				<tr style="font-size:9px">
					<td align="center"><?= $i ?></td>
					<td><?= $partner->code ?></td>
					<td><?= $partner->name ?></td>
					<td><?= $partner->dipo_name ?></td>
					<td><?= $partner->address ?></td>
					<td><?= $quote.$partner->phone ?></td>
					<td><?= $partner->email ?></td>
					<td><?= $partner->city ?></td>
					<td><?= $partner->subdistrict ?></td>
					<td><?= $partner->zona_name ?></td>
					<td><?= $partner->latitude ?></td>
					<td><?= $partner->longitude ?></td>
					<td><?= $partner->pic ?></td>
					<td><?= $partner->top ?></td>
					<td><?= date('d-m-Y',strtotime($partner->date_created)) ?></td>
				</tr>
			<?php 
				}
			}
			else{
			?>
				<tr style="font-size:9px">
					<td align="center" colspan="15"><?= lang('no_data_available') ?></td>
				</tr>
			<?php
			}
			?>
		</table>
	</div>
</body>
</html>
