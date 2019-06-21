@extends('default.views.layouts.default')

@section('title') {{lang('product_comparison')}} @stop

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
                <span>{{lang('product_comparison')}}</span>
            </li>
        </ul>
        
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title"> {{lang('product_comparison')}} </h3>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADERs-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="table-wrapper" class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-grid font-dark"></i>
                        <span class="caption-subject">{{lang('product_comparison')}}</span>
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
                    <div class="product-comparison">
                        <div class="comparison-title">
                            <div class="logo-kanaka">
                                <img width="320" src="{{ base_url() }}assets/img/logo.png" alt="">
                            </div>
                            <h3>Product Comparison</h3>
                        </div>
                        <?php if (!empty($product)) { ?>
                            <ol class="product-items">
                                <?php foreach ($product as $prod) { ?>
                                    <div class="catalog-item">
                                        <li class="product-item">
                                            <div class="product-item-info">
                                                <div class="product-image">
                                                    <?php 
                                                        $productImage = ProductImage::where('product_id', $prod->id)->where('deleted', '0')->limit(1)->get();

                                                        if(count($productImage) > 0){
                                                            foreach($productImage as $prodImg){
                                                    ?>
                                                            <img width="230" style="padding: 10px;" src="{{ base_url() }}uploads/images/products/<?= $prodImg->image ?>">
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
                                                            <td valign="top"><b><?= $prod->name ?></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top">Tipe Kemasan &nbsp;</td>
                                                            <td valign="top">:&nbsp;</td>
                                                            <td valign="top"><?= $prod->tipe_kemasan ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top">Isi Per &nbsp;</td>
                                                            <td valign="top">:&nbsp;</td>
                                                            <td valign="top"><?= $prod->packing_size ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top">Isi Per Karton &nbsp;</td>
                                                            <td valign="top">:&nbsp;</td>
                                                            <td valign="top"><?= $prod->qty ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top">CBP/<?= $prod->tipe_kemasan ?> &nbsp;</td>
                                                            <td valign="top">:&nbsp;</td>
                                                            <td valign="top"><?= $prod->cbp_per_kemasan ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top">CBP/Karton &nbsp;</td>
                                                            <td valign="top">:&nbsp;</td>
                                                            <td valign="top"><?= $prod->cbp_per_karton ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top">Harga Per ML &nbsp;</td>
                                                            <td valign="top">:&nbsp;</td>
                                                            <td valign="top"><?= $prod->harga ?></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </li>
                                    </div>
                                <?php } ?>
                                <?php if (!empty($comparisons)) { ?>
                                    <?php foreach ($comparisons as $comp) { ?>
                                        <div class="catalog-item comparison">
                                            <li class="product-item">
                                                <div class="product-item-info">
                                                    <div class="product-image">
                                                        <?php 
                                                            $productImageComp = ProductImage::where('product_id', $comp->product_id)->where('deleted', '0')->limit(1)->get();

                                                            if(count($productImageComp) > 0){
                                                                foreach($productImageComp as $imgComp){
                                                        ?>
                                                                <img width="230" style="padding: 10px;" src="{{ base_url() }}uploads/images/products/<?= $imgComp->image ?>">
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
                                                                <td valign="top"><b><?= $comp->brand ?></b></td>
                                                            </tr>
                                                            <tr class="comparison-detail">
                                                                <td colspan="3" valign="top"><?= $comp->description ?></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </li>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </ol>
                        <?php } ?>
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