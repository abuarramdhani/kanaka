<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title><?= lang('dipo') ?></title>
	
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
		<h2><?= lang('dipo') ?></h2>
	</div>

	<div id="content" style="text-align:center;">
		<table width="100%" border="1" cellpadding="1" cellspacing="0">
			<tr >
				<th  align="center" width="5%" height="20px">No</th>
				<th  align="center"><?=lang('code')?></th>
				<th  align="center"><?=lang('name')?></th>
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
			if(count($dipos) > 0){
				foreach($dipos as $dipo){
				$i++;
			?>
							
				<tr style="font-size:9px">
					<td align="center"><?= $i ?></td>
					<td><?= $dipo->code ?></td>
					<td><?= $dipo->name ?></td>
					<td><?= $dipo->address ?></td>
					<td><?= $quote.$dipo->phone ?></td>
					<td><?= $dipo->email ?></td>
					<td><?= $dipo->city == "" ? "-" : ucwords(strtolower(City::find($dipo->city)->name)) ?></td>
					<td><?= $dipo->subdistrict ?></td>
					<td><?= $dipo->zona_id == "" ? "-" : Zona::find($dipo->zona_id)->name ?></td>
					<td><?= $dipo->latitude ?></td>
					<td><?= $dipo->longitude ?></td>
					<td><?= $dipo->pic ?></td>
					<td><?= strtoupper($dipo->top) ?></td>
					<td><?= date('d-m-Y',strtotime($dipo->date_created)) ?></td>
				</tr>
			<?php 
				}
			}
			else{
			?>
				<tr style="font-size:9px">
					<td align="center" colspan="14"><?= lang('no_data_available') ?></td>
				</tr>
			<?php
			}
			?>
		</table>
	</div>
</body>
</html>
