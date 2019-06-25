@extends('default.views.layouts.default')

@section('title') {{lang('price')}} @stop

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
                <a href="{{ base_url() }}catalogproduct">{{ lang('catalog_product') }}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>{{lang('price')}}</span>
            </li>
        </ul>
        
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title"> {{lang('price')}} </h3>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADERs-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="table-wrapper" class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-grid font-dark"></i>
                        <span class="caption-subject">{{lang('price')}}</span>
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-pricelist">
                                <div class="row pricelist-title">
                                    <div class="col-md-8">
                                        <h3><?=lang('pricelist')?> </h3>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="logo-kanaka">
                                            <img width="200" src="{{ base_url() }}assets/img/logo.png" alt="">
                                        </div>
                                    </div>
                                </div>
                                <?php if (!empty($product)) {?>
                                    <?php foreach ($product as $prod) { ?>
                                        <div class="pricelist-item">
                                            <div class="pricelist-item-info">
                                                <div class="table-product-pricelist">
                                                    <p><?=lang('price')?> Jabodetabek</p>
                                                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%">
                                                        <tr>
                                                            <th><?=lang('product')?></th>
                                                            <th><?=lang('description')?></th>
                                                            <th>Kanaka</th>
                                                            <th><?=lang('dipo')?></th>
                                                            <th><?=lang('mitra')?></th>
                                                            <th><?=lang('customer')?></th>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                            <?php 
                                                                $productImage = ProductImage::where('product_id', $prod->product_id)->where('deleted', '0')->limit(1)->get();

                                                                    if(count($productImage) > 0){
                                                                        foreach($productImage as $prodImg){
                                                                    ?>
                                                                        <img width="180" height="180" style="padding: 10px;" src="{{ base_url() }}uploads/images/products/<?= $prodImg->image ?>">
                                                                    <?php 
                                                                        } 
                                                                    }else{
                                                                    ?>
                                                                        <img width="180" height="180" style="padding: 10px;" src="{{ base_url() }}uploads/images/products/default.png">
                                                                    <?php
                                                                    } 
                                                                    ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
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