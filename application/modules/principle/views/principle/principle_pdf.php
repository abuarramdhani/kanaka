<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title><?= lang('principle') ?></title>
	
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
		<h2><?= lang('principle') ?></h2>
	</div>

	<div id="content" style="text-align:center;">
		<table width="100%" border="1" cellpadding="1" cellspacing="0">
			<tr>
				<th align="center" rowspan="2" width="5%" height="20px">No</th>
				<th align="center" rowspan="2"><?=lang('code')?></th>
				<th align="center" rowspan="2"><?=lang('name')?></th>
				<th align="center" rowspan="2"><?=lang('address')?></th>
				<!-- <th align="center" rowspan="2"><?=lang('product')?></th> -->
				<!-- <th align="center" rowspan="2"><?=lang('brand')?></th> -->
				<th align="center" rowspan="2"><?=lang('top')?></th>
				<th align="center" rowspan="2"><?=lang('pic')?></th>
				<th align="center" colspan="3"><?=lang('phone')?></th>
				<th align="center" rowspan="2"><?=lang('email')?></th>
				<!-- <th align="center" rowspan="2"><?=lang('web')?></th> -->
				<!-- <th align="center" colspan="4"><?=lang('discount')?></th> -->
				<th align="center" rowspan="2"><?=lang('created_date')?></th>
			</tr>
			<tr>
				<th align="center"><?=lang('office')?></th>
				<th align="center"><?=lang('personal')?></th> 
				<th align="center"><?=lang('fax')?></th> 
				<!-- <th align="center"><?=lang('office')?></th> -->
				<!-- <th align="center"><?=lang('personal')?></th>  -->
				<!-- <th align="center">Reg Disc</th> -->
				<!-- <th align="center">Add Disc 1</th>  -->
				<!-- <th align="center">Add Disc 2</th>  -->
				<!-- <th align="center">BTW Disc</th>  -->
			</tr>
			<?php 
			$i=0;
			if(count($principles) > 0){
				foreach($principles as $principle){
				$i++;
			?>
							
				<tr style="font-size:9px">
					<td align="center"><?= $i ?></td>
					<td><?= $principle->code ?></td>
					<td><?= $principle->name ?></td>
					<td><?= $principle->address ?></td>
					<!-- <td><?= $principle->product ?></td> -->
					<!-- <td><?= $principle->brand ?></td> -->
					<td><?= $principle->top ?></td>
					<td><?= $principle->pic ?></td>
					<td><?= $principle->phone_office == "" ? "-" : $quote.$principle->phone_office ?></td>
					<td><?= $principle->phone_personal == "" ? "-" : $quote.$principle->phone_personal?></td>
					<td><?= $principle->fax == "" ? "-" : $quote.$principle->fax ?></td>
					<td><?= $principle->email_office ?></td>
					<!-- <td><?= $principle->email_personal?></td> -->
					<!-- <td><?= $principle->web?></td> -->
					<!-- <td><?= $principle->reg_disc?></td> -->
					<!-- <td><?= $principle->add_disc_1?></td> -->
					<!-- <td><?= $principle->add_disc_2?></td> -->
					<!-- <td><?= $principle->btw_disc?></td> -->
					<td><?= date('d-m-Y',strtotime($principle->date_created)) ?></td>
				</tr>
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
