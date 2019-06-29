<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Untitled Document</title>
	
	<style>
		body,table th,td{
			font-size: 11px;
			font-family: sans-serif;
		}
		
		@page { margin: 10px 10px; }
		#header { left: 0px; top: 0px; right: 0px; text-align: left;  }
		#footer { left: 0px; bottom: 30px; right: 0px; font-size: 11px; font-family: sans-serif; text-align:right; }	
		#content{
			border-bottom:0px solid #000000;
		}
		#footer .page:after { content: counter(page, upper-roman); }
		#content{
		background-color:#FFFFFF;
		} 
	</style>

</head>

<body>
	<div id="header">
		<img src="<?=base_url()?>assets/img/logo.png" alt="Logo Kanaka" width="200" />
		<h2>PT. KANAKA GRAHA PARAMITHA</h2>
		<h3><?php echo strtoupper(lang('profit_loss')); ?></h3>
		<h3><?php echo lang('period_of') . ' ' . $period ?></h3>
	</div>

	<div id="content" style="text-align:center;">
		<table width="100%" border="1" cellpadding="1" cellspacing="0">
			<tr>
				<th>I</th>
				<th align="left">Penjualan</th>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Penjualan</td>
				<td>&nbsp;</td>
				<td class="text-right"><?php echo number_format($penjualan, 0) ?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Retur Penjualan</td>
				<td class="text-right"><?php echo number_format($retur_penjualan, 0) ?></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Penjualan Bersih</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td class="text-right"><?php echo number_format($penjualan_bersih, 0) ?></td>
			</tr>

			<tr>
				<td colspan="5">&nbsp;</td>
			</tr>

			<tr>
				<th>II</th>
				<th align="left">HPP</th>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Persediaan Barang Dagang Awal</td>
				<td>&nbsp;</td>
				<td class="text-right"><?php echo number_format($persediaan_barang_dagang_awal, 0) ?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Pembelian</td>
				<td class="text-right"><?php echo number_format($pembelian, 0) ?></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Beban angkut Pembelian</td>
				<td class="text-right"><?php echo number_format($beban_angkut_pembelian, 0) ?></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Retur Pembelian</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td class="text-right"><?php echo number_format($retur_pembelian, 0) ?></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Pembelian Bersih</td>
				<td>&nbsp;</td>
				<td class="text-right"><?php echo number_format($pembelian_bersih, 0) ?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Barang Siap Jual</td>
				<td>&nbsp;</td>
				<td class="text-right"><?php echo number_format($barang_siap_jual, 0) ?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Persediaan Akhir</td>
				<td>&nbsp;</td>
				<td class="text-right"><?php echo number_format($persediaan_akhir, 0) ?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>HPP</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td class="text-right"><?php echo number_format($hpp, 0) ?></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Laba Kotor</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td class="text-right"><?php echo number_format($laba_kotor, 0) ?></td>
			</tr>

			<tr>
				<td colspan="5">&nbsp;</td>
			</tr>

			<tr>
				<th>III</th>
				<th align="left">Beban Operational</th>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<th>&nbsp;</th>
				<th align="left">Beban Penjualan</th>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Beban Angkut Penjualan</td>
				<td class="text-right"><?php echo number_format($beban_angkut_penjualan, 0) ?></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Beban Iklan</td>
				<td class="text-right"><?php echo number_format($beban_iklan, 0) ?></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Total Beban Penjualan</td>
				<td>&nbsp;</td>
				<td class="text-right"><?php echo number_format($total_beban_penjualan, 0) ?></td>
				<td>&nbsp;</td>
			</tr>

			<tr>
				<td colspan="5">&nbsp;</td>
			</tr>

			<tr>
				<th>&nbsp;</th>
				<th align="left">Beban Penjualan dan Administrasi</th>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Beban Gaji</td>
				<td class="text-right"><?php echo number_format($beban_gaji, 0) ?></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Beban Utilitas</td>
				<td class="text-right"><?php echo number_format($beban_utilitas, 0) ?></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Beban Sewa</td>
				<td class="text-right"><?php echo number_format($beban_sewa, 0) ?></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Total Beban Umum dan Administrasi</td>
				<td>&nbsp;</td>
				<td class="text-right"><?php echo number_format($total_beban_umum_dan_administrasi, 0) ?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Total Beban Operational</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td class="text-right"><?php echo number_format($total_beban_operasional, 0) ?></td>
			</tr>

			<tr>
				<td colspan="5">&nbsp;</td>
			</tr>

			<tr>
				<th>IV</th>
				<th align="left">Pendapatan dan Beban Luar Usaha</th>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Pendapatan Bunga</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td class="text-right"><?php echo number_format($pendapatan_bunga, 0) ?></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Laba Bersih</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td class="text-right"><?php echo number_format($laba_bersih, 0) ?></td>
			</tr>
		</table>
	</div>
</body>
</html>
