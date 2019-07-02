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
			if(count($partners) > 0){
				foreach($partners as $partner){
				$i++;
			?>
							
				<tr style="font-size:9px">
					<td align="center"><?= $i ?></td>
					<td><?= $partner->code ?></td>
					<td><?= $partner->name ?></td>
					<td><?= $partner->phone == "" ? "-" : $quote.$partner->phone ?></td>
					<td><?= $partner->fax == "" ? "-" : $quote.$partner->fax ?></td>
					<td><?= $partner->email == "" ? "-" : $partner->email ?></td>
					<td><?= $partner->address == "" ? "-" : $partner->address ?></td>
					<td><?= $partner->billing_address == "" ? "-" : $partner->billing_address ?></td>
					<td><?= $partner->city == 0 ? "-" : ucwords(strtolower(City::find($partner->city)->name)) ?></td>
					<td><?= $partner->subdistrict == 0 ? "-" : District::find($partner->subdistrict)->name ?></td>
					<td><?= $partner->postal_code == "" ? "-" : $partner->postal_code ?></td>
					<td><?= $partner->latitude == "" ? "-" : $quote.$partner->latitude ?></td>
					<td><?= $partner->longitude == "" ? "-" : $quote.$partner->longitude ?></td>
					<td><?= $partner->purchase_price_type == "" ? "-" : ucwords(str_replace('_', ' ', $partner->purchase_price_type)) ?></td>
					<td><?= $partner->taxable == "0" ? lang('no') : lang('yes') ?></td>
					<td><?= $partner->npwp == "" ? "-" : $quote.$partner->npwp ?></td>
					<td><?= $partner->tax_name == "" ? "-" : $partner->tax_name ?></td>
					<td><?= $partner->tax_invoice_address == "" ? "-" : $partner->tax_invoice_address ?></td>
					<td><?= $partner->tax_payment_method == "" ? "-" : ucwords(str_replace('_', ' ', $partner->tax_payment_method)) ?></td>
					<td><?= strtoupper($partner->top) ?></td>
					<td><?= $partner->tax_credit_ceiling == "" ? "-" : $partner->tax_credit_ceiling ?></td>
					<td><?= $partner->account_number == "" ? "-" : $quote.$partner->account_number ?></td>
					<td><?= $partner->account_name == "" ? "-" : $partner->account_name ?></td>
					<td><?= $partner->bank_name == "" ? "-" : $partner->bank_name ?></td>
					<td><?= $partner->bank_code == "" ? "-" : $partner->bank_code ?></td>
					<td><?= $partner->account_address == "" ? "-" : $partner->account_address ?></td>
					<td><?= $partner->guarantee_form == "" ? "-" : $partner->guarantee_form ?></td>
					<td><?= $partner->guarantee_receipt == "" ? "-" : $partner->guarantee_receipt ?></td>
					<td><?= $partner->safety_box == "" ? "-" : $partner->safety_box ?></td>
					<td><?= $partner->guarantee_photo == "" ? "-" : $partner->guarantee_photo ?></td>
					<td><?= $partner->customer_photo == "" ? "-" : $partner->customer_photo ?></td>
					<td><?= $partner->house_photo == "" ? "-" : $partner->house_photo ?></td>
					<td><?= $partner->warehouse_photo == "" ? "-" : $partner->warehouse_photo ?></td>
					<td><?= date('d-m-Y',strtotime($partner->date_created)) ?></td>
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
