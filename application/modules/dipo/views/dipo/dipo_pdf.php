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
				<th  align="center"><?=lang('phone')?></th>
				<th  align="center"><?=lang('fax')?></th>
				<th  align="center"><?=lang('email')?></th>
				<th  align="center"><?=lang('shipping_address')?></th>
				<th  align="center"><?=lang('billing_address')?></th>
				<th  align="center"><?=lang('city')?></th>
				<th  align="center"><?=lang('subdistrict')?></th>
				<th  align="center"><?=lang('postal_code')?></th>
				<th  align="center"><?=lang('latitude')?></th>
				<th  align="center"><?=lang('longitude')?></th>
				<th  align="center"><?=lang('purchase_price_type')?></th>
				<th  align="center"><?=lang('taxable')?></th>
				<th  align="center"><?=lang('npwp')?></th>
				<th  align="center"><?=lang('name')?></th>
				<th  align="center"><?=lang('tax_invoice_address')?></th>
				<th  align="center"><?=lang('payment_method')?></th>
				<th  align="center"><?=lang('payment_time')?></th>
				<th  align="center"><?=lang('credit_ceiling')?></th>
				<th  align="center"><?=lang('account_number')?></th>
				<th  align="center"><?=lang('account_name')?></th>
				<th  align="center"><?=lang('bank_name')?></th>
				<th  align="center"><?=lang('bank_code')?></th>
				<th  align="center"><?=lang('account_address')?></th>
				<th  align="center"><?=lang('guarantee_form')?></th>
				<th  align="center"><?=lang('guarantee_receipt')?></th>
				<th  align="center"><?=lang('safety_box')?></th>
				<th  align="center"><?=lang('guarantee_photo')?></th>
				<th  align="center"><?=lang('customer_photo')?></th>
				<th  align="center"><?=lang('house_photo')?></th>
				<th  align="center"><?=lang('guarantee_photo')?></th>
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
					<td><?= $dipo->phone == "" ? "-" : $quote.$dipo->phone ?></td>
					<td><?= $dipo->fax == "" ? "-" : $quote.$dipo->fax ?></td>
					<td><?= $dipo->email == "" ? "-" : $dipo->email ?></td>
					<td><?= $dipo->address == "" ? "-" : $dipo->address ?></td>
					<td><?= $dipo->billing_address == "" ? "-" : $dipo->billing_address ?></td>
					<td><?= $dipo->city == 0 ? "-" : ucwords(strtolower(City::find($dipo->city)->name)) ?></td>
					<td><?= $dipo->subdistrict == 0 ? "-" : District::find($dipo->subdistrict)->name ?></td>
					<td><?= $dipo->postal_code == "" ? "-" : $dipo->postal_code ?></td>
					<td><?= $dipo->latitude == "" ? "-" : $quote.$dipo->latitude ?></td>
					<td><?= $dipo->longitude == "" ? "-" : $quote.$dipo->longitude ?></td>
					<td><?= $dipo->purchase_price_type == "" ? "-" : ucwords(str_replace('_', ' ', $dipo->purchase_price_type)) ?></td>
					<td><?= $dipo->taxable == "0" ? lang('no') : lang('yes') ?></td>
					<td><?= $dipo->npwp == "" ? "-" : $quote.$dipo->npwp ?></td>
					<td><?= $dipo->tax_name == "" ? "-" : $dipo->tax_name ?></td>
					<td><?= $dipo->tax_invoice_address == "" ? "-" : $dipo->tax_invoice_address ?></td>
					<td><?= $dipo->tax_payment_method == "" ? "-" : ucwords(str_replace('_', ' ', $dipo->tax_payment_method)) ?></td>
					<td><?= strtoupper($dipo->top) ?></td>
					<td><?= $dipo->tax_credit_ceiling == "" ? "-" : $dipo->tax_credit_ceiling ?></td>
					<td><?= $dipo->account_number == "" ? "-" : $quote.$dipo->account_number ?></td>
					<td><?= $dipo->account_name == "" ? "-" : $dipo->account_name ?></td>
					<td><?= $dipo->bank_name == "" ? "-" : $dipo->bank_name ?></td>
					<td><?= $dipo->bank_code == "" ? "-" : $quote.$dipo->bank_code ?></td>
					<td><?= $dipo->account_address == "" ? "-" : $dipo->account_address ?></td>
					<td><?= $dipo->guarantee_form == "" ? "-" : $dipo->guarantee_form ?></td>
					<td><?= $dipo->guarantee_receipt == "" ? "-" : $dipo->guarantee_receipt ?></td>
					<td><?= $dipo->safety_box == "" ? "-" : $dipo->safety_box ?></td>
					<td><?= $dipo->guarantee_photo == "" ? "-" : $dipo->guarantee_photo ?></td>
					<td><?= $dipo->customer_photo == "" ? "-" : $dipo->customer_photo ?></td>
					<td><?= $dipo->house_photo == "" ? "-" : $dipo->house_photo ?></td>
					<td><?= $dipo->warehouse_photo == "" ? "-" : $dipo->warehouse_photo ?></td>
					<td><?= date('d-m-Y',strtotime($dipo->date_created)) ?></td>
				</tr>
			<?php 
				}
			}
			else{
			?>
				<tr style="font-size:9px">
					<td align="center" colspan="34"><?= lang('no_data_available') ?></td>
				</tr>
			<?php
			}
			?>
		</table>
	</div>
</body>
</html>
