@extends('default.views.layouts.default')

@section('title') {{ lang('dashboard') }} @stop

@section('body')

<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
   
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ base_url() }}">{{ lang('dashboard') }}</a>
            </li>
        </ul>
        
    </div>

    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title">{{ lang('dashboard') }}</h3>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="fa fa-bars font-dark"></i>
                        <span class="caption-subject"></span>
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <!-- TOTAL BOXS -->
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                <div class="visual">
                                    <i class="glyphicon glyphicon-list-alt"></i>
                                </div>
                                <div class="details">
                                    <div class="total">
                                        <span>Rp.<?= $total_saldo ?></span>
                                    </div>
                                    <div class="desc"> Total Saldo </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                                <div class="visual">
                                    <i class="glyphicon glyphicon-list-alt"></i>
                                </div>
                                <div class="details">
                                    <div class="total">
                                        <span>Rp.<?= $total_piutang ?></span>
                                    </div>
                                    <div class="desc"> Total Piutang </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                                <div class="visual">
                                    <i class="glyphicon glyphicon-list-alt"></i>
                                </div>
                                <div class="details">
                                    <div class="total">
                                        <span>Rp.<?= $total_hutang ?></span>
                                    </div>
                                    <div class="desc"> Total Hutang </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="row dashboard-row-2">
                        <div class="col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Neraca Saldo
                                </div>
                                <div class="panel-body">
                                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%">
                                        <tr >
                                            <th class="text-center" width="5%" height="20px">No</th>
                                            <th class="text-center">Akun</th>
                                            <th class="text-center"><?=lang('debet')?></th>
                                            <th class="text-center"><?=lang('kredit')?></th>
                                            <th class="text-center"><?=lang('saldo')?></th>
                                        </tr>
                                        <?php 
                                        $i=0;
                                        $total_debit = 0;
                                        $total_kredit = 0;

                                        if(count($jurnals) > 0){
                                            foreach($jurnals as $row){
                                            $i++;
                                        ?>
                                                        
                                            <tr style="font-size:9px">
                                                <td class="text-center"><?= $i ?></td>
                                                <td><?= $row->coa_name ?></td>
                                                <?php
                                                    if($row->d_k == 'D'){
                                                        $total_debit += $row->total;
                                                        echo "
                                                            <td align='right'>" . number_format($row->total, 0) . "</td>
                                                            <td align='right'>0</td>
                                                        ";
                                                    }elseif($row->d_k == 'K'){
                                                        $total_kredit += $row->total;
                                                        echo "
                                                            <td align='right'>0</td>
                                                            <td align='right'>" . number_format($row->total, 0) . "</td>
                                                        ";
                                                    }
                                                ?>
                                                <td align='right'><?= number_format($row->total, 0) ?></td>
                                            </tr>
                                        <?php 
                                            }
                                        ?>
                                            <tfoot>
                                                <tr>
                                                    <td align="right" colspan="2">Total &nbsp; </td>
                                                    <td align="right"><?= number_format($total_debit, 0) ?></td>
                                                    <td align="right"><?= number_format($total_kredit, 0) ?></td>
                                                    <td align="right"><?= number_format($total_debit-$total_kredit, 0) ?></td>
                                                </tr>
                                            </tfoot>
                                        <?php
                                        }
                                        else{
                                        ?>
                                            <tr style="font-size:9px">
                                                <td align="center" colspan="10"><?= lang('no_data_available') ?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Stok
                                </div>
                                <div class="panel-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab_dipo" data-toggle="tab" aria-expanded="true"> <?= lang('dipo') ?> </a></li>
                                        <li class=""><a href="#tab_mitra" data-toggle="tab" aria-expanded="false"> <?= lang('mitra') ?> </a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_dipo">
                                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                            <table id="table-stock-dipo" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                                                <thead>
                                                    <tr>
                                                        <th class="text-center"><?=lang('dipo')?></th>
                                                        <th class="text-center"><?=lang('code')?></th>
                                                        <!-- <th class="text-center"><?=lang('address')?></th>
                                                        <th class="text-center"><?=lang('phone')?></th> -->
                                                        <th class="text-center"><?=lang('email')?></th>
                                                    </tr>
                                                    <?php 
                                                        foreach($stocks_dipo as $stock_dipo){ 
                                                            $dataDipo = Dipo::where('id', $stock_dipo['customer_id'])->where('deleted', '0')->get();
                                                            foreach($dataDipo as $dipo){
                                                    ?> 
                                                            <tr>
                                                                <td class="btn-collapse"><a data-toggle="collapse" data-parent="#table-stock-dipo" aria-expanded="true" style="cursor:pointer" data-toggle="collapse" data-target="#accordion_<?= $stock_dipo['customer_id'] ?>" class="clickable collapsed"><?= $dipo->name ?></a></td>
                                                                <td><?= $dipo->code ?></td>
                                                                <!-- <td><?= $dipo->address ?></td>
                                                                <td><?= $dipo->phone ?></td> -->
                                                                <td><?= $dipo->email ?></td>
                                                            </tr>
                                                            <tr id="accordion_<?= $stock_dipo['customer_id'] ?>" class="collapse panel-collapse">
                                                                <td colspan="5">
                                                                    <div>
                                                                        <h5 class="text-center"><b><?=lang('stock')?> <?= $dipo->name ?></b></h5>
                                                                        <table id="detail-stock" class="table table-striped table-bordered table-hover dt-responsive" width="100%">
                                                                            <tr>
                                                                                <th class="text-center"><?=lang('product_name')?></th>
                                                                                <th class="text-center"><?=lang('pack')?></th>
                                                                                <th class="text-center"><?=lang('nominal')?></th>
                                                                            </tr>
                                                                            <?php foreach($stock_dipo['data_product'] as $d){ ?>
                                                                            <tr>
                                                                                <td><?= $d['product_name'] ?></td>
                                                                                <td class="text-center"><?= $d['pax'] ?></td>
                                                                                <td class="text-center"><?= number_format($d['nominal']) ?></td>
                                                                            </tr>
                                                                            <?php } ?>
                                                                        </table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </thead>
                                            </table>
                                            <!-- END EXAMPLE TABLES PORTLET-->
                                        </div>

                                        <div class="tab-pane" id="tab_mitra">
                                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                            <table id="table-stock-mitra" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                                                <thead>
                                                    <tr>
                                                        <th class="text-center"><?=lang('mitra')?></th>
                                                        <th class="text-center"><?=lang('code')?></th>
                                                        <th class="text-center"><?=lang('address')?></th>
                                                        <th class="text-center"><?=lang('phone')?></th>
                                                        <th class="text-center"><?=lang('email')?></th>
                                                    </tr>
                                                    <?php 
                                                        foreach($stocks_mitra as $stock_mitra){ 
                                                            $dataMitra = Dipo::where('id', $stock_mitra['customer_id'])->where('deleted', '0')->get();
                                                            foreach($dataMitra as $mitra){
                                                    ?> 
                                                            <tr>
                                                                <td class="btn-collapse"><a data-toggle="collapse" data-parent="#table-stock-mitra" aria-expanded="true" style="cursor:pointer" data-toggle="collapse" data-target="#accordion_<?= $stock_mitra['customer_id'] ?>" class="clickable collapsed"><?= $mitra->name ?></a></td>
                                                                <td><?= $mitra->code ?></td>
                                                                <td><?= $mitra->address ?></td>
                                                                <td><?= $mitra->phone ?></td>
                                                                <td><?= $mitra->email ?></td>
                                                            </tr>
                                                            <tr id="accordion_<?= $stock_mitra['customer_id'] ?>" class="collapse panel-collapse">
                                                                <td colspan="5">
                                                                    <div>
                                                                        <h5 class="text-center"><b><?=lang('stock')?> <?= $mitra->name ?></b></h5>
                                                                        <table id="detail-stock" class="table table-striped table-bordered table-hover dt-responsive" width="100%">
                                                                            <tr>
                                                                                <th class="text-center"><?=lang('product_name')?></th>
                                                                                <th class="text-center"><?=lang('pack')?></th>
                                                                                <th class="text-center"><?=lang('nominal')?></th>
                                                                            </tr>
                                                                            <?php foreach($stock_mitra['data_product'] as $m){ ?>
                                                                            <tr>
                                                                                <td><?= $m['product_name'] ?></td>
                                                                                <td class="text-center"><?= $m['pax'] ?></td>
                                                                                <td class="text-center"><?= number_format($m['nominal']) ?></td>
                                                                            </tr>
                                                                            <?php } ?>
                                                                        </table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </thead>
                                            </table>
                                            <!-- END EXAMPLE TABLES PORTLET-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row dashboard-row-2">
                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Grafik Pembelian
                                </div>
                                <div class="panel-body">
                                    <?php
                                        $receive_date = array();
                                        $total = array();
                                        /* Mengambil query report*/
                                        if(!empty($report_si))
                                        {
                                            foreach($report_si as $si){
                                                $receive_date[] = $si->receive_date;
                                                $total[] = (float) $si->total;
                                            }
                                        }
                                        /* end mengambil query*/
                                        
                                    ?>
                                    <div id="report_si"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row dashboard-row-2">
                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Grafik Penjualan
                                </div>
                                <div class="panel-body">
                                    <?php
                                        $receive_date_so = array();
                                        $total_so = array();
                                        /* Mengambil query report*/
                                        if(!empty($report_so))
                                        {
                                            foreach($report_so as $so){
                                                $receive_date_so[] = $so->receive_date;
                                                $total_so[] = (float) $so->total;
                                            }
                                        }
                                        /* end mengambil query*/
                                        
                                    ?>
                                    <div id="report_so"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
</div>

@stop

@section('scripts')
<script type="text/javascript">
    $(function () {
        $('#report_si').highcharts({
            chart: {
                type: 'line',
            },
            title: {
                text: 'Grafik Pembelian',
                style: {
                        fontSize: '18px',
                        fontFamily: 'Verdana, sans-serif'
                }
            },
            plotOptions: {
                column: {
                    depth: 25
                }
            },
            credits: {
                enabled: false
            },
            xAxis: {
                categories:  <?php echo json_encode($receive_date);?>
            },
            exporting: { 
                enabled: false 
            },
            yAxis: {
                title: {
                    text: 'Jumlah'
                },
            },
            series: [{// First series
                name: 'Pembelian',
                data: <?php echo json_encode($total);?>,
                shadow : true,
                dataLabels: {
                    enabled: true,
                    color: '#045396',
                    align: 'center',
                    formatter: function() {
                        return Highcharts.numberFormat(this.y, 0);
                    }, // one decimal
                    y: 0, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }],
        });

        $('#report_so').highcharts({
            chart: {
                type: 'line',
            },
            title: {
                text: 'Grafik Penjualan',
                style: {
                        fontSize: '18px',
                        fontFamily: 'Verdana, sans-serif'
                }
            },
            plotOptions: {
                column: {
                    depth: 25
                }
            },
            credits: {
                enabled: false
            },
            xAxis: {
                categories:  <?php echo json_encode($receive_date_so);?>
            },
            exporting: { 
                enabled: false 
            },
            yAxis: {
                title: {
                    text: 'Jumlah'
                },
            },
            series: [{// First series
                name: 'Penjualan',
                data: <?php echo json_encode($total_so);?>,
                shadow : true,
                dataLabels: {
                    enabled: true,
                    color: '#045396',
                    align: 'center',
                    formatter: function() {
                        return Highcharts.numberFormat(this.y, 0);
                    }, // one decimal
                    y: 0, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }],
        });
        
    });
</script>
@stop