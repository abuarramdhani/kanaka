<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title><?= lang('pricelist') ?></title>
	
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
		<h2><?= lang('pricelist') ?></h2>
	</div>

	<div id="content" style="text-align:center;">
		<table width="100%" border="1" cellpadding="1" cellspacing="0">
			<tr> 
				<th rowspan="3" align="center" width="5%" height="20px">No</th>
				<th rowspan="3" align="center"><?=lang('product_code')?></th>
				<th colspan="2" align="center"><?=lang('barcode')?></th>
				<th rowspan="3" align="center"><?=lang('product_name')?></th>
				<th rowspan="3" align="center"><?=lang('packing_size')?></th>
				<th rowspan="3" align="center"><?=lang('qty_per_ctn')?></th>
				<th colspan="4" align="center"><?=lang('carton_dimension')?></th>
				<th rowspan="3" align="center"><?=lang('weight')?></th>
				<th rowspan="3" align="center"><?=lang('normal_price')?></th>
				<th colspan="5" align="center"><?=lang('kanaka')?></th>
				<th colspan="5" align="center">DIST-POINT (DIPO)<span class="discount-value"> <?=$discount->dipo_discount?>%</span></th>
				<th colspan="5" align="center"><?=lang('mitra')?> <?=$discount->mitra_discount?>%</span></th>
				<th colspan="7" align="center"><?=lang('customer')?> <?=$discount->customer_discount?>%</span></th>
				<th rowspan="3" align="center"><?=lang('created_date')?></th>
			</tr>
			<tr>
				<th rowspan="2"><?=lang('product')?></th>
				<th rowspan="2"><?=lang('carton')?></th> 
				<th rowspan="2">L</th> 
				<th rowspan="2">W</th> 
				<th rowspan="2">H</th> 
				<th rowspan="2">Vol (m<sup>3</sup>)</th> 
				<th colspan="2"><?=lang('before_tax')?></th> 
				<th colspan="2"><?=lang('after_tax')?></th> 
				<th rowspan="2" class="text-center"><?=lang('stock_availibility')?></th>
				<th colspan="2"><?=lang('before_tax')?></th> 
				<th colspan="3"><?=lang('after_tax')?></th>
				<th colspan="2"><?=lang('before_tax')?></th> 
				<th colspan="3"><?=lang('after_tax')?></th>
				<th colspan="2"><?=lang('before_tax')?></th> 
				<th colspan="3"><?=lang('after_tax')?></th>
				<th colspan="2"><?=lang('het')?></th>
			</tr>
			<tr>
				<th><?=lang('in_pcs')?></th> 
				<th><?=lang('in_ctn')?></th> 
				<th><?=lang('in_pcs')?></th> 
				<th><?=lang('in_ctn')?></th> 
				<th><?=lang('in_pcs')?></th> 
				<th><?=lang('in_ctn')?></th> 
				<th><?=lang('in_pcs')?></th> 
				<th><?=lang('in_ctn')?></th> 
				<th><?=lang('round_up_in_ctn')?></th> 
				<th><?=lang('in_pcs')?></th> 
				<th><?=lang('in_ctn')?></th> 
				<th><?=lang('in_pcs')?></th> 
				<th><?=lang('in_ctn')?></th> 
				<th><?=lang('round_up_in_ctn')?></th> 
				<th><?=lang('in_pcs')?></th> 
				<th><?=lang('in_ctn')?></th> 
				<th><?=lang('in_pcs')?></th> 
				<th><?=lang('in_ctn')?></th> 
				<th><?=lang('round_up_in_ctn')?></th> 
				<th><?=lang('round_up_in_pcs')?></th> 
				<th><?=lang('round_up_in_ctn')?></th> 
			</tr>
			<?php 
			$i=0;
			if(count($pricelists) > 0){
				foreach($pricelists as $pricelist){
				$i++;
			?>
							
				<tr style="font-size:9px">
					<td align="center"><?= $i ?></td>
					<td><?=$pricelist->product_code?></td>
					<td><?=$pricelist->barcode_product?></td>
					<td><?=$pricelist->barcode_carton?></td>
					<td><?=$pricelist->name?></td>
					<td><?=$pricelist->packing_size?></td>
					<td><?=$pricelist->qty_per_ctn?></td>
					<td><?=$pricelist->length?></td>
					<td><?=$pricelist->width?></td>
					<td><?=$pricelist->height?></td>
					<td><?=$pricelist->volume?></td>
					<td><?=$pricelist->weight?></td>
					<td><?=$pricelist->normal_price?></td>
					<td><?=$pricelist->company_before_tax_pcs?></td>
					<td><?=$pricelist->company_before_tax_ctn?></td>
					<td><?=$pricelist->company_after_tax_pcs?></td>
					<td><?=$pricelist->company_after_tax_ctn?></td>
					<td><?=$pricelist->stock_availibility?></td>
					<!-- <td><?=$pricelist->dipo_discount?></td> -->
					<td><?=$pricelist->dipo_before_tax_pcs?></td>
					<td><?=$pricelist->dipo_before_tax_ctn?></td>
					<td><?=$pricelist->dipo_after_tax_pcs?></td>
					<td><?=$pricelist->dipo_after_tax_ctn?></td>
					<td><?=$pricelist->dipo_after_tax_round_up?></td>
					<!-- <td><?=$pricelist->mitra_discount?></td> -->
					<td><?=$pricelist->mitra_before_tax_pcs?></td>
					<td><?=$pricelist->mitra_before_tax_ctn?></td>
					<td><?=$pricelist->mitra_after_tax_pcs?></td>
					<td><?=$pricelist->mitra_after_tax_ctn?></td>
					<td><?=$pricelist->mitra_after_tax_round_up?></td>
					<!-- <td><?=$pricelist->customer_discount?></td> -->
					<td><?=$pricelist->customer_before_tax_pcs?></td>
					<td><?=$pricelist->customer_before_tax_ctn?></td>
					<td><?=$pricelist->customer_after_tax_pcs?></td>
					<td><?=$pricelist->customer_after_tax_ctn?></td>
					<td><?=$pricelist->customer_after_tax_round_up?></td>
					<td><?=$pricelist->het_round_up_pcs?></td>
					<td><?=$pricelist->het_round_up_ctn?></td>
					<td><?= date('d-m-Y',strtotime($pricelist->date_created)) ?></td>
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
