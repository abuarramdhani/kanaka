@extends('default.views.layouts.default')

@section('title') {{lang('companyreport')}} @stop

@section('body')
<style type="text/css">
    .form-group span.error {
        margin-left: 33.3% !important;
    }
    .form-group.net_price_in_ctn_after_tax span.error {
        margin-left: 1.5% !important;
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
                <span>{{lang('companyreport')}}</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title"> {{lang('companyreport')}} </h3>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADERs-->
    <div class="row">
        <div class="col-md-12">
            <div class="tabbable-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_sell_in" data-toggle="tab" aria-expanded="true"> <?= lang('sell_in') ?> </a></li>
                    <li class=""><a href="#tab_sell_out" data-toggle="tab" aria-expanded="false"> <?= lang('sell_out') ?> </a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_sell_in">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div id="table-wrapper" class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption font-dark">
                                    <i class="icon-grid font-dark"></i>
                                    <span class="caption-subject"> {{lang('sell_in')}}</span>
                                </div>
                                <div class="tools">
                                    @if($add_access == 1)
                                        <button onclick="add_companyreport()" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>{{lang('new_sell_in_company')}}</button>
                                    @endif

                                    @if($print_limited_access == 1 || $print_unlimited_access == 1)
                                        <!-- <button onClick="return window.open('{{base_url()}}reports/companyreport/pdf')" class="btn btn-danger btn-sm">
                                            <i class="fa fa-file-pdf-o"></i> {{ lang('print_pdf') }}
                                        </button> -->
                                        <button onClick="return window.open('{{base_url()}}reports/companyreport/excel')" class="btn btn-success btn-sm">
                                            <i class="fa fa-file-excel-o"></i> {{ lang('print_excel') }}
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <div class="portlet-body">
                                <table id="table-companyreport" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                                    <thead>
                                        <tr>
                                            <th><?=lang('po_date')?></th>
                                            <th><?=lang('receive_date')?></th>
                                            <th><?=lang('check_status')?></th>
                                            <th><?=lang('monthly_period')?></th>
                                            <th><?=lang('tax_status')?></th>
                                            <th><?=lang('tax_no')?></th>
                                            <th><?=lang('invoice_no')?></th>
                                            <th><?=lang('sp_no')?></th>
                                            <th><?=lang('sp_id')?></th>
                                            <th><?=lang('principle_code')?></th>
                                            <th><?=lang('principle_name')?></th>
                                            <th><?=lang('product_code')?></th>
                                            <th><?=lang('product_name')?></th>
                                            <th><?=lang('customer_code')?></th>
                                            <th><?=lang('ship_to_delivery')?></th>
                                            <th><?=lang('price_hna_per_ctn_before_tax')?></th>
                                            <th><?=lang('price_hna_per_ctn_after_tax')?></th>
                                            <th><?=lang('total_order_in_ctn')?></th>
                                            <th><?=lang('discount')?></th>
                                            <th><?=lang('discount_value')?></th>
                                            <th><?=lang('ppn')?></th>
                                            <th><?=lang('net_price_in_ctn_before_tax')?></th>
                                            <th><?=lang('net_price_in_ctn_after_tax')?></th>
                                            <th><?=lang('total_value_order_in_ctn_before_tax')?></th>
                                            <th><?=lang('total_value_order_in_ctn_after_tax')?></th>
                                            <th><?=lang('top')?></th>
                                            <th><?=lang('due_date_invoice')?></th>
                                            <th><?=lang('aging_invoice')?></th>
                                            <th><?=lang('due_date_ar')?></th>
                                            <th><?=lang('payment_status')?></th>
                                            <th><?=lang('payment_value')?></th>
                                            <th><?=lang('difference')?></th>
                                            <th><?=lang('selling_price')?></th>
                                            <th><?=lang('margin_percented')?></th>
                                            <th><?=lang('margin_value')?></th>
                                            <th><?=lang('margin_contibution')?></th>
                                            <th><?=lang('remark')?></th>
                                            <th width="13%"><?=lang('options')?></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <!-- END EXAMPLE TABLES PORTLET-->
                    </div>
                    <div class="tab-pane" id="tab_sell_out">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div id="table-wrapper" class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption font-dark">
                                    <i class="icon-grid font-dark"></i>
                                    <span class="caption-subject"> {{lang('sell_out')}}</span>
                                </div>
                                <div class="tools">
                                    @if($add_access == 1)
                                        <button onclick="add_companyreport_out()" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>{{lang('new_sell_out_company')}}</button>
                                    @endif

                                    @if($print_limited_access == 1 || $print_unlimited_access == 1)
                                        <!-- <button onClick="return window.open('{{base_url()}}reports/companyreport/pdf')" class="btn btn-danger btn-sm">
                                            <i class="fa fa-file-pdf-o"></i> {{ lang('print_pdf') }}
                                        </button> -->
                                        <button onClick="return window.open('{{base_url()}}reports/companyreport/excel_out')" class="btn btn-success btn-sm">
                                            <i class="fa fa-file-excel-o"></i> {{ lang('print_excel') }}
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <div class="portlet-body">
                                <table id="table-companyreport-out" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                                    <thead>
                                        <tr>
                                            <th><?=lang('receive_date')?></th>
                                            <th><?=lang('monthly_period')?></th>
                                            <th><?=lang('tax_status')?></th>
                                            <th><?=lang('tax_no')?></th>
                                            <th><?=lang('invoice_no')?></th>
                                            <th><?=lang('invoice_id')?></th>
                                            <th><?=lang('product_code')?></th>
                                            <th><?=lang('product_name')?></th>
                                            <th><?=lang('customer_code')?></th>
                                            <th><?=lang('ship_to_delivery')?></th>
                                            <th><?=lang('price_hna_per_ctn_before_tax')?></th>
                                            <th><?=lang('price_hna_per_ctn_after_tax')?></th>
                                            <th><?=lang('total_order_in_ctn')?></th>
                                            <th><?=lang('discount')?></th>
                                            <th><?=lang('discount_value')?></th>
                                            <th><?=lang('ppn')?></th>
                                            <th><?=lang('net_price_in_ctn_before_tax')?></th>
                                            <th><?=lang('net_price_in_ctn_after_tax')?></th>
                                            <th><?=lang('total_value_order_in_ctn_before_tax')?></th>
                                            <th><?=lang('total_value_order_in_ctn_after_tax')?></th>
                                            <th><?=lang('top')?></th>
                                            <th><?=lang('due_date_invoice')?></th>
                                            <th><?=lang('aging_invoice')?></th>
                                            <th><?=lang('due_date_ar')?></th>
                                            <th><?=lang('payment_status')?></th>
                                            <th><?=lang('payment_value')?></th>
                                            <th><?=lang('difference')?></th>
                                            <th><?=lang('remark')?></th>
                                            <th width="13%"><?=lang('options')?></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <!-- END EXAMPLE TABLES PORTLET-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog" style="width:80%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?=lang('new_sell_in_company')?></h3>
      </div>
      {{ form_open(null,array('id' => 'form-companyreport', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
      <div class="modal-body">
        <input type="hidden" name="id" value="">
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('po_date')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm datepicker" name="po_date" id="po_date" placeholder="<?=lang('po_date')?>" maxlength="10" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('receive_date')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm datepicker" name="receive_date" id="receive_date" placeholder="<?=lang('receive_date')?>" maxlength="10" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('check_status')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <select class="form-control input-sm" name="check_status" id="check_status">
                            <option value=""><?= lang('select_your_option') ?></option>
                            <option value="0"><?= lang('no') ?></option>
                            <option value="1"><?= lang('yes') ?></option>
                        </select>
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('tax_status')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <select class="form-control input-sm" name="tax_status" id="tax_status">
                            <option value=""><?= lang('select_your_option') ?></option>
                            <option value="0"><?= lang('non_pkp') ?></option>
                            <option value="1"><?= lang('pkp') ?></option>
                        </select>
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('tax_no')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="tax_no" id="tax_no" placeholder="<?=lang('tax_no')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('invoice_no')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <select class="form-control input-sm all_select2" name="invoice_id" id="invoice_id" style="width: 100%;">
                            <option value=""><?= lang('select_your_option') ?></option>
                            @foreach($invoices as $invoice)
                                <option value="{{ $invoice->id }}">{{ $invoice->invoice_no }}</option>
                            @endforeach
                        </select>
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('sp_no')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <select class="form-control input-sm all_select2" name="sp_id" id="sp_id" style="width: 100%;">
                            <option value=""><?= lang('select_your_option') ?></option>
                            @foreach($delivery_orders as $delivery_order)
                                <option value="{{ $delivery_order->id }}">{{ $delivery_order->sp_no }}</option>
                            @endforeach
                        </select>
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('principle')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <select class="form-control input-sm all_select2" name="principle_id" id="principle_id" style="width: 100%;">
                            <option value=""><?= lang('select_your_option') ?></option>
                            @foreach($principles as $principle)
                                <option value="{{ $principle->id }}">{{ $principle->code . ' - ' . $principle->name }}</option>
                            @endforeach
                        </select>
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('product')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <select class="form-control input-sm all_select2" name="product_id" id="product_id" style="width: 100%;">
                            <option value=""><?= lang('select_your_option') ?></option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->product_code . ' - ' . $product->product_name }}</option>
                            @endforeach
                        </select>
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('ship_to_delivery')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <select class="form-control input-sm all_select2" name="customer_id" id="customer_id" style="width: 100%;">
                            <option value=""><?= lang('select_your_option') ?></option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->customer_code . ' - ' . $customer->customer_name }}</option>
                            @endforeach
                        </select>
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input net_price_in_ctn_after_tax">
                    <label class="col-lg-4 control-label"><?=lang('net_price_in_ctn_after_tax')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <select class="form-control input-sm" name="net_price_in_ctn_after_tax" id="net_price_in_ctn_after_tax" style="width: 100%;">
                            <option value=""><?= lang('select_your_option') ?></option>
                        </select>
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('total_order_in_ctn')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm number" name="total_order_in_ctn" id="total_order_in_ctn" placeholder="<?=lang('total_order_in_ctn')?>" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('payment_status')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <select class="form-control input-sm" name="payment_status" id="payment_status">
                            <option value=""><?= lang('select_your_option') ?></option>
                            <option value="0"><?= lang('not_yet') ?></option>
                            <option value="1"><?= lang('done') ?></option>
                        </select>
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('remark')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="remark" id="remark" placeholder="<?=lang('remark')?>" maxlength="150" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('price_hna_per_ctn_before_tax')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm currency" name="price_hna_per_ctn_before_tax" id="price_hna_per_ctn_before_tax" placeholder="<?=lang('price_hna_per_ctn_before_tax')?>" readonly="readonly" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('price_hna_per_ctn_after_tax')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm currency" name="price_hna_per_ctn_after_tax" id="price_hna_per_ctn_after_tax" placeholder="<?=lang('price_hna_per_ctn_after_tax')?>" readonly="readonly" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('discount')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm currency" name="discount" id="discount" placeholder="<?=lang('discount')?>" readonly="readonly" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('discount_value')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm currency" name="discount_value" id="discount_value" placeholder="<?=lang('discount_value')?>" readonly="readonly" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('ppn')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm currency" name="ppn" id="ppn" placeholder="<?=lang('ppn')?>" readonly="readonly" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('net_price_in_ctn_before_tax')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm currency" name="net_price_in_ctn_before_tax" id="net_price_in_ctn_before_tax" placeholder="<?=lang('net_price_in_ctn_before_tax')?>" readonly="readonly" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('total_value_order_in_ctn_before_tax')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm currency" name="total_value_order_in_ctn_before_tax" id="total_value_order_in_ctn_before_tax" placeholder="<?=lang('total_value_order_in_ctn_before_tax')?>" readonly="readonly" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('total_value_order_in_ctn_after_tax')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm currency" name="total_value_order_in_ctn_after_tax" id="total_value_order_in_ctn_after_tax" placeholder="<?=lang('total_value_order_in_ctn_after_tax')?>" readonly="readonly" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('top')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="top" id="top" placeholder="<?=lang('top')?>" readonly="readonly" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('selling_price')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm currency" name="selling_price" id="selling_price" placeholder="<?=lang('selling_price')?>" readonly="readonly" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('margin_value')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm currency" name="margin_value" id="margin_value" placeholder="<?=lang('margin_value')?>" readonly="readonly" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('margin_percented')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="margin_percented" id="margin_percented" placeholder="<?=lang('margin_percented')?>" readonly="readonly" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('payment_value')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm currency" name="payment_value" id="payment_value" placeholder="<?=lang('payment_value')?>" readonly="readonly" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('difference')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm currency" name="difference" id="difference" placeholder="<?=lang('difference')?>" readonly="readonly" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
            </div>
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

<div class="modal fade" id="modal_form_out" role="dialog">
  <div class="modal-dialog" style="width:80%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?=lang('new_sell_out_company')?></h3>
      </div>
      {{ form_open(null,array('id' => 'form-companyreport-out', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
      <div class="modal-body">
        <input type="hidden" name="id_out" value="">
        
        <div class="row">
            <div class="col-md-6">                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('receive_date')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm datepicker" name="receive_date_out" id="receive_date_out" placeholder="<?=lang('receive_date')?>" maxlength="10" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('tax_status')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <select class="form-control input-sm" name="tax_status_out" id="tax_status_out">
                            <option value=""><?= lang('select_your_option') ?></option>
                            <option value="0"><?= lang('non_pkp') ?></option>
                            <option value="1"><?= lang('pkp') ?></option>
                        </select>
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('tax_no')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="tax_no_out" id="tax_no_out" placeholder="<?=lang('tax_no')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('invoice_no')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <select class="form-control input-sm all_select2" name="invoice_id_out" id="invoice_id_out" style="width: 100%;">
                            <option value=""><?= lang('select_your_option') ?></option>
                            @foreach($invoices as $invoice)
                                <option value="{{ $invoice->id }}">{{ $invoice->invoice_no }}</option>
                            @endforeach
                        </select>
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('product')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <select class="form-control input-sm all_select2" name="product_id_out" id="product_id_out" style="width: 100%;">
                            <option value=""><?= lang('select_your_option') ?></option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->product_code . ' - ' . $product->product_name }}</option>
                            @endforeach
                        </select>
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('ship_to_delivery')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <select class="form-control input-sm all_select2" name="customer_id_out" id="customer_id_out" style="width: 100%;">
                            <option value=""><?= lang('select_your_option') ?></option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->customer_code . ' - ' . $customer->customer_name }}</option>
                            @endforeach
                        </select>
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input net_price_in_ctn_after_tax">
                    <label class="col-lg-4 control-label"><?=lang('net_price_in_ctn_after_tax')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <select class="form-control input-sm" name="net_price_in_ctn_after_tax_out" id="net_price_in_ctn_after_tax_out" style="width: 100%;">
                            <option value=""><?= lang('select_your_option') ?></option>
                        </select>
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('total_order_in_ctn')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm number" name="total_order_in_ctn_out" id="total_order_in_ctn_out" placeholder="<?=lang('total_order_in_ctn')?>" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('payment_status')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <select class="form-control input-sm" name="payment_status_out" id="payment_status_out">
                            <option value=""><?= lang('select_your_option') ?></option>
                            <option value="0"><?= lang('not_yet') ?></option>
                            <option value="1"><?= lang('done') ?></option>
                        </select>
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('remark')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="remark_out" id="remark_out" placeholder="<?=lang('remark')?>" maxlength="150" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('price_hna_per_ctn_before_tax')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm currency" name="price_hna_per_ctn_before_tax_out" id="price_hna_per_ctn_before_tax_out" placeholder="<?=lang('price_hna_per_ctn_before_tax')?>" readonly="readonly" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('price_hna_per_ctn_after_tax')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm currency" name="price_hna_per_ctn_after_tax_out" id="price_hna_per_ctn_after_tax_out" placeholder="<?=lang('price_hna_per_ctn_after_tax')?>" readonly="readonly" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('discount')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm currency" name="discount_out" id="discount_out" placeholder="<?=lang('discount')?>" readonly="readonly" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('discount_value')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm currency" name="discount_value_out" id="discount_value_out" placeholder="<?=lang('discount_value')?>" readonly="readonly" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('ppn')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm currency" name="ppn_out" id="ppn_out" placeholder="<?=lang('ppn')?>" readonly="readonly" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('net_price_in_ctn_before_tax')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm currency" name="net_price_in_ctn_before_tax_out" id="net_price_in_ctn_before_tax_out" placeholder="<?=lang('net_price_in_ctn_before_tax')?>" readonly="readonly" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('total_value_order_in_ctn_before_tax')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm currency" name="total_value_order_in_ctn_before_tax_out" id="total_value_order_in_ctn_before_tax_out" placeholder="<?=lang('total_value_order_in_ctn_before_tax')?>" readonly="readonly" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('total_value_order_in_ctn_after_tax')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm currency" name="total_value_order_in_ctn_after_tax_out" id="total_value_order_in_ctn_after_tax_out" placeholder="<?=lang('total_value_order_in_ctn_after_tax')?>" readonly="readonly" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('top')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="top_out" id="top_out" placeholder="<?=lang('top')?>" readonly="readonly" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('payment_value')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm currency" name="payment_value_out" id="payment_value_out" placeholder="<?=lang('payment_value')?>" readonly="readonly" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('difference')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm currency" name="difference_out" id="difference_out" placeholder="<?=lang('difference')?>" readonly="readonly" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
            </div>
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
    $(function(){
        $('.all_select2').select2();
    });

    function add_companyreport(){
        $('#form-companyreport')[0].reset(); 
        $('#modal_form').modal('show'); 
        $('.modal-title').text('<?=lang('new_sell_in_company')?>'); 

        $('[name="id"]').val('');
        $('[name="po_date"]').val('<?= date('d-m-Y') ?>');
        $('[name="receive_date"]').val('<?= date('d-m-Y') ?>');
    }
    
    function add_companyreport_out(){
        $('#form-companyreport-out')[0].reset(); 
        $('#modal_form_out').modal('show'); 
        $('.modal-title').text('<?=lang('new_sell_out_company')?>'); 

        $('[name="id_out"]').val('');
        $('[name="receive_date_out"]').val('<?= date('d-m-Y') ?>');
    }

    toastr.options = { "positionClass": "toast-top-right", };

    // Pengaturan Datatable 
    
    var oTable =$('#table-companyreport').dataTable({
        "responsive": false,
        "bProcessing": true,
        "bServerSide": true,
        "bLengthChange": true,
        "sServerMethod": "GET",
        "sAjaxSource": "{{ base_url() }}companyreport/companyreports/fetch_data",
        "columnDefs": [
            {"className": "dt-center", "targets": [37]},
            {"targets": [26, 27, 28, 37], "orderable": false}
        ],
        "order": [0,"asc"],
    }).fnSetFilteringDelay(1000);
    
    var oTable =$('#table-companyreport-out').dataTable({
        "responsive": false,
        "bProcessing": true,
        "bServerSide": true,
        "bLengthChange": true,
        "sServerMethod": "GET",
        "sAjaxSource": "{{ base_url() }}companyreport/companyreports/fetch_data_out",
        "columnDefs": [
            {"className": "dt-center", "targets": [28]},
            {"targets": [21, 22, 23, 28], "orderable": false}
        ],
        "order": [0,"asc"],
    }).fnSetFilteringDelay(1000);

    // Pengaturan Form Validation 
    var form_validator = $("#form-companyreport").validate({
        errorPlacement: function(error, element) {
            $(element).parent().closest('.form-group').append(error);
        },
        errorElement: "span",
        rules: {
            po_date: "required",
            receive_date: "required",
            check_status: "required",
            tax_status: "required",
            tax_no: "required",
            invoice_id: "required",
            sp_id: "required",
            principle_id: "required",
            product_id: "required",
            customer_id: "required",
            net_price_in_ctn_after_tax: "required",
            total_order_in_ctn: "required",
            payment_status: "required",
        },
        messages: {
            po_date: "{{lang('po_date')}}" + " {{lang('not_empty')}}",
            receive_date: "{{lang('receive_date')}}" + " {{lang('not_empty')}}",
            check_status: "{{lang('check_status')}}" + " {{lang('not_empty')}}",
            tax_status: "{{lang('tax_status')}}" + " {{lang('not_empty')}}",
            tax_no: "{{lang('tax_no')}}" + " {{lang('not_empty')}}",
            invoice_id: "{{lang('invoice_id')}}" + " {{lang('not_empty')}}",
            sp_id: "{{lang('sp_id')}}" + " {{lang('not_empty')}}",
            principle_id: "{{lang('principle_id')}}" + " {{lang('not_empty')}}",
            product_id: "{{lang('product_id')}}" + " {{lang('not_empty')}}",
            customer_id: "{{lang('customer_id')}}" + " {{lang('not_empty')}}",
            net_price_in_ctn_after_tax: "{{lang('net_price_in_ctn_after_tax')}}" + " {{lang('not_empty')}}",
            total_order_in_ctn: "{{lang('total_order_in_ctn')}}" + " {{lang('not_empty')}}",
            payment_status: "{{lang('payment_status')}}" + " {{lang('not_empty')}}",
        },
        submitHandler : function(form){
            App.blockUI({
                target: '#form-wrapper'
            });
            $(form).ajaxSubmit({  
                beforeSubmit:  showRequest,  
                success:       showResponse,
                url:       '{{base_url()}}companyreport/companyreports/save',      
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
   
    // Pengaturan Form Validation 
    var form_validator_out = $("#form-companyreport-out").validate({
        errorPlacement: function(error, element) {
            $(element).parent().closest('.form-group').append(error);
        },
        errorElement: "span",
        rules: {
            receive_date_out: "required",
            tax_status_out: "required",
            tax_no_out: "required",
            invoice_id_out: "required",
            product_id_out: "required",
            customer_id_out: "required",
            net_price_in_ctn_after_tax_out: "required",
            total_order_in_ctn_out: "required",
            payment_status_out: "required",
        },
        messages: {
            receive_date_out: "{{lang('receive_date')}}" + " {{lang('not_empty')}}",
            tax_status_out: "{{lang('tax_status')}}" + " {{lang('not_empty')}}",
            tax_no_out: "{{lang('tax_no')}}" + " {{lang('not_empty')}}",
            invoice_id_out: "{{lang('invoice_id')}}" + " {{lang('not_empty')}}",
            product_id_out: "{{lang('product_id')}}" + " {{lang('not_empty')}}",
            customer_id_out: "{{lang('customer_id')}}" + " {{lang('not_empty')}}",
            net_price_in_ctn_after_tax_out: "{{lang('net_price_in_ctn_after_tax')}}" + " {{lang('not_empty')}}",
            total_order_in_ctn_out: "{{lang('total_order_in_ctn')}}" + " {{lang('not_empty')}}",
            payment_status_out: "{{lang('payment_status')}}" + " {{lang('not_empty')}}",
        },
        submitHandler : function(form){
            App.blockUI({
                target: '#form-wrapper'
            });
            $(form).ajaxSubmit({  
                beforeSubmit:  showRequest,  
                success:       showResponse,
                url:       '{{base_url()}}companyreport/companyreports/save_out',      
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
    function viewData(value){   
        form_validator.resetForm();
        $("html, body").animate({
            scrollTop: 0
        }, 500);
        App.blockUI({
            target: '#form-wrapper'
        });
        $.getJSON('{{base_url()}}companyreport/companyreports/view', {id: value}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data;

                $('[name="id"]').val(row.id);
                $('[name="po_date"]').val(row.po_date);
                $('[name="receive_date"]').val(row.receive_date);
                $('[name="check_status"]').val(row.check_status);
                $('[name="tax_status"]').val(row.tax_status);
                $('[name="tax_no"]').val(row.tax_no);
                $('[name="invoice_id"]').val(row.invoice_id).change();
                $('[name="sp_id"]').val(row.sp_id).change();
                $('[name="principle_id"]').val(row.principle_id).change();
                $('[name="product_id"]').val(row.product_id).change();
                $('[name="customer_id"]').val(row.customer_id).change();
                $('[name="net_price_in_ctn_after_tax"]').val(row.net_price_in_ctn_after_tax).change();
                $('[name="total_order_in_ctn"]').val(row.total_order_in_ctn);
                $('[name="payment_status"]').val(row.payment_status).change();
                $('[name="remark"]').val(row.remark);
                $('[name="price_hna_per_ctn_before_tax"]').val(row.price_hna_per_ctn_before_tax);
                $('[name="price_hna_per_ctn_after_tax"]').val(row.price_hna_per_ctn_after_tax);
                $('[name="discount"]').val(row.discount);
                $('[name="discount_value"]').val(row.discount_value);
                $('[name="ppn"]').val(row.ppn);
                $('[name="net_price_in_ctn_before_tax"]').val(row.net_price_in_ctn_before_tax);
                $('[name="total_value_order_in_ctn_before_tax"]').val(row.total_value_order_in_ctn_before_tax);
                $('[name="total_value_order_in_ctn_after_tax"]').val(row.total_value_order_in_ctn_after_tax);
                $('[name="top"]').val(row.top);
                $('[name="selling_price"]').val(row.selling_price);
                $('[name="margin_value"]').val(row.margin_value);
                $('[name="margin_percented"]').val(row.margin_percented);
                $('[name="payment_value"]').val(row.payment_value);
                $('[name="difference"]').val(row.difference);

                $('#modal_form').modal('show');
                $('.modal-title').text('<?=lang('edit_sell_in_company')?>'); 
            }else if(json.status == "error"){
                toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
            }
            App.unblockUI('#form-wrapper');
       });
    }

    // Menampilkan data pada form
    function viewDataOut(value){   
        form_validator_out.resetForm();
        $("html, body").animate({
            scrollTop: 0
        }, 500);
        App.blockUI({
            target: '#form-wrapper'
        });
        $.getJSON('{{base_url()}}companyreport/companyreports/view_out', {id: value}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data;

                $('[name="id_out"]').val(row.id);
                $('[name="receive_date_out"]').val(row.receive_date);
                $('[name="tax_status_out"]').val(row.tax_status);
                $('[name="tax_no_out"]').val(row.tax_no);
                $('[name="invoice_id_out"]').val(row.invoice_id).change();
                $('[name="product_id_out"]').val(row.product_id).change();
                $('[name="customer_id_out"]').val(row.customer_id).change();
                $('[name="net_price_in_ctn_after_tax_out"]').val(row.net_price_in_ctn_after_tax).change();
                $('[name="total_order_in_ctn_out"]').val(row.total_order_in_ctn);
                $('[name="payment_status_out"]').val(row.payment_status).change();
                $('[name="remark_out"]').val(row.remark);
                $('[name="price_hna_per_ctn_before_tax_out"]').val(row.price_hna_per_ctn_before_tax);
                $('[name="price_hna_per_ctn_after_tax_out"]').val(row.price_hna_per_ctn_after_tax);
                $('[name="discount_out"]').val(row.discount);
                $('[name="discount_value_out"]').val(row.discount_value);
                $('[name="ppn_out"]').val(row.ppn);
                $('[name="net_price_in_ctn_before_tax_out"]').val(row.net_price_in_ctn_before_tax);
                $('[name="total_value_order_in_ctn_before_tax_out"]').val(row.total_value_order_in_ctn_before_tax);
                $('[name="total_value_order_in_ctn_after_tax_out"]').val(row.total_value_order_in_ctn_after_tax);
                $('[name="payment_value_out"]').val(row.payment_value);
                $('[name="difference_out"]').val(row.difference);

                $('#modal_form_out').modal('show');
                $('.modal-title').text('<?=lang('edit_sell_out_company')?>'); 
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
                $.getJSON('{{base_url()}}companyreport/companyreports/delete', {id: value}, function(json, textStatus) {
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

    // Proses hapus data
    function deleteDataOut(value){
        form_validator_out.resetForm();
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
                $.getJSON('{{base_url()}}companyreport/companyreports/delete_out', {id: value}, function(json, textStatus) {
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

    $('#principle_id').change(function(){
        $.getJSON('{{base_url()}}companyreport/companyreports/getprinciplebyid', {id: $('#principle_id').val()}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data;

                $('#top').val(row.top);

            }else if(json.status == "error"){
                toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
            }
            App.unblockUI('#form-wrapper');
       });
    });

    $('#product_id').change(function(){
        $.getJSON('{{base_url()}}companyreport/companyreports/getpricelistbyproduct', {id: $('#product_id').val()}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data;
                var html = '<option value=""><?= lang('select_your_option') ?></option>';

                $.each(row, function(){
                    var val_id = '';
                    var val_text = '';
                    $.each(this, function(name, value){
                        if(name == 'id')
                            val_id = value;

                        if(name == 'company_after_tax_ctn')
                            val_text = value;
    
                    });
                    html += '<option value="' + val_id + '">' + val_text + '</option>';
                });

                $('#net_price_in_ctn_after_tax').html(html);

            }else if(json.status == "error"){
                toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
            }
            App.unblockUI('#form-wrapper');
        });
    });

    $('#product_id_out').change(function(){
        $.getJSON('{{base_url()}}companyreport/companyreports/getpricelistbyproduct', {id: $('#product_id_out').val()}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data;
                var html = '<option value=""><?= lang('select_your_option') ?></option>';

                $.each(row, function(){
                    var val_id = '';
                    var val_text = '';
                    $.each(this, function(name, value){
                        if(name == 'id')
                            val_id = value;

                        if(name == 'company_after_tax_ctn')
                            val_text = value;
    
                    });
                    html += '<option value="' + val_id + '">' + val_text + '</option>';
                });

                $('#net_price_in_ctn_after_tax_out').html(html);

            }else if(json.status == "error"){
                toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
            }
            App.unblockUI('#form-wrapper');
        });
    });

    $('#net_price_in_ctn_after_tax').change(function(){
        $.getJSON('{{base_url()}}companyreport/companyreports/getpricelistbyid', {id: $('#net_price_in_ctn_after_tax').val()}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data;

                var price_hna_per_ctn_after_tax = row.normal_price;
                var price_hna_per_ctn_before_tax = parseInt(price_hna_per_ctn_after_tax / 1.1);
                var net_price_in_ctn_after_tax = $('#net_price_in_ctn_after_tax option:selected').text();
                var net_price_in_ctn_before_tax = parseInt(net_price_in_ctn_after_tax / 1.1);
                var discount_value = price_hna_per_ctn_after_tax - net_price_in_ctn_after_tax;
                var discount = discount_value / price_hna_per_ctn_after_tax;
                var ppn = net_price_in_ctn_after_tax - net_price_in_ctn_before_tax;
                
                var total_order_in_ctn = $('#total_order_in_ctn').val();
                var total_value_order_in_ctn_before_tax = net_price_in_ctn_before_tax * total_order_in_ctn;
                var total_value_order_in_ctn_after_tax = net_price_in_ctn_after_tax * total_order_in_ctn;

                var selling_price = row.dipo_after_tax_round_up;
                var margin_value = selling_price - total_value_order_in_ctn_after_tax;
                var margin_percented = parseInt(margin_value / selling_price);

                $('#price_hna_per_ctn_before_tax').val(price_hna_per_ctn_before_tax);
                $('#discount_value').val(discount_value);
                $('#discount').val(discount);
                $('#net_price_in_ctn_before_tax').val(net_price_in_ctn_before_tax);
                $('#ppn').val(ppn);
                $('#total_value_order_in_ctn_before_tax').val(total_value_order_in_ctn_before_tax);
                $('#total_value_order_in_ctn_after_tax').val(total_value_order_in_ctn_after_tax);
                
                $('#selling_price').val(selling_price);
                $('#margin_value').val(margin_value);
                $('#margin_percented').val(margin_percented);
                $('#price_hna_per_ctn_after_tax').val(price_hna_per_ctn_after_tax);
            }else if(json.status == "error"){
                toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
            }
            App.unblockUI('#form-wrapper');
        });
    });

    $('#net_price_in_ctn_after_tax_out').change(function(){
        $.getJSON('{{base_url()}}companyreport/companyreports/getpricelistbyid', {id: $('#net_price_in_ctn_after_tax_out').val()}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data;

                var price_hna_per_ctn_after_tax = row.normal_price;
                var price_hna_per_ctn_before_tax = parseInt(price_hna_per_ctn_after_tax / 1.1);
                var net_price_in_ctn_after_tax = $('#net_price_in_ctn_after_tax_out option:selected').text();
                var net_price_in_ctn_before_tax = parseInt(net_price_in_ctn_after_tax / 1.1);
                var discount_value = price_hna_per_ctn_after_tax - net_price_in_ctn_after_tax;
                var discount = discount_value / price_hna_per_ctn_after_tax;
                var ppn = net_price_in_ctn_after_tax - net_price_in_ctn_before_tax;
                
                var total_order_in_ctn = $('#total_order_in_ctn_out').val();
                var total_value_order_in_ctn_before_tax = net_price_in_ctn_before_tax * total_order_in_ctn;
                var total_value_order_in_ctn_after_tax = net_price_in_ctn_after_tax * total_order_in_ctn;

                $('#price_hna_per_ctn_before_tax_out').val(price_hna_per_ctn_before_tax);
                $('#discount_value_out').val(discount_value);
                $('#discount_out').val(discount);
                $('#net_price_in_ctn_before_tax_out').val(net_price_in_ctn_before_tax);
                $('#ppn_out').val(ppn);
                $('#total_value_order_in_ctn_before_tax_out').val(total_value_order_in_ctn_before_tax);
                $('#total_value_order_in_ctn_after_tax_out').val(total_value_order_in_ctn_after_tax);
                $('#price_hna_per_ctn_after_tax_out').val(price_hna_per_ctn_after_tax);
            }else if(json.status == "error"){
                toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
            }
            App.unblockUI('#form-wrapper');
        });
    });

    $('#total_order_in_ctn').change(function(){
        var total_order_in_ctn = $('#total_order_in_ctn').val();
        var net_price_in_ctn_after_tax = $('#net_price_in_ctn_after_tax option:selected').text();
        var net_price_in_ctn_before_tax = parseInt(net_price_in_ctn_after_tax / 1.1);
        var total_value_order_in_ctn_before_tax = net_price_in_ctn_before_tax * total_order_in_ctn;
        var total_value_order_in_ctn_after_tax = net_price_in_ctn_after_tax * total_order_in_ctn;

        var selling_price = $('#selling_price').val().replace(/_/g,'').replace(/,/g,'');
        var margin_value = selling_price - total_value_order_in_ctn_after_tax;
        var margin_percented = parseInt(margin_value / selling_price);

        $('#total_value_order_in_ctn_before_tax').val(total_value_order_in_ctn_before_tax);
        $('#total_value_order_in_ctn_after_tax').val(total_value_order_in_ctn_after_tax);
        $('#margin_value').val(margin_value);
        $('#margin_percented').val(margin_percented);

    });

    $('#total_order_in_ctn_out').change(function(){
        var total_order_in_ctn = $('#total_order_in_ctn_out').val();
        var net_price_in_ctn_after_tax = $('#net_price_in_ctn_after_tax_out option:selected').text();
        var net_price_in_ctn_before_tax = parseInt(net_price_in_ctn_after_tax / 1.1);
        var total_value_order_in_ctn_before_tax = net_price_in_ctn_before_tax * total_order_in_ctn;
        var total_value_order_in_ctn_after_tax = net_price_in_ctn_after_tax * total_order_in_ctn;


        $('#total_value_order_in_ctn_before_tax_out').val(total_value_order_in_ctn_before_tax);
        $('#total_value_order_in_ctn_after_tax_out').val(total_value_order_in_ctn_after_tax);

    });

    $('#payment_status').change(function(){
        var total_order_in_ctn = $('#total_order_in_ctn').val();
        var net_price_in_ctn_after_tax = $('#net_price_in_ctn_after_tax option:selected').text();
        var total_value_order_in_ctn_after_tax = net_price_in_ctn_after_tax * total_order_in_ctn;
        var payment_value = 0;
        var difference = 0;

        if($('#payment_status').val() == '1'){
            payment_value = total_value_order_in_ctn_after_tax;
        }
        else{
            payment_value = 0;
        }
        
        difference = payment_value - total_value_order_in_ctn_after_tax;

        $('#payment_value').val(payment_value);
        $('#difference').val(difference);

    });
    
    $('#payment_status_out').change(function(){
        var total_order_in_ctn = $('#total_order_in_ctn_out').val();
        var net_price_in_ctn_after_tax = $('#net_price_in_ctn_after_tax_out option:selected').text();
        var total_value_order_in_ctn_after_tax = net_price_in_ctn_after_tax * total_order_in_ctn;
        var payment_value = 0;
        var difference = 0;

        if($('#payment_status_out').val() == '1'){
            payment_value = total_value_order_in_ctn_after_tax;
        }
        else{
            payment_value = 0;
        }
        
        difference = payment_value - total_value_order_in_ctn_after_tax;

        $('#payment_value_out').val(payment_value);
        $('#difference_out').val(difference);

    });

    $('#customer_id_out').change(function(){
        $.getJSON('{{base_url()}}companyreport/companyreports/getcustomerbyid', {id: $('#customer_id_out').val()}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data;

                $('#top_out').val(row.top);

            }else if(json.status == "error"){
                toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
            }
            App.unblockUI('#form-wrapper');
        });
    });

</script>
@stop