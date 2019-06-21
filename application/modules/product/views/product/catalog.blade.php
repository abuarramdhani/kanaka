@extends('default.views.layouts.default')

@section('title') {{lang('catalog_product')}} @stop

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
                <span>{{lang('catalog_product')}}</span>
            </li>
        </ul>
        
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title"> {{lang('catalog_product')}} </h3>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADERs-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="table-wrapper" class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-grid font-dark"></i>
                        <span class="caption-subject">{{lang('catalog_product')}}</span>
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
                    <?php if (!empty($catalogs)) { ?>
                        <ol class="product-items">
                            <?php foreach ($catalogs as $c) { ?>
                                <div class="catalog-item">
                                    <li class="product-item">
                                        <div class="product-item-info">
                                            <div class="product-image">
                                                <?php 
                                                    $productImage = ProductImage::where('product_id', $c->product_id)->where('deleted', '0')->limit(1)->get();

                                                    if(count($productImage) > 0){
                                                        foreach($productImage as $p){
                                                ?>
                                                        <img width="230" style="padding: 10px;" src="{{ base_url() }}uploads/images/products/<?= $p->image ?>">
                                                <?php 
                                                        } 
                                                    }else{
                                                ?>
                                                        <img width="230" style="padding: 10px;" src="{{ base_url() }}uploads/images/products/default.png">
                                                <?php
                                                    } 
                                                ?>
                                            </div>
                                            <div class="product-desc">
                                                <table class="table-desc">
                                                    <tr>
                                                        <td valign="top"><b>Brand/Merek &nbsp;</b></td>
                                                        <td valign="top"><b>:&nbsp;</b></td>
                                                        <td valign="top"><b><?= $c->name ?></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">Tipe Kemasan &nbsp;</td>
                                                        <td valign="top">:&nbsp;</td>
                                                        <td valign="top"></td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">Isi Per &nbsp;</td>
                                                        <td valign="top">:&nbsp;</td>
                                                        <td valign="top"><?= $c->packing_size ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">Isi Per Karton &nbsp;</td>
                                                        <td valign="top">:&nbsp;</td>
                                                        <td valign="top"><?= $c->qty ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">CPB/ &nbsp;</td>
                                                        <td valign="top">:&nbsp;</td>
                                                        <td valign="top"><?= $c->customer_after_tax_pcs ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">CPB/Karton &nbsp;</td>
                                                        <td valign="top">:&nbsp;</td>
                                                        <td valign="top"><?= $c->customer_after_tax_ctn ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">Harga Per ML &nbsp;</td>
                                                        <td valign="top">:&nbsp;</td>
                                                        <td valign="top"></td>
                                                    </tr>
                                                </table>

                                                <div class="action-button-catalog">
                                                    <a href="{{ base_url() }}catalogproduct/salestalk/?id=<?= $c->product_id ?>" class="btn btn-sm btn-primary">Sales Talk</a>
                                                    <a href="{{ base_url() }}catalogproduct/price/?id=<?= $c->product_id ?>" class="btn btn-sm btn-primary">Price</a>
                                                    <a href="{{ base_url() }}catalogproduct/comparison/?id=<?= $c->product_id ?>" class="btn btn-sm btn-primary">Comparison</a>
                                                    <a href="{{ base_url() }}catalogproduct/buildingblock/?id=<?= $c->product_id ?>" class="btn btn-sm btn-primary">Building Block</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </div>
                            <?php } ?>
                        </ol>
                    <?php } ?>
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