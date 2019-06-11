
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
		<h2 style="text-align:center;"><?= lang('surat_jalan') ?></h2>
	</div>

	<div id="content" style="text-align:center;">

		<table width="50%" cellpadding="1" cellspacing="0">
			<tr style="font-size:12px">
				<th align="left"><?=lang('account')?></th>
				<th align="left" style="border-bottom: 1px solid black"><?= $row->dipo_code ?></th>
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
				<th align="left"><?=lang('pic')?></th>
				<th align="left" style="border-bottom: 1px solid black"><?= $row->dipo_pic ?></th>
			</tr>
			<tr style="font-size:12px">
				<th align="left"><?=lang('phone')?></th>
				<th align="left" style="border-bottom: 1px solid black"><?= $row->dipo_phone ?></th>
			</tr>
			<tr style="font-size:12px">
				<th align="left">Tanggal</th>
				<th align="left" style="border-bottom: 1px solid black"><?=date('d/m/Y',strtotime($row->sp_date))?></th>
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
				<th align="center"><?= lang('volume_m3') ?></th>
				<th align="center"><?= lang('weight_kg') ?></th>
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
					<td align="center"><?= number_format($rowdetail->order_volume,2) ?></td>
					<td align="center"><?= number_format($rowdetail->order_weight,2) ?></td>
				</tr>
			<?php 
				}
			?>
				<tr style="font-size:11px">
					<th colspan="3">Total</th>
					<th><?= $row->total_order_amount_in_ctn ?></th>
					<th><?= number_format($row->total_order_volume,2) ?></th>
					<th><?= number_format($row->total_order_weight,2) ?></th>
				</tr>
			<?php
			}
			else{
			?>
				<tr style="font-size:9px">
					<td align="center" colspan="6"><?= lang('no_data_available') ?></td>
				</tr>
			<?php
			}
			?>
		</table>

		<br/>

		<table width="100%" cellpadding="1" cellspacing="0">
			<tr style="font-size:12px">
				<th align="left" width="25%">Tanggal permintaan pengiriman barang :</th>
				<th align="left"><?= date('d/m/Y',strtotime($row->sp_date)) ?></th>
			</tr>
			<tr style="font-size:12px">
				<th align="left" width="25%">Tanggal penerimaan barang :</th>
				<th align="left"><?= date('d/m/Y',strtotime($row->sp_date)) ?></th>
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
