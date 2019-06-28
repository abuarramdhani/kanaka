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
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
</div>

@stop

@section('scripts')
<script type="text/javascript">

</script>
@stop