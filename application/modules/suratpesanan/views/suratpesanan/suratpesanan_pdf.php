
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
		<h2 style="text-align:center;">Surat Pesanan</h2>
	</div>

	<div id="content" style="text-align:center;">

		<table width="50%" cellpadding="1" cellspacing="0">
			<?php 
			if(count($suratpesanans) > 0){
				foreach($suratpesanans as $suratpesanan){
			?>
			<tr style="font-size:12px">
				<th align="left" rowspan="3" valign="top">Kepada</th>
				<th align="left" colspan="2" style="border-bottom: 1px solid black"><?= $suratpesanan->principle_code ?></th>
			</tr>
			<tr style="font-size:12px">
				<th colspan="2" align="left" style="border-bottom: 1px solid black"><?= $suratpesanan->principle_name ?></th>
			</tr>
			<tr style="font-size:12px">
				<th colspan="2" align="left" style="border-bottom: 1px solid black"><?= $suratpesanan->principle_pic ?></th>
			</tr>
			<tr style="font-size:12px">
				<th align="left">No SP</th>
				<th colspan="2" align="left" style="border-bottom: 1px solid black"><?= $suratpesanan->sp_no ?></th>
			</tr>
			<tr style="font-size:12px">
				<th align="left">Ship To</th>
				<th align="left" style="border-bottom: 1px solid black"><?= $suratpesanan->dipo_name ?></th>
				<th align="center" style="border-bottom: 1px solid black; border-left: 1px solid black"><?= $suratpesanan->dipo_code ?></th>
			</tr>
			<tr style="font-size:12px">
				<th align="left">Alamat</th>
				<th colspan="2" align="left" style="border-bottom: 1px solid black"><?= $suratpesanan->dipo_address ?></th>
			</tr>
			<tr style="font-size:12px">
				<th align="left">Tanggal</th>
				<th colspan="2" align="left" style="border-bottom: 1px solid black"><?=date('d/m/Y',strtotime($suratpesanan->sp_date))?></th>
			</tr>
			<tr style="font-size:12px">
				<th align="left">Metode Pembayaran</th>
				<th colspan="2" align="left" style="border-bottom: 1px solid black">-</th>
			</tr>
			<tr>
				<th colspan="3">&nbsp;</th>
			</tr>
			<?php
				}
			}
			?>
		</table>
		
		<table width="100%" border="1" cellpadding="1" cellspacing="0">
			<tr style="font-size:12px">
				<th align="center">No</th>
				<th align="center">Kode Produk</th>
				<th align="center">Nama Produk</th>
				<th align="center">Jumlah Pesanan (Per Karton)</th>
				<th align="center">Harga Pesanan (Per Karton) Before Tax</th>
				<th align="center">Harga Pesanan (Per Karton) After Tax</th>
				<th align="center">Jumlah Pesanan After Tax</th>
			</tr>
			<?php 
			$i = 0;
			if(count($detailpesanans) > 0){
				foreach($detailpesanans as $detailpesanan){
				$i++;
			?>
							
				<tr style="font-size:11px">
					<td align="center"><?php echo $i;?></td>
					<td align="center"><?= $detailpesanan->product_code ?></td>
					<td><?= $detailpesanan->product_name ?></td>
					<td align="center"><?= $detailpesanan->order_amount_in_ctn ?></td>
					<td align="center"><?= $detailpesanan->order_price_before_tax ?></td>
					<td align="center"><?= $detailpesanan->order_price_after_tax ?></td>
					<td align="center"><?= $detailpesanan->order_amount_after_tax ?></td>
				</tr>
			<?php 
				}
				if(count($suratpesanans) > 0){
					foreach($suratpesanans as $total){
			?>
					<tr style="font-size:11px">
						<th colspan="3">Total</th>
						<th><?= $total->total_order_amount_in_ctn ?></th>
						<th><?= $total->total_order_price_before_tax ?></th>
						<th><?= $total->total_order_price_after_tax ?></th>
						<th><?= $total->total_order_amount_after_tax ?></th>
					</tr>
			<?php
					}
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

		<table width="100%" cellpadding="1" cellspacing="0">
			<?php 
			if(count($suratpesanans) > 0){
				foreach($suratpesanans as $pesanan){
			?>
			<tr>
				<th colspan="7">&nbsp;</th>
			</tr>
			<tr style="font-size:12px">
				<th colspan="2" align="left" width="25%">Tanggal permintaan pengiriman barang :</th>
				<th align="left"><?= date('d/m/Y',strtotime($suratpesanan->sp_date)) ?></th>
				<th>&nbsp;</th>
				<th align="left" colspan="2" width="20%" style="border-top:1px solid black">Total Value</th>
				<th style="border-top:1px solid black"><?= $suratpesanan->total_order_amount_after_tax ?></th>
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
				<th style="border-top:1px solid black"><?= $suratpesanan->total_niv ?></th>
			</tr>
			<?php 
				}
			} 
			?>
		</table>

		<table width="30%" cellpadding="1" cellspacing="0" style="margin-top:20px;">
			<tr align="left" style="font-size:12px">
				<th>Dibuat oleh,</th>
			</tr>
			<tr>
				<th>
					<img src="<?=base_url()?>assets/img/ttd.png" alt="" width=150></img>
					<img style="margin-left:-60px; margin-top:20px;" src="<?=base_url()?>assets/img/logo-pdf.png" alt="" width=150></img>
				</th>
			</tr>
			<tr align="left" style="font-size:12px; text-decoration: underline;">
				<th>Imam Fakhruddin</th>
			</tr>
		</table>
	</div>
