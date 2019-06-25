@extends('default.views.layouts.default')

@section('title') {{lang('profit_loss')}} @stop

@section('body')
<style type="text/css">
    .form-group span.error {
        margin-left: 33.3% !important;
    }
</style>
<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
   
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ base_url() }}">{{ lang('dashboard') }}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{ base_url() }}reports/profitloss">{{lang('profit_loss') }}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>{{ lang('report') }}</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title"> {{lang('profit_loss')}} </h3>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADERs-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="table-wrapper" class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-grid font-dark"></i>
                        <span class="caption-subject">{{lang('profit_loss')}}</span>
                    </div>
                    <div class="tools">
                        <a href="{{ base_url() }}reports/profitloss">{{lang('back') }}</a>
                    </div>
                </div>
                <div class="portlet-body">
                    {{ lang('period') }} : 
                    <h4>{{ $start_date }} {{ strtolower(lang('to')) }} {{ $end_date }}</h4>

                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%">
                        <tr>
                            <th class="text-center">I</th>
                            <th>Penjualan</th>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Penjualan</td>
                            <td>&nbsp;</td>
                            <td class="text-right">{{ number_format($penjualan, 0) }}</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Retur Penjualan</td>
                            <td class="text-right">{{ number_format($retur_penjualan, 0) }}</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Penjualan Bersih</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td class="text-right">{{ number_format($penjualan_bersih, 0) }}</td>
                        </tr>

                        <tr>
                            <td colspan="5">&nbsp;</td>
                        </tr>

                        <tr>
                            <th class="text-center">II</th>
                            <th>HPP</th>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Persediaan Barang Dagang Awal</td>
                            <td>&nbsp;</td>
                            <td class="text-right">{{ number_format($persediaan_barang_dagang_awal, 0) }}</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Pembelian</td>
                            <td class="text-right">{{ number_format($pembelian, 0) }}</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Beban angkut Pembelian</td>
                            <td class="text-right">{{ number_format($beban_angkut_pembelian, 0) }}</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Potongan Pembelian</td>
                            <td class="text-right">{{ number_format($potongan_pembelian, 0) }}</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Retur Pembelian</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td class="text-right">{{ number_format($retur_pembelian, 0) }}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Pembelian Bersih</td>
                            <td>&nbsp;</td>
                            <td class="text-right">{{ number_format($pembelian_bersih, 0) }}</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Barang Siap Jual</td>
                            <td>&nbsp;</td>
                            <td class="text-right">{{ number_format($barang_siap_jual, 0) }}</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Persediaan Akhir</td>
                            <td>&nbsp;</td>
                            <td class="text-right">{{ number_format($persediaan_akhir, 0) }}</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>HPP</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td class="text-right">{{ number_format($hpp, 0) }}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Laba Kotor</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td class="text-right">{{ number_format($laba_kotor, 0) }}</td>
                        </tr>

                        <tr>
                            <td colspan="5">&nbsp;</td>
                        </tr>

                        <tr>
                            <th class="text-center">III</th>
                            <th>Beban Operational</th>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Beban Penjualan</th>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Beban Angkut Penjualan</td>
                            <td class="text-right">{{ number_format($beban_angkut_penjualan, 0) }}</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Beban Asuransi Toko</td>
                            <td class="text-right">{{ number_format($beban_asuransi_toko, 0) }}</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Beban Iklan</td>
                            <td class="text-right">{{ number_format($beban_iklan, 0) }}</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Baban Perlengkapan Toko</td>
                            <td class="text-right">{{ number_format($beban_perlengkapan_toko, 0) }}</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Total Beban Penjualan</td>
                            <td>&nbsp;</td>
                            <td class="text-right">{{ number_format($total_beban_penjualan, 0) }}</td>
                            <td>&nbsp;</td>
                        </tr>

                        <tr>
                            <td colspan="5">&nbsp;</td>
                        </tr>

                        <tr>
                            <th>&nbsp;</th>
                            <th>Beban Penjualan dan Administrasi</th>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Beban Gaji</td>
                            <td class="text-right">{{ number_format($beban_gaji, 0) }}</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Beban Utilitas</td>
                            <td class="text-right">{{ number_format($beban_utilitas, 0) }}</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Beban Perlengkapan Kantor</td>
                            <td class="text-right">{{ number_format($beban_perlengkapan_kantor, 0) }}</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Beban Sewa</td>
                            <td class="text-right">{{ number_format($beban_sewa, 0) }}</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Beban Penyusutan</td>
                            <td class="text-right">{{ number_format($beban_penyusutan, 0) }}</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Total Beban Umum dan Administrasi</td>
                            <td>&nbsp;</td>
                            <td class="text-right">{{ number_format($total_beban_umum_dan_administrasi, 0) }}</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Total Beban Operational</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td class="text-right">{{ number_format($total_beban_operasional, 0) }}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Rugi Operational</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td class="text-right">{{ number_format($rugi_operasional, 0) }}</td>
                        </tr>

                        <tr>
                            <td colspan="5">&nbsp;</td>
                        </tr>

                        <tr>
                            <th class="text-center">IV</th>
                            <th>Pendapatan dan Beban Luar Usaha</th>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Pendapatan Bunga</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td class="text-right">{{ number_format($pendapatan_bunga, 0) }}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Laba Bersih</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td class="text-right">{{ number_format($laba_bersih, 0) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLES PORTLET-->
        </div>
    </div>
</div>

@stop

@section('scripts')
<script type="text/javascript">

</script>
@stop