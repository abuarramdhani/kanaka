@extends('default.views.layouts.default')

@section('title') {{lang('invoice')}} @stop

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
                <span>{{lang('invoice')}}</span>
            </li>
        </ul>
        
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title"> {{lang('invoice')}} </h3>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADERs-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="table-wrapper" class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-grid font-dark"></i>
                        <span class="caption-subject">{{lang('invoice')}}</span>
                    </div>
                    <div class="tools">
                        @if($add_access == 1)
                            <button onclick="add_invoice()" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>{{lang('tambah_invoice')}}</button>
                        @endif

                        @if($print_limited_access == 1 || $print_unlimited_access == 1)
                            <!-- <button onClick="return window.open('{{base_url()}}master/invoice/pdf')" class="btn btn-danger btn-sm">
                                <i class="fa fa-file-pdf-o"></i> {{ lang('print_pdf') }}
                            </button>
                            <button onClick="return window.open('{{base_url()}}master/invoice/excel')" class="btn btn-success btn-sm">
                                <i class="fa fa-file-excel-o"></i> {{ lang('print_excel') }}
                            </button> -->
                        @endif
                    </div>
                </div>
                <div class="portlet-body">
                    <table id="table-invoice" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                        <thead>
                            <tr>
                                <th class="text-center"><?=lang('invoice_no')?></th>
                                <th class="text-center"><?=lang('sj_no')?></th>
                                <th class="text-center"><?=lang('sp_no')?></th>
                                <th class="text-center"><?=lang('customer_name')?></th>
                                <th class="text-center"><?=lang('address')?></th>
                                <th class="text-center"><?=lang('pic')?></th>
                                <th class="text-center"><?=lang('payment_method')?></th>
                                <th class="text-center"><?=lang('issue_date')?></th>
                                <th class="text-center"><?=lang('receive_date')?></th>
                                <th class="text-center"><?=lang('due_date_invoice')?></th>
                                <th class="text-center"><?=lang('created_date')?></th>
                                <th class="text-center"><?=lang('options')?></th>
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
  <div class="modal-dialog" style="width:70%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?=lang('tambah_invoice')?></h3>
      </div>
      {{ form_open(null,array('id' => 'form-invoice', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
      <div class="modal-body">
        <input type="hidden" name="invoice_id" value="">
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('to')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
               <select id="dipo_partner_id" name="dipo_partner_id" class="form-control select2">
                    <option selected value=""><?=lang('select_your_option')?></option>
                    <?php
                        if (!empty($dipos)) {
                            foreach ($dipos as $c) { ?>
                            <option value="<?=$c->id?>"><?=ucwords($c->code . ' - ' . $c->name)?></option>
                    <?php } } ?>
                </select>  
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('invoice_no')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="invoice_no" id="invoice_no" placeholder="<?=lang('invoice_no')?>" maxlength="50" />
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('sj_no')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <select id="sj_id" name="sj_id" class="form-control select2">
                    <option selected disabled value=""><?=lang('select_your_option')?></option>
                </select>  
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('sp_no')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input readonly type="text" class="form-control input-sm" name="sp_no" id="sp_no" placeholder="<?=lang('sp_no')?>" maxlength="50" />
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">{{ lang('ship_to') }}</label>
            <div class="col-lg-7">
                <input readonly type="text" class="form-control input-sm" name="dipo_name" id="dipo_name" placeholder="<?=lang('dipo_name')?>" />
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">{{ lang('delivery_to') }}</label>
            <div class="col-lg-7">
                <input readonly type="text" class="form-control input-sm" name="dipo_address" id="dipo_address" placeholder="<?=lang('dipo_address')?>" />
               <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">{{ lang('pic') }}</label>
            <div class="col-lg-7">
                <input readonly type="text" class="form-control input-sm" name="dipo_pic" id="dipo_pic" placeholder="<?=lang('pic')?>" />
               <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">{{ lang('date_issued') }}</label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="date_issued" id="date_issued" placeholder="<?=lang('date_issued')?>" readonly="readonly" maxlength="10" />
               <div class="form-control-focus"> </div>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">{{ lang('receive_date') }}</label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="receive_date" id="receive_date" placeholder="<?=lang('receive_date')?>" readonly="readonly" maxlength="10" />
               <div class="form-control-focus"> </div>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">{{ lang('payment_method') }}</label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="dipo_top" id="dipo_top" placeholder="<?=lang('payment_method')?>" readonly="readonly" />
               <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">{{ lang('due_date_invoice') }}<span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="due_date" id="due_date" placeholder="<?=lang('due_date_invoice')?>" readonly="readonly" />
               <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">{{ lang('note') }}</label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="note" id="note" placeholder="<?=lang('note')?>" />
               <div class="form-control-focus"> </div>
            </div>
        </div>

        <hr/>
        
        <table id="add-table-surat" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
            <thead>
                <tr>
                    <th class="text-center">{{ lang('product_code') }}</th>
                    <th class="text-center">{{ lang('product_name') }}</th>
                    <th class="text-center">{{ lang('total_order_in_ctn') }}</th>
                    <th class="text-center">{{ lang('price_of_orders_per_ctn_before_tax') }}</th>
                    <th class="text-center">{{ lang('price_of_orders_per_ctn_after_tax') }}</th>
                    <th class="text-center">{{ lang('order_amount_after_tax') }}</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th colspan="2" class="text-center">{{ lang('total') }}</th>
                    <th class="text-center"><input readonly type="text" class="form-control input-sm" name="total_order_amount_in_ctn" id="total_order_amount_in_ctn"/></th>
                    <th class="text-center"><input readonly type="text" class="form-control input-sm" name="total_order_price_before_tax" id="total_order_price_before_tax"/></th>
                    <th class="text-center"><input readonly type="text" class="form-control input-sm" name="total_order_price_after_tax" id="total_order_price_after_tax"/></th>
                    <th class="text-center"><input readonly type="text" class="form-control input-sm" name="total_order_amount_after_tax" id="total_order_amount_after_tax"/></th>
                </tr>
            </tfoot>
        </table>
      </div>
      <div class="modal-footer">
        <button type="submit" id="btnSave" class="btn btn-primary">{{ lang('save') }}</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ lang('close') }}</button>
      </div>
      {{ form_close() }}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modal_detail" role="dialog">
  <div class="modal-dialog" style="width:70%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?=lang('invoice')?></h3>
        <button onClick="printPdf()" class="btn btn-danger btn-sm">
            <i class="fa fa-file-pdf-o"></i> {{ lang('print_pdf') }}
        </button>
        <button onClick="printExcel()" class="btn btn-success btn-sm">
            <i class="fa fa-file-excel-o"></i> {{ lang('print_excel') }}
        </button> 
      </div>
      {{ form_open(null,array('id' => 'form-suratpesanan-view', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
      <div class="modal-body">
        <input type="hidden" name="invoice_id" value="">
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('to')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input readonly type="text" class="form-control input-sm" name="dipo_code" id="dipo_code" placeholder="<?=lang('dipo_code')?>" /><br/>
                <input readonly type="text" class="form-control input-sm" name="dipo_name" id="dipo_name" placeholder="<?=lang('dipo_name')?>" /><br/>
                <input readonly type="text" class="form-control input-sm" name="dipo_pic" id="dipo_pic" placeholder="<?=lang('dipo_pic')?>" />
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('invoice_no')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input readonly type="text" class="form-control input-sm" name="invoice_no" id="invoice_no" placeholder="<?=lang('invoice_no')?>" maxlength="50" />
               <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('sj_no')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input readonly type="text" class="form-control input-sm" name="sj_no" id="sj_no" placeholder="<?=lang('sj_no')?>" maxlength="50" />
               <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('sp_no')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input readonly type="text" class="form-control input-sm" name="sp_no" id="sp_no" placeholder="<?=lang('sp_no')?>" maxlength="50" />
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">{{ lang('customer_name') }}</label>
            <div class="col-lg-7">
                <input readonly type="text" class="form-control input-sm" name="dipo_name" id="dipo_name" placeholder="<?=lang('dipo_name')?>" />
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">{{ lang('delivery_to') }}</label>
            <div class="col-lg-7">
                <input readonly type="text" class="form-control input-sm" name="dipo_address" id="dipo_address" placeholder="<?=lang('dipo_address')?>" />
               <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">{{ lang('pic') }}</label>
            <div class="col-lg-7">
                <input readonly type="text" class="form-control input-sm" name="dipo_pic" id="dipo_pic" placeholder="<?=lang('pic')?>" />
               <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">{{ lang('date_issued') }}</label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="date_issued" id="date_issued" placeholder="<?=lang('date_issued')?>" readonly="readonly" maxlength="10" />
            <div class="form-control-focus"> </div>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">{{ lang('receive_date') }}</label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="receive_date" id="receive_date" placeholder="<?=lang('receive_date')?>" readonly="readonly" maxlength="10" />
            <div class="form-control-focus"> </div>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">{{ lang('payment_method') }}</label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="dipo_top" id="dipo_top" placeholder="<?=lang('payment_method')?>" readonly="readonly" />
            <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">{{ lang('due_date_invoice') }}<span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="due_date" id="due_date" placeholder="<?=lang('due_date_invoice')?>" readonly="readonly" />
            <div class="form-control-focus"> </div>
            </div>
        </div>

        <hr/>

        <table id="table-surat" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
            <thead>
                <tr>
                    <th class="text-center">{{ lang('no') }}</th>
                    <th class="text-center">{{ lang('product_code') }}</th>
                    <th class="text-center">{{ lang('product_name') }}</th>
                    <th class="text-center">{{ lang('total_order_in_ctn') }}</th>
                    <th class="text-center">{{ lang('price_of_orders_per_ctn_before_tax') }}</th>
                    <th class="text-center">{{ lang('price_of_orders_per_ctn_after_tax') }}</th>
                    <th class="text-center">{{ lang('order_amount_after_tax') }}</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-center">Total</th>
                    <th><input readonly type="text" class="form-control input-sm text-center" name="view_total_order_amount_in_ctn" id="view_total_order_amount_in_ctn"/></th>
                    <th><input readonly type="text" class="form-control input-sm text-center" name="view_total_order_price_before_tax" id="view_total_order_price_before_tax"/></th>
                    <th><input readonly type="text" class="form-control input-sm text-center" name="view_total_order_price_after_tax" id="view_total_order_price_after_tax"/></th>
                    <th><input readonly type="text" class="form-control input-sm text-center" name="view_total_order_amount_after_tax" id="view_total_order_amount_after_tax"/></th>
                </tr>
            </tfoot>
        </table>
        
        <div class="row view-detail-row">
            <div class="col-md-5">
                <table id="view-detail" class="table dt-responsive">
                    <tbody>
                        <tr>
                            <th>{{ lang('note') }} :</th>
                        </tr>
                        <tr>
                            <td id="txt_note" class="text-left"></td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
            <div class="col-md-2">&nbsp;</div>
            <div class="col-md-5">
                <table id="total-value" class="table dt-responsive">
                    <tr>
                        <th colspan="2">Total Value</th>
                        <th id="total_value" class="text-right"></th>
                    </tr>
                    <tr class="text-discount">
                        <th>Reg Disc</th>
                        <th id="reg_disc" class="text-right">0%</th>
                        <th id="reg_disc_total" class="text-right">0</th>
                    </tr>
                    <tr class="border-none text-discount">
                        <th>Add Disc 1</th>
                        <th id="add_disc_1" class="text-right">0%</th>
                        <th id="add_disc_1_total" class="text-right">0</th>
                    </tr>
                    <tr class="border-none text-discount">
                        <th>Add Disc 2</th>
                        <th id="add_disc_2" class="text-right">0%</th>
                        <th id="add_disc_2_total" class="text-right">0</th>
                    </tr>
                    <tr class="border-none text-discount">
                        <th>BTW Disc</th>
                        <th id="btw_disc" class="text-right">0%</th>
                        <th id="btw_disc_total" class="text-right">0</th>
                    </tr>
                    <tr>
                        <th colspan="2">Total NIV</th>
                        <th id="total_niv" class="text-right"></th>
                    </tr>
                </table>
            </div>
        </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">{{ lang('close') }}</button>
      </div>
      {{ form_close() }}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop

@section('scripts')
<script type="text/javascript">

    var i = 1;

    $('#dipo_partner_id').change(function(){
        if($('#dipo_partner_id').val() != ""){
            $.getJSON('{{base_url()}}invoice/invoices/getDipo', {id: $('#dipo_partner_id').val()}, function(json, textStatus) {
                if(json.status == "success"){
                    var row = json.data;
                    var i;
                    var html = "";

                    $('[name="dipo_name"]').val(row.name);
                    $('[name="dipo_address"]').val(row.address);
                    $('[name="dipo_top"]').val(row.top);
                    $('[name="dipo_pic"]').val(row.pic);
                    
                }else if(json.status == "error"){
                    toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
                }
                App.unblockUI('#form-wrapper');
            });

            $.getJSON('{{base_url()}}invoice/invoices/getsjbydipo', {id: $('#dipo_partner_id').val()}, function(json, textStatus) {
                if(json.status == "success"){
                    var row = json.data;
                    var html = '<option value=""><?= lang('select_your_option') ?></option>';

                    $.each(row, function(){
                        var val_id = '';
                        var val_text = '';
                        $.each(this, function(name, value){
                            if(name == 'id')
                                val_id = value;

                            if(name == 'sj_no')
                                val_text = value;
        
                        });
                        html += '<option value="' + val_id + '">' + val_text + '</option>';
                    });

                    $('#sj_id').html(html);

                }else if(json.status == "error"){
                    toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
                }
                App.unblockUI('#form-wrapper');
            });
        }
    });

    var total_row = 0;
    $('#sj_id').change(function(){
        if($('#sj_id').val() != ""){
            $.getJSON('{{base_url()}}invoice/invoices/getsjbyid', {id: $('#sj_id').val()}, function(json, textStatus) {
                if(json.status == "success"){
                    var row = json.data;
                    var i;
                    var html = "";

                    $('[name="sp_no"]').val(row.sp_no);
                    $('[name="date_issued"]').val(formatDate(row.sp_date));
                    $('[name="receive_date"]').val(formatDate(row.sp_date));
                    $('[name="due_date"]').val(addDays(row.sp_date, parseInt($('#dipo_top').val())));

                    $.getJSON('{{base_url()}}invoice/invoices/viewdetailsj', {id: $('#sj_id').val()}, function(json, textStatus) {
                        if(json.status == "success"){
                            var rowDetail = json.dataDetail;
                            var i;
                            var html = "";
                            var dataLength = rowDetail.length;
                            var total_order = 0;
                            var total_price_before_tax = 0;
                            var total_price_after_tax = 0;
                            var total_amount_after_tax = 0;

                            $("#add-table-surat tbody").html('');

                            for(i=1; i<=dataLength; i++){
                                $("#add-table-surat tbody").append(
                                    '<tr>' +
                                        '<td class="text-center">'+
                                            '<input type="hidden" class="form-control input-sm" name="sp_detail_id[]" id="sp_detail_id_'+i+'"/>'+
                                            '<input type="hidden" class="form-control input-sm" name="pricelist_id[]" id="pricelist_id_'+i+'"/>'+
                                            '<input type="text" class="form-control input-sm" name="product_code[]" id="product_code_'+i+'" readonly/>'+
                                        '</td>' +
                                        '<td class="text-center"><input type="text" class="form-control input-sm" name="product_name[]" id="product_name_'+i+'" readonly/></td>' +
                                        '<td class="text-center"><input type="text" class="form-control input-sm" name="order_amount_in_ctn[]" id="order_amount_in_ctn_'+i+'" readonly/></td>' +
                                        '<td class="text-center"><input type="text" class="form-control input-sm" name="order_price_before_tax[]" id="order_price_before_tax_'+i+'" readonly/>' +
                                        '<td class="text-center"><input type="text" class="form-control input-sm" name="order_price_after_tax[]" id="order_price_after_tax_'+i+'" onkeyup="calcRow('+i+')" /></td>' +
                                        '<td class="text-center"><input readonly type="text" class="form-control input-sm" name="order_amount_after_tax[]" id="order_amount_after_tax_'+i+'"/></td>' +
                                    '</tr>'
                                );

                                var order = rowDetail[i-1].order_amount_in_ctn;
                                var price_after_tax = rowDetail[i-1].price_after_tax;
                                var price_before_tax = price_after_tax / 1.1;
                                var amount_after_tax = order * price_after_tax;
                                
                                $('#sp_detail_id_'+i).val(rowDetail[i-1].spdetail_id);
                                $('#pricelist_id_'+i).val(rowDetail[i-1].pricelist_id);
                                $('#product_code_'+i).val(rowDetail[i-1].product_code);
                                $('#product_name_'+i).val(rowDetail[i-1].name);
                                $('#order_amount_in_ctn_'+i).val(order);
                                $('#order_price_before_tax_'+i).val(price_before_tax.toFixed(0));
                                $('#order_price_after_tax_'+i).val(price_after_tax.toFixed(0));
                                $('#order_amount_after_tax_'+i).val(amount_after_tax.toFixed(0));

                                total_order = total_order + order;
                                total_price_before_tax = total_price_before_tax + price_before_tax;
                                total_price_after_tax = total_price_after_tax + price_after_tax;
                                total_amount_after_tax = total_amount_after_tax + amount_after_tax;

                                total_row++;
                                    
                            }

                            $('#total_order_amount_in_ctn').val(total_order);
                            $('#total_order_price_before_tax').val(total_price_before_tax.toFixed(0));
                            $('#total_order_price_after_tax').val(total_price_after_tax.toFixed(0));
                            $('#total_order_amount_after_tax').val(total_amount_after_tax.toFixed(0));

                        }else if(json.status == "error"){
                            toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
                        }
                        App.unblockUI('#form-wrapper');
                    });

                }else if(json.status == "error"){
                    toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
                }
                App.unblockUI('#form-wrapper');
            });
        }
    });

    function add_invoice(){
        $('#form-invoice')[0].reset(); 
        $('#modal_form').modal('show'); 
        $('.modal-title').text('<?=lang('tambah_invoice')?>'); 

        $('[name="invoice_id"]').val('');
        $('[name="dipo_partner_id"]').val('').change();
        $('[name="sj_id"]').val('').change();
        $("#add-table-surat tbody").html('');
        
        $('[name="invoice_no"]').attr('readonly', false);
    }
    toastr.options = { "positionClass": "toast-top-right", };

    // Pengaturan Datatable 
    var oTable =$('#table-invoice').dataTable({
        "responsive": false,
        "bProcessing": true,
        "bServerSide": true,
        "bLengthChange": true,
        "sServerMethod": "GET",
        "sAjaxSource": "{{ base_url() }}invoice/invoices/fetch_data",
        "columnDefs": [
            {"targets": [10], "orderable": false}
        ],
        "order": [0,"asc"],
    }).fnSetFilteringDelay(1000);

    // Pengaturan Form Validation 
    var form_validator = $("#form-invoice").validate({
        errorPlacement: function(error, element) {
            $(element).parent().closest('.form-group').append(error);
        },
        errorElement: "span",
        rules: {
            invoice_no: "required",
            sj_id: "required",
            dipo_partner_id: "required",
            due_date: "required",
        },
        messages: {
            invoice_no: "{{lang('invoice_no')}}" + " {{lang('not_empty')}}",
            sj_id: "{{lang('sj_no')}}" + " {{lang('not_empty')}}",
            dipo_partner_id: "{{lang('to')}}" + " {{lang('not_empty')}}",
            due_date: "{{lang('due_date_invoice')}}" + " {{lang('not_empty')}}",
        },
        submitHandler : function(form){
            App.blockUI({
                target: '#form-wrapper'
            });
            $(form).ajaxSubmit({  
                beforeSubmit:  showRequest,  
                success:       showResponse,
                url:       '{{base_url()}}invoice/invoices/save',      
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

        $.getJSON('{{base_url()}}invoice/invoices/view', {id: value}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data[0];
                var i;
                var html = "";

                $('[name="invoice_id"]').val(row.id);
                $('#dipo_partner_id').val(row.dipo_id).change();
                $('[name="invoice_no"]').val(row.invoice_no);
                $('[name="due_date"]').val(formatDate(row.due_date));
                $('[name="note"]').val(row.note);
                $('[name="dipo_name"]').val(row.dipo_name);
                $('[name="dipo_address"]').val(row.dipo_address);
                $('[name="dipo_pic"]').val(row.dipo_pic);
                $('[name="dipo_top"]').val(row.dipo_top);

                $.getJSON('{{base_url()}}invoice/invoices/getsjbyid', {id: row.sj_id}, function(json, textStatus) {
                    if(json.status == "success"){
                        var row_sj = json.data;
                        var i;
                        var html = "";
    
                        $('[name="sj_id"]').val(row.sj_id).change();
                        $('[name="sp_no"]').val(row_sj.sp_no);
                        $('[name="date_issued"]').val(formatDate(row_sj.sp_date));
                        $('[name="receive_date"]').val(formatDate(row_sj.sp_date));
                        $('[name="due_date"]').val(addDays(row_sj.sp_date, parseInt($('#dipo_top').val())));
    
                        $.getJSON('{{base_url()}}invoice/invoices/viewdetailsj', {id: row.sj_id}, function(json, textStatus) {
                            if(json.status == "success"){
                                var rowDetail = json.dataDetail;
                                var i;
                                var html = "";
                                var dataLength = rowDetail.length;
                                var total_order = 0;
                                var total_price_before_tax = 0;
                                var total_price_after_tax = 0;
                                var total_amount_after_tax = 0;
    
                                $("#add-table-surat tbody").html('');
    
                                for(i=1; i<=dataLength; i++){
                                    $("#add-table-surat tbody").append(
                                        '<tr>' +
                                            '<td class="text-center">'+
                                                '<input type="hidden" class="form-control input-sm" name="sp_detail_id[]" id="sp_detail_id_'+i+'"/>'+
                                                '<input type="hidden" class="form-control input-sm" name="pricelist_id[]" id="pricelist_id_'+i+'"/>'+
                                                '<input type="text" class="form-control input-sm" name="product_code[]" id="product_code_'+i+'" readonly/>'+
                                            '</td>' +
                                            '<td class="text-center"><input type="text" class="form-control input-sm" name="product_name[]" id="product_name_'+i+'" readonly/></td>' +
                                            '<td class="text-center"><input type="text" class="form-control input-sm" name="order_amount_in_ctn[]" id="order_amount_in_ctn_'+i+'" readonly/></td>' +
                                            '<td class="text-center"><input type="text" class="form-control input-sm" name="order_price_before_tax[]" id="order_price_before_tax_'+i+'" readonly/>' +
                                            '<td class="text-center"><input type="text" class="form-control input-sm" name="order_price_after_tax[]" id="order_price_after_tax_'+i+'" readonly/></td>' +
                                            '<td class="text-center"><input readonly type="text" class="form-control input-sm" name="order_amount_after_tax[]" id="order_amount_after_tax_'+i+'"/></td>' +
                                        '</tr>'
                                    );
    
                                    var order = rowDetail[i-1].order_amount_in_ctn;
                                    var price_after_tax = rowDetail[i-1].price_after_tax;
                                    var price_before_tax = price_after_tax / 1.1;
                                    var amount_after_tax = order * price_after_tax;
                                    
                                    $('#sp_detail_id_'+i).val(rowDetail[i-1].spdetail_id);
                                    $('#pricelist_id_'+i).val(rowDetail[i-1].pricelist_id);
                                    $('#product_code_'+i).val(rowDetail[i-1].product_code);
                                    $('#product_name_'+i).val(rowDetail[i-1].name);
                                    $('#order_amount_in_ctn_'+i).val(order);
                                    $('#order_price_before_tax_'+i).val(price_before_tax.toFixed(0));
                                    $('#order_price_after_tax_'+i).val(price_after_tax.toFixed(0));
                                    $('#order_amount_after_tax_'+i).val(amount_after_tax.toFixed(0));
    
                                    total_order = total_order + order;
                                    total_price_before_tax = total_price_before_tax + price_before_tax;
                                    total_price_after_tax = total_price_after_tax + price_after_tax;
                                    total_amount_after_tax = total_amount_after_tax + amount_after_tax;
                                }
    
                                $('#total_order_amount_in_ctn').val(total_order);
                                $('#total_order_price_before_tax').val(total_price_before_tax.toFixed(0));
                                $('#total_order_price_after_tax').val(total_price_after_tax.toFixed(0));
                                $('#total_order_amount_after_tax').val(total_amount_after_tax.toFixed(0));
    
                            }else if(json.status == "error"){
                                toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
                            }
                            App.unblockUI('#form-wrapper');
                        });
    
                    }else if(json.status == "error"){
                        toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
                    }
                    App.unblockUI('#form-wrapper');
                });
                
                $('[name="invoice_no"]').attr('readonly', true);
                $('#modal_form').modal('show');
                $('.modal-title').text('<?=lang('ubah_invoice')?>'); 

            }else if(json.status == "error"){
                toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
            }
            App.unblockUI('#form-wrapper');
       });
    }

    // Menampilkan detail data jalan
    function viewDetail(value){   
        form_validator.resetForm();
        $("html, body").animate({
            scrollTop: 0
        }, 500);
        App.blockUI({
            target: '#form-wrapper'
        });
        $.getJSON('{{base_url()}}invoice/invoices/view', {id: value}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data[0];
                var i;
                var html = "";

                $('[name="invoice_id"]').val(row.id);
                $('[name="invoice_no"]').val(row.invoice_no);
                $('[name="sj_no"]').val(row.sj_no);
                $('[name="sp_no"]').val(row.sp_no);
                $('[name="date_issued"]').val(formatDate(row.sp_date));
                $('[name="receive_date"]').val(formatDate(row.sp_date));
                $('[name="due_date"]').val(formatDate(row.due_date));
                $('[name="dipo_code"]').val(row.dipo_code);
                $('[name="dipo_name"]').val(row.dipo_name);
                $('[name="dipo_address"]').val(row.dipo_address);
                $('[name="dipo_top"]').val(row.dipo_top);
                $('[name="dipo_pic"]').val(row.dipo_pic);
                $('#txt_note').text(row.note)

                $('[name="view_total_order_amount_in_ctn"]').val(row.total_order_amount_in_ctn);
                $('[name="view_total_order_price_before_tax"]').val(row.total_order_price_before_tax.toFixed(0));
                $('[name="view_total_order_price_after_tax"]').val(row.total_order_price_after_tax.toFixed(0));
                $('[name="view_total_order_amount_after_tax"]').val(row.total_order_amount_after_tax.toFixed(0));
                
                $('#total_value').text(row.total_order_amount_after_tax.toFixed(0));
                $('#total_niv').text(row.total_order_amount_after_tax.toFixed(0));

                $('[name="invoice_no"]').attr('readonly', true);
                $('#modal_detail').modal('show');
                $('.modal-title').text('<?=lang('invoice')?>'); 
            }else if(json.status == "error"){
                toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
            }
            App.unblockUI('#form-wrapper');
       });

        //Pengaturan Datatable 
        var oTable =$('#table-surat').dataTable({
            "destroy": true,
            "responsive": false,
            "paging": false,
            "searching": false,
            "bProcessing": true,
            "bServerSide": true,
            "bLengthChange": true,
            "sServerMethod": "GET",
            "sAjaxSource": "{{ base_url() }}invoice/invoices/fetch_data_invoice/?id="+value,
            "order": [1,"asc"],
            "columnDefs": [
                {"className": "dt-center", "targets": [0, 3, 4, 5, 6]},
                {"targets": [0], "orderable": false}
            ],
        }).fnSetFilteringDelay(1000);
    }

    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [day, month, year].join('/');
    }

    function formatDate2(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [month, day, year].join('/');
    }

    function addDays(val_date, val_days){
        var tt = formatDate2(val_date);

        var date = new Date(tt);
        var newdate = new Date(date);

        newdate.setDate(newdate.getDate() + val_days);
        
        var dd = newdate.getDate();
        var mm = newdate.getMonth() + 1;
        var y = newdate.getFullYear();

        var someFormattedDate = dd + '/' + mm + '/' + y;

        return someFormattedDate;
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
                $.getJSON('{{base_url()}}invoice/invoices/delete', {id: value}, function(json, textStatus) {
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
    
    function printPdf(){
        return window.open('{{base_url()}}reports/invoice/pdf/?id='+$('[name="invoice_id"]').val());
    }

    function printExcel(){
        return window.open('{{base_url()}}reports/invoice/excel/?id='+$('[name="invoice_id"]').val());
    }

    function calcRow(row){
        var order = $('#order_amount_in_ctn_'+row).val();
        var price_after_tax = $('#order_price_after_tax_'+row).val();
        if(isNaN(price_after_tax))
            price_after_tax = 0;

        var price_before_tax = price_after_tax / 1.1;
        var amount_after_tax = order * price_after_tax;
        
        $('#order_price_before_tax_'+row).val(price_before_tax.toFixed(0));
        $('#order_amount_after_tax_'+row).val(amount_after_tax.toFixed(0));
        
        calcTotal();
    }

    function calcTotal(){

        var total_order = 0;
        var total_price_before_tax = 0;
        var total_price_after_tax = 0;
        var total_amount_after_tax = 0;

        for(i=1; i<=total_row; i++){
            
            var order = parseInt($('#order_amount_in_ctn_'+i).val());
            var price_after_tax = parseInt($('#order_price_after_tax_'+i).val());
            if(isNaN(price_after_tax))
                price_after_tax = 0;

            var price_before_tax = price_after_tax / 1.1;
            var amount_after_tax = order * price_after_tax;
            
            total_order = total_order + order;
            total_price_before_tax = total_price_before_tax + price_before_tax;
            total_price_after_tax = total_price_after_tax + price_after_tax;
            total_amount_after_tax = total_amount_after_tax + amount_after_tax;
        }

        $('#total_order_amount_in_ctn').val(total_order);
        $('#total_order_price_before_tax').val(total_price_before_tax.toFixed(0));
        $('#total_order_price_after_tax').val(total_price_after_tax.toFixed(0));
        $('#total_order_amount_after_tax').val(total_amount_after_tax.toFixed(0));

    }

    $('#modal_detail').on('hidden.bs.modal', function () {
        location.reload();
    })

    $('#modal_form').on('hidden.bs.modal', function () {
        location.reload();
    })

</script>
@stop