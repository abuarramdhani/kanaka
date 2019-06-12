
	<div id="kepala-surat">
		<table width="100%" cellpadding="1" cellspacing="0" style="border-bottom:1px solid black;">
			<tr style="font-size:14px" align="left">
				<th align="left" colspan="6">PT. KANAKA GRAHA PARAMITHA</th>
				<th align="right"><img src="<?=base_url()?>assets/img/logo.png" alt="" width=200></img></th>
			</tr>
			<tr style="font-size:12px">
				<th align="left" colspan="7">Nucira Buliding 1st Floor - West Wing</th>
			</tr>
			<tr style="font-size:12px">
				<th align="left" colspan="7">Jl. MT Haryono Kav. 27, Jakarta Selatan, DKI Jakarta 12820 - Indonesia</th>
			</tr>
			<tr style="font-size:12px">
				<th align="left" colspan="7">Phone : +62 87870305900</th>
			</tr>
		</table>
	</div>

	<div id="header">
		<h2 style="text-align:center;"><?= lang('invoice') ?></h2>
	</div>

	<div id="content" style="text-align:center;">

		<table width="50%" cellpadding="1" cellspacing="0">
			<tr style="font-size:12px">
				<th align="left"><?=lang('to')?></th>
				<th align="left" style="border-bottom: 1px solid black">
					<?= $row->dipo_code ?><br/>
					<?= $row->dipo_name ?><br/>
					<?= $row->dipo_pic ?>
				</th>
			</tr>
			<tr style="font-size:12px">
				<th align="left"><?=lang('invoice_no')?></th>
				<th align="left" style="border-bottom: 1px solid black"><?= $row->invoice_no ?></th>
			</tr>
			<tr style="font-size:12px">
				<th align="left"><?=lang('sj_no')?></th>
				<th align="left" style="border-bottom: 1px solid black"><?= $row->sj_no ?></th>
			</tr>
			<tr style="font-size:12px">
				<th align="left"><?=lang('sp_no')?></th>
				<th align="left" style="border-bottom: 1px solid black"><?= $row->sp_no ?></th>
			</tr>
			<tr style="font-size:12px">
				<th align="left"><?=lang('customer_name')?></th>
				<th align="left"  style="border-bottom: 1px solid black"><?= $row->dipo_name ?></th>
			</tr>
			<tr style="font-size:12px">
				<th align="left"><?=lang('delivery_to')?></th>
				<th align="left" style="border-bottom: 1px solid black"><?= $row->dipo_address ?></th>
			</tr>
			<tr style="font-size:12px">
				<th align="left"><?=lang('date_issued')?></th>
				<th align="left" style="border-bottom: 1px solid black"><?= date('d/m/Y',strtotime($row->sp_date)) ?></th>
			</tr>
			<tr style="font-size:12px">
				<th align="left"><?=lang('receive_date')?></th>
				<th align="left" style="border-bottom: 1px solid black"><?=date('d/m/Y',strtotime($row->sp_date))?></th>
			</tr>
			<tr style="font-size:12px">
				<th align="left"><?=lang('payment_method')?></th>
				<th align="left" style="border-bottom: 1px solid black"><?= $row->dipo_top ?></th>
			</tr>
			<tr style="font-size:12px">
				<th align="left"><?=lang('due_date_invoice')?></th>
				<th align="left" style="border-bottom: 1px solid black"><?= $row->due_date ?></th>
			</tr>
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
		</table>
		
		<table width="100%" border="1" cellpadding="1" cellspacing="0">
			<tr style="font-size:12px">
				<th align="center"><?= lang('no') ?></th>
				<th align="center"><?= lang('product_code') ?></th>
				<th align="center"><?= lang('product_name') ?></th>
				<th align="center"><?= lang('total_order_in_ctn') ?></th>
				<th align="center"><?= lang('price_of_orders_per_ctn_before_tax') ?></th>
				<th align="center"><?= lang('price_of_orders_per_ctn_after_tax') ?></th>
				<th align="center"><?= lang('order_amount_after_tax') ?></th>
			</tr>
			<?php 
			$i = 0;
			if(count($datadetails) > 0){
				foreach($datadetails as $rowdetail){
				$i++;
			?>
							
				<tr style="font-size:11px">
					<td align="center"><?php echo $i;?></td>
					<td align="center"><?= $rowdetail->product_code ?></td>
					<td><?= $rowdetail->product_name ?></td>
					<td align="center"><?= $rowdetail->order_amount_in_ctn ?></td>
					<td align="center"><?= number_format($rowdetail->order_price_dipo_before_tax,0) ?></td>
					<td align="center"><?= number_format($rowdetail->order_price_dipo_after_tax,0) ?></td>
					<td align="center"><?= number_format($rowdetail->order_amount_dipo_after_tax,0) ?></td>
				</tr>
			<?php 
				}
			?>
				<tr style="font-size:11px">
					<th colspan="3">Total</th>
					<th><?= number_format($row->total_order_amount_in_ctn,0) ?></th>
					<th><?= number_format($row->total_order_price_before_tax,0) ?></th>
					<th><?= number_format($row->total_order_price_after_tax,0) ?></th>
					<th><?= number_format($row->total_order_amount_after_tax,0) ?></th>
				</tr>
			<?php
			}
			else{
			?>
				<tr style="font-size:9px">
					<td align="center" colspan="7"><?= lang('no_data_available') ?></td>
				</tr>
			<?php
			}
			?>
		</table>

		<br/>

		<table width="100%" cellpadding="1" cellspacing="0">
			<tr>
				<th colspan="7">&nbsp;</th>
			</tr>
			<tr style="font-size:12px">
				<th colspan="2" align="left" width="25%"><?= lang('note') ?> :</th>
				<th align="left">&nbsp;</th>
				<th>&nbsp;</th>
				<th align="left" colspan="2" width="20%" style="border-top:1px solid black">Total Value</th>
				<th style="border-top:1px solid black"><?= number_format($row->total_order_amount_after_tax,0) ?></th>
			</tr>
			<tr style="font-size:12px">
				<th colspan="2" rowspan="5">&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th align="left" style="border-top:1px solid black">Reg Disc</th>
				<th style="border-top:1px solid black">0%</th>
				<th style="border-top:1px solid black">0</th>
			</tr>
			<tr style="font-size:12px">
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th align="left">Add Disc 1</th>
				<th>0%</th>
				<th>0</th>
			</tr>
			<tr style="font-size:12px">
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th align="left">Add Disc 2</th>
				<th>0%</th>
				<th>0</th>
			</tr>
			<tr style="font-size:12px">
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th align="left">BTW Disc</th>
				<th>0%</th>
				<th>0</th>
			</tr>
			<tr style="font-size:12px">
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th align="left" colspan="2" style="border-top:1px solid black">Total NIV</th>
				<th style="border-top:1px solid black"><?= number_format($row->total_order_amount_after_tax,0) ?></th>
			</tr>
		</table>

		<table width="100%" cellpadding="1" cellspacing="0">
			<tr>
				<td width="50%">
					<table width="100%" cellpadding="1" cellspacing="0" style="margin-top:20px;">
						<tr align="left" style="font-size:12px">
							<th>Dibuat oleh,</th>
						</tr>
						<tr align="left">
							<th>
								<img style="margin-left:20px;" src="<?=base_url()?>assets/img/ttd.png" alt="" width=150></img>
								<img style="margin-left:-50px; margin-top:20px;" src="<?=base_url()?>assets/img/logo-pdf.png" alt="" width=150></img>
							</th>
						</tr>
						<tr align="left" style="font-size:12px; text-decoration: underline;">
							<th>Imam Fakhruddin</th>
						</tr>
					</table>
				</td>
				<td width="50%">
					<table width="100%" cellpadding="1" cellspacing="0" style="margin-top:20px;">
						<tr align="left" style="font-size:12px">
							<th>Diterima oleh,</th>
						</tr>
						<tr align="left">
							<th>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
							</th>
						</tr>
						<tr align="left" style="font-size:12px; text-decoration: underline;">
							<th>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</th>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
