@extends('default.views.layouts.default')

@section('title') {{lang('pricelist')}} @stop

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
                <span>{{lang('pricelist')}}</span>
            </li>
        </ul>
        
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title"> {{lang('pricelist')}} </h3>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADERs-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="table-wrapper" class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-grid font-dark"></i>
                        <span class="caption-subject">{{lang('pricelist')}}</span>
                    </div>
                    <div class="tools">
                        @if($add_access == 1)
                            <button onclick="add_pricelist()" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>{{lang('new_pricelist')}}</button>
                        @endif

                        @if($print_limited_access == 1 || $print_unlimited_access == 1)
                            <!-- <button onClick="return window.open('{{base_url()}}reports/pricelist/pdf')" class="btn btn-danger btn-sm">
                                <i class="fa fa-file-pdf-o"></i> {{ lang('print_pdf') }}
                            </button> -->
                            <button onClick="return window.open('{{base_url()}}reports/pricelist/excel')" class="btn btn-success btn-sm">
                                <i class="fa fa-file-excel-o"></i> {{ lang('print_excel') }}
                            </button>
                        @endif
                    </div>
                </div>
                <div class="portlet-body">
                    <table id="table-pricelist" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                        <thead>
                            <tr>
                                <th rowspan="3" class="text-center"><?=lang('product_code')?></th>
                                <th colspan="2" class="text-center"><?=lang('barcode')?></th>
                                <th rowspan="3" class="text-center"><?=lang('product_name')?></th>
                                <th rowspan="3" class="text-center"><?=lang('packing_size')?></th>
                                <th rowspan="3" class="text-center"><?=lang('qty_per_ctn')?></th>
                                <th colspan="4" class="text-center"><?=lang('carton_dimension')?></th>
                                <th rowspan="3" class="text-center"><?=lang('weight')?></th>
                                <th rowspan="3" class="text-center"><?=lang('normal_price')?></th>
                                <th colspan="5" class="text-center"><?=lang('kanaka')?></th>
                                <th colspan="5" class="text-center">DIST-POINT (DIPO)<span class="discount-value"><?=$discount->dipo_discount?>%</span></th>
                                <th colspan="5" class="text-center"><?=lang('mitra')?><span class="discount-value"><?=$discount->mitra_discount?>%</span></th>
                                <th colspan="7" class="text-center"><?=lang('customer')?><span class="discount-value"><?=$discount->customer_discount?>%</span></th>
                                <th rowspan="3" class="text-center"><?=lang('created_date')?></th>
                                <th rowspan="3" width="13%"><?=lang('options')?></th>
                            </tr>
                            <tr>
                                <th rowspan="2"><?=lang('product')?></th>
                                <th rowspan="2"><?=lang('carton')?></th> 
                                <th rowspan="2">L</th> 
                                <th rowspan="2">W</th> 
                                <th rowspan="2">H</th> 
                                <th rowspan="2">Vol (m<sup>3</sup>)</th> 
                                <th colspan="2"><?=lang('before_tax')?></th> 
                                <th colspan="2"><?=lang('after_tax')?></th> 
                                <th rowspan="2" class="text-center"><?=lang('stock_availibility')?></th>
                                <th colspan="2"><?=lang('before_tax')?></th> 
                                <th colspan="3"><?=lang('after_tax')?></th>
                                <th colspan="2"><?=lang('before_tax')?></th> 
                                <th colspan="3"><?=lang('after_tax')?></th>
                                <th colspan="2"><?=lang('before_tax')?></th> 
                                <th colspan="3"><?=lang('after_tax')?></th>
                                <th colspan="2"><?=lang('het')?></th>
                            </tr>
                            <tr>
                                <th><?=lang('in_pcs')?></th> 
                                <th><?=lang('in_ctn')?></th> 
                                <th><?=lang('in_pcs')?></th> 
                                <th><?=lang('in_ctn')?></th> 
                                <th><?=lang('in_pcs')?></th> 
                                <th><?=lang('in_ctn')?></th> 
                                <th><?=lang('in_pcs')?></th> 
                                <th><?=lang('in_ctn')?></th> 
                                <th><?=lang('round_up_in_ctn')?></th> 
                                <th><?=lang('in_pcs')?></th> 
                                <th><?=lang('in_ctn')?></th> 
                                <th><?=lang('in_pcs')?></th> 
                                <th><?=lang('in_ctn')?></th> 
                                <th><?=lang('round_up_in_ctn')?></th> 
                                <th><?=lang('in_pcs')?></th> 
                                <th><?=lang('in_ctn')?></th> 
                                <th><?=lang('in_pcs')?></th> 
                                <th><?=lang('in_ctn')?></th> 
                                <th><?=lang('round_up_in_ctn')?></th> 
                                <th><?=lang('round_up_in_pcs')?></th> 
                                <th><?=lang('round_up_in_ctn')?></th> 
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLES PORTLET-->
        </div>
    </div>
