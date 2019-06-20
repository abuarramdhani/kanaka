@extends('default.views.layouts.default')

@section('title') {{lang('product')}} @stop

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
                <span>{{lang('sales_talk')}}</span>
            </li>
        </ul>
        
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title"> {{lang('sales_talk')}} </h3>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADERs-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="table-wrapper" class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-grid font-dark"></i>
                        <span class="caption-subject">{{lang('sales_talk')}}</span>
                    </div>
                    <div class="tools">
                        @if($print_limited_access == 1 || $print_unlimited_access == 1)
                            <!-- <button onClick="return window.open('{{base_url()}}master/product/pdf')" class="btn btn-danger btn-sm">
                                <i class="fa fa-file-pdf-o"></i> {{ lang('print_pdf') }}
                            </button>
                            <button onClick="return window.open('{{base_url()}}master/product/excel')" class="btn btn-success btn-sm">
                                <i class="fa fa-file-excel-o"></i> {{ lang('print_excel') }}
                            </button> -->
                        @endif
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="sales-talk-product">
                        <?php 
                        if (!empty($product)) {
                            foreach($product as $c){
                        ?>
                            <div class="product-name">
                                <h3><?= $c->name ?></h3>
                            </div>
                            <div class="sales-talk-detail">
                                <div class="product-image">
                                    <?php 
                                        $productImage = ProductImage::where('product_id', $c->id)->where('deleted', '0')->limit(1)->get();

                                        if(count($productImage) > 0){
                                            foreach($productImage as $p){
                                    ?>
                                            <img height="350" class="img-sales-talk" style="padding: 10px;" src="{{ base_url() }}uploads/images/products/<?= $p->image ?>">
                                    <?php 
                                            } 
                                        }else{
                                    ?>
                                            <img height="350" class="img-sales-talk" style="padding: 10px;" src="{{ base_url() }}uploads/images/products/default.png">
                                    <?php
                                        } 
                                    ?>
                                </div>
                                <div class="sales-talk-product-detail">
                                    <div class="sales-talk-desc">
                                        <?= $c->description ?>
                                    </div>
                                    <div class="sales-talk-feature">
                                        <?= $c->feature ?>
                                    </div>
                                </div>
                            </div>
                            <div class="logo-kanaka">
                                <img width="320" src="{{ base_url() }}assets/img/logo.png" alt="">
                            </div>
                        <?php 
                            } 
                        } 
                        ?>
                    </div>
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