</div>
 <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog" style="width:50%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?=lang('new_pricelist')?></h3>
      </div>
      {{ form_open(null,array('id' => 'form-pricelist', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
      <div class="modal-body">
        <input type="hidden" name="id" value="">

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('product_code')?><span class="text-danger">*</span></label>
            <div class="col-md-7">
                <select id="product_code" name="product_id" class="form-control">
                    <option selected disabled value=""><?=lang('select')?> <?=lang('product_code')?></option>
                <?php
                    if (!empty($products)) {
                        foreach ($products as $c) { ?>
                        <option value="<?=$c->id?>"><?=ucfirst($c->product_code)?></option>
                <?php } } ?>
                </select>  
            </div>  
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('barcode')?></label>
            <div class="col-lg-7">
                <input disabled="disabled" type="text" class="form-control input-sm" name="barcode_product" id="barcode_product" placeholder="<?=lang('product')?>" maxlength="50" />
                <input disabled="disabled" type="text" class="form-control input-sm" name="barcode_carton" id="barcode_carton" placeholder="<?=lang('carton')?>" maxlength="50" />
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('product_name')?></label>
            <div class="col-lg-7">
                <input disabled="disabled" type="text" class="form-control input-sm" name="name" id="name" placeholder="<?=lang('name')?>" maxlength="50" />
                <div class="form-control-focus"> </div>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('packing_size')?></label>
            <div class="col-lg-7">
                <input disabled="disabled" type="text" class="form-control input-sm" name="packing_size" id="packing_size" placeholder="<?=lang('packing_size')?>" maxlength="50" />
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('qty_per_ctn')?></label>
            <div class="col-lg-7">
                <input disabled="disabled" type="number" class="form-control input-sm" name="qty" id="qty" placeholder="<?=lang('qty_per_ctn')?>" maxlength="50" />
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('carton_dimension')?></label>
            <div class="col-lg-7 form-inline">
                <input disabled="disabled" type="number" class="form-control input-sm" name="length" id="length" placeholder="Length" maxlength="20" />
                <input disabled="disabled" type="number" class="form-control input-sm" name="width" id="width" placeholder="Width" maxlength="20" />
                <input disabled="disabled" type="number" class="form-control input-sm" name="height" id="height" placeholder="Height" maxlength="20" />
                <input disabled="disabled" type="number" class="form-control input-sm" name="volume" id="volume" placeholder="Volume" maxlength="20" />
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('weight')?></label>
            <div class="col-lg-7">
                <input disabled="disabled" type="number" class="form-control input-sm" name="weight" id="weight" placeholder="<?=lang('weight')?>" maxlength="50" />
                <div class="form-control-focus"> </div>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('normal_price')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="normal_price" id="normal_price" placeholder="<?=lang('normal_price')?>" maxlength="50" />
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <fieldset id="fieldset-kanaka">
                <legend class="text-center">Kanaka</legend>
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('after_tax')?> <?=lang('in_ctn')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input oninput="get_kanaka_pricelist()" type="text" class="form-control input-sm" name="company_after_tax_ctn" id="company_after_tax_ctn" placeholder="<?=lang('after_tax')?> <?=lang('in_ctn')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('before_tax')?> <?=lang('in_pcs')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="company_before_tax_pcs" id="company_before_tax_pcs" placeholder="<?=lang('before_tax')?> <?=lang('in_pcs')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('before_tax')?> <?=lang('in_ctn')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="company_before_tax_ctn" id="company_before_tax_ctn" placeholder="<?=lang('before_tax')?> <?=lang('in_ctn')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('after_tax')?> <?=lang('in_pcs')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="company_after_tax_pcs" id="company_after_tax_pcs" placeholder="<?=lang('after_tax')?> <?=lang('in_pcs')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('stock_availibility')?><span class="text-danger">*</span></label>
                    <div class="col-md-7">
                        <select id="stock_availibility" name="stock_availibility" class="form-control">
                            <option value="0"><?=lang('out_of_stock')?></option>
                            <option value="1"><?=lang('available')?></option>
                        </select>  
                    </div>  
                </div>
            </fieldset>
        </div>

        <div class="form-group form-md-line-input">
            <fieldset id="fieldset-dipo">
                <legend class="text-center"><?=lang('dipo')?></legend>
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('discount')?><span class="text-danger">*</span></label>
                    <div class="col-lg-2">
                        <input oninput="get_kanaka_pricelist()"  type="text" class="form-control input-sm" name="dipo_discount" id="dipo_discount" placeholder="<?=lang('discount')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                    <label class="col-lg-6">%</label>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('before_tax')?> <?=lang('in_pcs')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="dipo_before_tax_pcs" id="dipo_before_tax_pcs" placeholder="<?=lang('before_tax')?> <?=lang('in_pcs')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('before_tax')?> <?=lang('in_ctn')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="dipo_before_tax_ctn" id="dipo_before_tax_ctn" placeholder="<?=lang('before_tax')?> <?=lang('in_ctn')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('after_tax')?> <?=lang('in_pcs')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="dipo_after_tax_pcs" id="dipo_after_tax_pcs" placeholder="<?=lang('after_tax')?> <?=lang('in_pcs')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('after_tax')?> <?=lang('in_ctn')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="dipo_after_tax_ctn" id="dipo_after_tax_ctn" placeholder="<?=lang('after_tax')?> <?=lang('in_ctn')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('after_tax')?> <?=lang('round_up_in_ctn')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="dipo_after_tax_round_up" id="dipo_after_tax_round_up" placeholder="<?=lang('after_tax')?> <?=lang('in_ctn')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
            </fieldset>
        </div>

        <div class="form-group form-md-line-input">
            <fieldset id="fieldset-mitra">
                <legend class="text-center"><?=lang('mitra')?></legend>
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('discount')?><span class="text-danger">*</span></label>
                    <div class="col-lg-2">
                        <input oninput="get_kanaka_pricelist()"  type="text" class="form-control input-sm" name="mitra_discount" id="mitra_discount" placeholder="<?=lang('discount')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                    <label class="col-lg-6">%</label>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('before_tax')?> <?=lang('in_pcs')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="mitra_before_tax_pcs" id="mitra_before_tax_pcs" placeholder="<?=lang('before_tax')?> <?=lang('in_pcs')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('before_tax')?> <?=lang('in_ctn')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="mitra_before_tax_ctn" id="mitra_before_tax_ctn" placeholder="<?=lang('before_tax')?> <?=lang('in_ctn')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('after_tax')?> <?=lang('in_pcs')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="mitra_after_tax_pcs" id="mitra_after_tax_pcs" placeholder="<?=lang('after_tax')?> <?=lang('in_pcs')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('after_tax')?> <?=lang('in_ctn')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="mitra_after_tax_ctn" id="mitra_after_tax_ctn" placeholder="<?=lang('after_tax')?> <?=lang('in_ctn')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('after_tax')?> <?=lang('round_up_in_ctn')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="mitra_after_tax_round_up" id="mitra_after_tax_round_up" placeholder="<?=lang('after_tax')?> <?=lang('in_ctn')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
            </fieldset>
        </div>

        <div class="form-group form-md-line-input">
            <fieldset id="fieldset-customer">
                <legend class="text-center"><?=lang('customer')?></legend>
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('discount')?><span class="text-danger">*</span></label>
                    <div class="col-lg-2">
                        <input oninput="get_kanaka_pricelist()"  type="text" class="form-control input-sm" name="customer_discount" id="customer_discount" placeholder="<?=lang('discount')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                    <label class="col-lg-6">%</label>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('before_tax')?> <?=lang('in_pcs')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="customer_before_tax_pcs" id="customer_before_tax_pcs" placeholder="<?=lang('before_tax')?> <?=lang('in_pcs')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('before_tax')?> <?=lang('in_ctn')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="customer_before_tax_ctn" id="customer_before_tax_ctn" placeholder="<?=lang('before_tax')?> <?=lang('in_ctn')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('after_tax')?> <?=lang('in_pcs')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="customer_after_tax_pcs" id="customer_after_tax_pcs" placeholder="<?=lang('after_tax')?> <?=lang('in_pcs')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('after_tax')?> <?=lang('in_ctn')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="customer_after_tax_ctn" id="customer_after_tax_ctn" placeholder="<?=lang('after_tax')?> <?=lang('in_ctn')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('after_tax')?> <?=lang('round_up_in_ctn')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="customer_after_tax_round_up" id="customer_after_tax_round_up" placeholder="<?=lang('after_tax')?> <?=lang('in_ctn')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('het')?> <?=lang('round_up_in_pcs')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="het_round_up_pcs" id="het_round_up_pcs" placeholder="<?=lang('het')?> <?=lang('round_up_in_pcs')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('het')?> <?=lang('round_up_in_ctn')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="het_round_up_ctn" id="het_round_up_ctn" placeholder="<?=lang('het')?> <?=lang('round_up_in_ctn')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
            </fieldset>
        </div>

      </div>
      <div class="modal-footer">
        <button type="submit" id="btnSave"  class="btn btn-primary">{{ lang('save') }}</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ lang('close') }}</button>
      </div>
      {{ form_close() }}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop

@section('scripts')
<script type="text/javascript">
    // $(function(){
        
    //     @if($user->group_id == '2')
    //         $('#fieldset-kanaka').hide();
    //         $('#fieldset-mitra').hide();
    //         $('#fieldset-customer').hide();
    //     @endif
        
    // });
    
    $('#product_code').change(function(){
        $.getJSON('{{base_url()}}pricelist/pricelists/getProductData', {id: $('#product_code').val()}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data;
                var i;
                var html = "";

                $('[name="barcode_pricelist"]').val(row.barcode_pricelist);
                $('[name="barcode_carton"]').val(row.barcode_carton);
                $('[name="name"]').val(row.name);
                $('[name="packing_size"]').val(row.packing_size);
                $('[name="qty"]').val(row.qty);
                $('[name="length"]').val(row.length);
                $('[name="width"]').val(row.width);
                $('[name="height"]').val(row.height);
                $('[name="volume"]').val(row.volume);
                $('[name="weight"]').val(row.weight);
                $('[name="normal_price"]').focus();

            }else if(json.status == "error"){
                toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
            }
            App.unblockUI('#form-wrapper');
       });
    });

    function get_kanaka_pricelist(){
        var company_after_tax_ctn   = $('[name="company_after_tax_ctn"]').val();
        var company_before_tax_ctn  = $('[name="company_before_tax_ctn"]').val();
        var qty                     = $('[name="qty"]').val();

        var company_before_tax_ctn  = company_after_tax_ctn/1.1;
        var company_before_tax_pcs  = company_before_tax_ctn/qty;
        var company_after_tax_pcs   = company_after_tax_ctn/qty;

        $('[name="company_before_tax_ctn"]').val(company_before_tax_ctn.toFixed(0));
        $('[name="company_before_tax_pcs"]').val(company_before_tax_pcs.toFixed(0));
        $('[name="company_after_tax_pcs"]').val(company_after_tax_pcs.toFixed(0));

        if($('[name="dipo_discount"]').val() != ''){
            var dipo_discount           = $('[name="dipo_discount"]').val()/100;
            var company_after_tax_ctn   = parseInt($('[name="company_after_tax_ctn"]').val());
            var qty                     = $('[name="qty"]').val();

            var dipo_after_tax_ctn      = company_after_tax_ctn+(company_after_tax_ctn*dipo_discount);
            var dipo_after_tax_pcs      = dipo_after_tax_ctn/qty;
            var dipo_before_tax_ctn     = dipo_after_tax_ctn/1.1;
            var dipo_before_tax_pcs     = dipo_before_tax_ctn/qty;
            var dipo_after_tax_round_up = (~~((dipo_after_tax_ctn + 99) / 100) * 100);

            $('[name="dipo_after_tax_ctn"]').val(dipo_after_tax_ctn.toFixed(0));
            $('[name="dipo_after_tax_pcs"]').val(dipo_after_tax_pcs.toFixed(0));
            $('[name="dipo_before_tax_ctn"]').val(dipo_before_tax_ctn.toFixed(0));
            $('[name="dipo_before_tax_pcs"]').val(dipo_before_tax_pcs.toFixed(0));
            $('[name="dipo_after_tax_round_up"]').val(dipo_after_tax_round_up.toFixed(0));
        }
       
        if($('[name="mitra_discount"]').val() != ''){
            var mitra_discount           = $('[name="mitra_discount"]').val()/100;
            var dipo_after_tax_ctn       = parseInt($('[name="dipo_after_tax_ctn"]').val());
            var qty                      = $('[name="qty"]').val();

            var mitra_after_tax_ctn      = dipo_after_tax_ctn+(dipo_after_tax_ctn*mitra_discount);
            var mitra_after_tax_pcs      = mitra_after_tax_ctn/qty;
            var mitra_before_tax_ctn     = mitra_after_tax_ctn/1.1;
            var mitra_before_tax_pcs     = mitra_before_tax_ctn/qty;
            var mitra_after_tax_round_up = (~~((mitra_after_tax_ctn + 99) / 100) * 100);

            $('[name="mitra_after_tax_ctn"]').val(mitra_after_tax_ctn.toFixed(0));
            $('[name="mitra_after_tax_pcs"]').val(mitra_after_tax_pcs.toFixed(0));
            $('[name="mitra_before_tax_ctn"]').val(mitra_before_tax_ctn.toFixed(0));
            $('[name="mitra_before_tax_pcs"]').val(mitra_before_tax_pcs.toFixed(0));
            $('[name="mitra_after_tax_round_up"]').val(mitra_after_tax_round_up.toFixed(0));
        }
       
        if($('[name="customer_discount"]').val() != ''){
            var customer_discount           = $('[name="customer_discount"]').val()/100;
            var mitra_after_tax_ctn         = parseInt($('[name="mitra_after_tax_ctn"]').val());
            var qty                         = $('[name="qty"]').val();

            var customer_after_tax_ctn      = mitra_after_tax_ctn+(mitra_after_tax_ctn*customer_discount);
            var customer_after_tax_pcs      = customer_after_tax_ctn/qty;
            var customer_before_tax_ctn     = customer_after_tax_ctn/1.1;
            var customer_before_tax_pcs     = customer_before_tax_ctn/qty;
            var customer_after_tax_round_up = (~~((customer_after_tax_ctn + 99) / 100) * 100);
            var het_in_pcs                  = customer_after_tax_round_up/qty;
            var het_round_up_pcs            = (~~((het_in_pcs + 99) / 100) * 100);
            var het_in_ctn                  = het_round_up_pcs*qty;
            var het_round_up_ctn            = (~~((het_in_ctn + 99) / 100) * 100);

            $('[name="customer_after_tax_ctn"]').val(customer_after_tax_ctn.toFixed(0));
            $('[name="customer_after_tax_pcs"]').val(customer_after_tax_pcs.toFixed(0));
            $('[name="customer_before_tax_ctn"]').val(customer_before_tax_ctn.toFixed(0));
            $('[name="customer_before_tax_pcs"]').val(customer_before_tax_pcs.toFixed(0));
            $('[name="customer_after_tax_round_up"]').val(customer_after_tax_round_up.toFixed(0));
            $('[name="het_round_up_pcs"]').val(het_round_up_pcs.toFixed(0));
            $('[name="het_round_up_ctn"]').val(het_round_up_ctn.toFixed(0));
        }
    }

    function add_pricelist(){
        $('#form-pricelist')[0].reset(); 
        $('#modal_form').modal('show'); 
        $('.modal-title').text('<?=lang('new_pricelist')?>'); 

        $('[name="id"]').val('');
    }
    toastr.options = { "positionClass": "toast-top-right", };

    // Pengaturan Datatable 
    var oTable =$('#table-pricelist').dataTable({
        "responsive": false,
        "bProcessing": true,
        "bServerSide": true,
        "bLengthChange": true,
        "sServerMethod": "GET",
        "sAjaxSource": "{{ base_url() }}pricelist/pricelists/fetch_data",
        "columnDefs": [
            {"className": "dt-center", "targets": [35]},
            {"targets": [35], "orderable": false}
        ],
        "order": [0,"asc"],
    }).fnSetFilteringDelay(1000);

    // Pengaturan Form Validation 
    var form_validator = $("#form-pricelist").validate({
        errorPlacement: function(error, element) {
            $(element).parent().closest('.form-group').append(error);
        },
        errorElement: "span",
        rules: {
            product_id: "required",
            normal_price: "required",
            company_after_tax_ctn: "required",
            stock_availibility: "required",
            dipo_discount: "required",
            mitra_discount: "required",
            customer_discount: "required",
        },
        messages: {
            product_id: "{{lang('product_code')}}" + " {{lang('not_empty')}}",
            normal_price: "{{lang('normal_price')}}" + " {{lang('not_empty')}}",
            company_after_tax_ctn: "{{lang('company_after_tax_ctn')}}" + " {{lang('not_empty')}}",
            stock_availibility: "{{lang('stock_availibility_per_ctn')}}" + " {{lang('not_empty')}}",
            dipo_discount: "{{lang('dipo_discount')}}" + " {{lang('not_empty')}}",
            mitra_discount: "{{lang('mitra_discount')}}" + " {{lang('not_empty')}}",
            customer_discount: "{{lang('customer_discount')}}" + " {{lang('not_empty')}}",
        },
        submitHandler : function(form){
            App.blockUI({
                target: '#form-wrapper'
            });
            $(form).ajaxSubmit({  
                beforeSubmit:  showRequest,  
                success:       showResponse,
                url:       '{{base_url()}}pricelist/pricelists/save',      
                type:      'POST',       
                clearForm: true ,       
                resetForm: true ,  
            }); 
            function showRequest(formData, jqForm, options) { 
                var queryString = $.param(formData); 
                return true; 
            } 
            function showResponse(responseText, statusText, xhr, $form)  { 
                if(responseText.status == "success"){
                    toastr.success(responseText.message,'{{ lang("notification") }}');
                }else if(responseText.status == "error"){
                    toastr.error(responseText.message,'{{ lang("notification") }}');
                }else if(responseText.status == "unique"){
                    toastr.error(responseText.message,'{{ lang("notification") }}');
                }

                App.unblockUI('#form-wrapper');
                setTimeout(function(){
                    window.location.reload()
                },1000);
            } 
            return false;
        }
    });
   
    // Menampilkan data pada form
    function viewData(pricelistId, productId){   
        form_validator.resetForm();
        $("html, body").animate({
            scrollTop: 0
        }, 500);
        App.blockUI({
            target: '#form-wrapper'
        });
        $.getJSON('{{base_url()}}pricelist/pricelists/view', {pricelistId: pricelistId, productId: productId}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data;
                var rowProduct = json.dataProduct;
                var i;
                var html = "";

                $('[name="id"]').val(row.id);
                $('#product_code').val(rowProduct.id);
                $('[name="barcode_product"]').val(rowProduct.barcode_product);
                $('[name="barcode_carton"]').val(rowProduct.barcode_carton);
                $('[name="name"]').val(rowProduct.name);
                $('[name="packing_size"]').val(rowProduct.packing_size);
                $('[name="qty"]').val(rowProduct.qty);
                $('[name="length"]').val(rowProduct.length);
                $('[name="width"]').val(rowProduct.width);
                $('[name="height"]').val(rowProduct.height);
                $('[name="volume"]').val(rowProduct.volume);
                $('[name="weight"]').val(rowProduct.weight);
                $('[name="normal_price"]').val(row.normal_price);
                $('[name="company_before_tax_pcs"]').val(row.company_before_tax_pcs);
                $('[name="company_before_tax_ctn"]').val(row.company_before_tax_ctn);
                $('[name="company_after_tax_pcs"]').val(row.company_after_tax_pcs);
                $('[name="company_after_tax_ctn"]').val(row.company_after_tax_ctn);
                $('#stock_availibility').val(row.stock_availibility);
                $('[name="dipo_discount"]').val(row.dipo_discount);
                $('[name="dipo_before_tax_pcs"]').val(row.dipo_before_tax_pcs);
                $('[name="dipo_before_tax_ctn"]').val(row.dipo_before_tax_ctn);
                $('[name="dipo_after_tax_pcs"]').val(row.dipo_after_tax_pcs);
                $('[name="dipo_after_tax_ctn"]').val(row.dipo_after_tax_ctn);
                $('[name="dipo_after_tax_round_up"]').val(row.dipo_after_tax_round_up);
                $('[name="mitra_discount"]').val(row.mitra_discount);
                $('[name="mitra_before_tax_pcs"]').val(row.mitra_before_tax_pcs);
                $('[name="mitra_before_tax_ctn"]').val(row.mitra_before_tax_ctn);
                $('[name="mitra_after_tax_pcs"]').val(row.mitra_after_tax_pcs);
                $('[name="mitra_after_tax_ctn"]').val(row.mitra_after_tax_ctn);
                $('[name="mitra_after_tax_round_up"]').val(row.mitra_after_tax_round_up);
                $('[name="customer_discount"]').val(row.customer_discount);
                $('[name="customer_before_tax_pcs"]').val(row.customer_before_tax_pcs);
                $('[name="customer_before_tax_ctn"]').val(row.customer_before_tax_ctn);
                $('[name="customer_after_tax_pcs"]').val(row.customer_after_tax_pcs);
                $('[name="customer_after_tax_ctn"]').val(row.customer_after_tax_ctn);
                $('[name="customer_after_tax_round_up"]').val(row.customer_after_tax_round_up);
                $('[name="het_round_up_pcs"]').val(row.het_round_up_pcs);
                $('[name="het_round_up_ctn"]').val(row.het_round_up_ctn);

                $('#modal_form').modal('show');
                $('.modal-title').text('<?=lang('edit_pricelist')?>'); 
            }else if(json.status == "error"){
                toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
            }
            App.unblockUI('#form-wrapper');
       });
    }

    // Proses hapus data
    function deleteData(value){
        form_validator.resetForm();
        $("html, body").animate({
            scrollTop: 0
        }, 500);
        $.confirm({
            content : "{{ lang('delete_this_data') }}",
            title : "{{ lang('are_you_sure') }}",
            confirm: function() {

                App.blockUI({
                    target: '#table-wrapper'
                });
                $.getJSON('{{base_url()}}pricelist/pricelists/delete', {id: value}, function(json, textStatus) {
                    if(json.status == "success"){
                        toastr.success('{{lang("deleted_succesfully")}}','{{ lang("notification") }}');
                    }else if(json.status == "error"){
                        toastr.error('{{lang("deleted_unsuccesfully")}}','{{ lang("notification") }}');
                    }
                    setTimeout(function(){
                        window.location.reload()
                    },1000);
               });
            },
            cancel: function(button) {
                // nothing to do
            },
            confirmButton: "Yes",
            cancelButton: "No",
            confirmButtonClass: "btn-danger",
            cancelButtonClass: "btn-success",
            dialogClass: "modal-dialog modal-lg" // Bootstrap classes for large modal
        });
    }

    function viewDiscount(){   
        $.getJSON('{{base_url()}}pricelist/pricelists/viewDiscount', function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data;
                console.log(row);
                var rowProduct = json.dataProduct;
                var i;
                var html = "";

                $('[name="id"]').val(row.id);
                $('#product_code').val(rowProduct.id);
                $('[name="barcode_product"]').val(rowProduct.barcode_product);
                $('[name="barcode_carton"]').val(rowProduct.barcode_carton);
                $('[name="name"]').val(rowProduct.name);
                $('[name="packing_size"]').val(rowProduct.packing_size);
                $('[name="qty"]').val(rowProduct.qty);
                $('[name="length"]').val(rowProduct.length);
                $('[name="width"]').val(rowProduct.width);
                $('[name="height"]').val(rowProduct.height);
                $('[name="volume"]').val(rowProduct.volume);
                $('[name="weight"]').val(rowProduct.weight);
                $('[name="normal_price"]').val(row.normal_price);
                $('[name="company_before_tax_pcs"]').val(row.company_before_tax_pcs);
                $('[name="company_before_tax_ctn"]').val(row.company_before_tax_ctn);
                $('[name="company_after_tax_pcs"]').val(row.company_after_tax_pcs);
                $('[name="company_after_tax_ctn"]').val(row.company_after_tax_ctn);
                $('#stock_availibility').val(row.stock_availibility);
                $('[name="dipo_discount"]').val(row.dipo_discount);
                $('[name="dipo_before_tax_pcs"]').val(row.dipo_before_tax_pcs);
                $('[name="dipo_before_tax_ctn"]').val(row.dipo_before_tax_ctn);
                $('[name="dipo_after_tax_pcs"]').val(row.dipo_after_tax_pcs);
                $('[name="dipo_after_tax_ctn"]').val(row.dipo_after_tax_ctn);
                $('[name="dipo_after_tax_round_up"]').val(row.dipo_after_tax_round_up);
                $('[name="mitra_discount"]').val(row.mitra_discount);
                $('[name="mitra_before_tax_pcs"]').val(row.mitra_before_tax_pcs);
                $('[name="mitra_before_tax_ctn"]').val(row.mitra_before_tax_ctn);
                $('[name="mitra_after_tax_pcs"]').val(row.mitra_after_tax_pcs);
                $('[name="mitra_after_tax_ctn"]').val(row.mitra_after_tax_ctn);
                $('[name="mitra_after_tax_round_up"]').val(row.mitra_after_tax_round_up);
                $('[name="customer_discount"]').val(row.customer_discount);
                $('[name="customer_before_tax_pcs"]').val(row.customer_before_tax_pcs);
                $('[name="customer_before_tax_ctn"]').val(row.customer_before_tax_ctn);
                $('[name="customer_after_tax_pcs"]').val(row.customer_after_tax_pcs);
                $('[name="customer_after_tax_ctn"]').val(row.customer_after_tax_ctn);
                $('[name="customer_after_tax_round_up"]').val(row.customer_after_tax_round_up);
                $('[name="het_round_up_pcs"]').val(row.het_round_up_pcs);
                $('[name="het_round_up_ctn"]').val(row.het_round_up_ctn);

                $('#modal_form').modal('show');
                $('.modal-title').text('<?=lang('edit_pricelist')?>'); 
            }else if(json.status == "error"){
                toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
            }
            App.unblockUI('#form-wrapper');
       });
    }

</script>
@stop