@extends('default.views.layouts.default')

@section('title') {{lang('surat_jalan')}} @stop

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
                <span>{{lang('surat_jalan')}}</span>
            </li>
        </ul>
        
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title"> {{lang('surat_jalan')}} </h3>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADERs-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="table-wrapper" class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-grid font-dark"></i>
                        <span class="caption-subject">{{lang('surat_jalan')}}</span>
                    </div>
                    <div class="tools">
                        @if($add_access == 1)
                            <button onclick="add_surat_jalan()" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>{{lang('tambah_surat_jalan')}}</button>
                        @endif

                        @if($print_limited_access == 1 || $print_unlimited_access == 1)
                            <!-- <button onClick="return window.open('{{base_url()}}master/suratjalan/pdf')" class="btn btn-danger btn-sm">
                                <i class="fa fa-file-pdf-o"></i> {{ lang('print_pdf') }}
                            </button>
                            <button onClick="return window.open('{{base_url()}}master/suratjalan/excel')" class="btn btn-success btn-sm">
                                <i class="fa fa-file-excel-o"></i> {{ lang('print_excel') }}
                            </button> -->
                        @endif
                    </div>
                </div>
                <div class="portlet-body">
                    <table id="table-surat-jalan" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                        <thead>
                            <tr>
                                <th class="text-center"><?=lang('sj_no')?></th>
                                <th class="text-center"><?=lang('sp_no')?></th>
                                <th class="text-center"><?=lang('customer_name')?></th>
                                <th class="text-center"><?=lang('address')?></th>
                                <th class="text-center"><?=lang('pic')?></th>
                                <th class="text-center"><?=lang('phone')?></th>
                                <th class="text-center"><?=lang('issue_date')?></th>
                                <th class="text-center"><?=lang('receive_date')?></th>
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
        <h3 class="modal-title"><?=lang('tambah_surat_jalan')?></h3>
      </div>
      {{ form_open(null,array('id' => 'form-surat-jalan', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
      <div class="modal-body">
        <input type="hidden" name="sj_id" value="">
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('account')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
               <select id="dipo_partner_id" name="dipo_partner_id" class="form-control select2">
                    <option selected disabled value=""><?=lang('select_your_option')?></option>
                    <?php
                        if (!empty($dipos)) {
                            foreach ($dipos as $c) { ?>
                            <option value="<?=$c->id?>"><?=ucfirst($c->code)?></option>
                    <?php } } ?>
                </select>  
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('sj_no')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="sj_no" id="sj_no" placeholder="<?=lang('sj_no')?>" maxlength="50" />
               <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('sp_no')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
               <select id="sp_id" name="sp_id" class="form-control">
                    <option selected disabled value=""><?=lang('select_your_option')?></option>
                </select>  
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
            <label class="col-lg-4 control-label">{{ lang('phone') }}</label>
            <div class="col-lg-7">
                <input readonly type="text" class="form-control input-sm" name="dipo_phone" id="dipo_phone" placeholder="<?=lang('phone')?>" />
               <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">{{ lang('date_issued') }}<span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="sp_date" id="sp_date" placeholder="<?=lang('date_issued')?>" readonly="readonly" maxlength="10" />
               <div class="form-control-focus"> </div>
            </div>
        </div>
        
        <table id="add-table-surat" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
            <thead>
                <tr>
                    <th class="text-center">{{ lang('product_code') }}</th>
                    <th class="text-center">{{ lang('product_name') }}</th>
                    <th class="text-center">{{ lang('total_order_in_ctn') }}</th>
                    <th class="text-center">{{ lang('volume_m3') }}</th>
                    <th class="text-center">{{ lang('weight_kg') }}</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th colspan="2" class="text-center">{{ lang('total') }}</th>
                    <th class="text-center"><input readonly type="text" class="form-control input-sm" name="total_order_amount_in_ctn" id="total_order_amount_in_ctn"/></th>
                    <th class="text-center"><input readonly type="text" class="form-control input-sm" name="total_order_volume" id="total_order_volume"/></th>
                    <th class="text-center"><input readonly type="text" class="form-control input-sm" name="total_order_weight" id="total_order_weight"/></th>
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
        <h3 class="modal-title"><?=lang('surat_jalan')?></h3>
        <button onClick="printPdf()" class="btn btn-danger btn-sm">
            <i class="fa fa-file-pdf-o"></i> {{ lang('print_pdf') }}
        </button>
        <button onClick="printExcel()" class="btn btn-success btn-sm">
            <i class="fa fa-file-excel-o"></i> {{ lang('print_excel') }}
        </button> 
      </div>
      {{ form_open(null,array('id' => 'form-suratpesanan-view', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
      <div class="modal-body">
        <input type="hidden" name="sj_id" value="">
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('account')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input readonly type="text" class="form-control input-sm" name="dipo_code" id="dipo_code" placeholder="<?=lang('dipo_code')?>" />
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
            <label class="col-lg-4 control-label">{{ lang('phone') }}</label>
            <div class="col-lg-7">
                <input readonly type="text" class="form-control input-sm" name="dipo_phone" id="dipo_phone" placeholder="<?=lang('phone')?>" />
               <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">{{ lang('date_issued') }}<span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="sp_date" id="sp_date" placeholder="<?=lang('date_issued')?>" readonly="readonly" maxlength="10" />
               <div class="form-control-focus"> </div>
            </div>
        </div>

        <table id="table-surat" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
            <thead>
                <tr>
                    <th class="text-center">{{ lang('no') }}</th>
                    <th class="text-center">{{ lang('product_code') }}</th>
                    <th class="text-center">{{ lang('product_name') }}</th>
                    <th class="text-center">{{ lang('total_order_in_ctn') }}</th>
                    <th class="text-center">{{ lang('volume_m3') }}</th>
                    <th class="text-center">{{ lang('weight_kg') }}</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-center">Total</th>
                    <th><input readonly type="text" class="form-control input-sm text-center" name="view_total_order_amount_in_ctn" id="view_total_order_amount_in_ctn"/></th>
                    <th><input readonly type="text" class="form-control input-sm text-center" name="view_total_order_volume" id="view_total_order_volume"/></th>
                    <th><input readonly type="text" class="form-control input-sm text-center" name="view_total_order_weight" id="view_total_order_weight"/></th>
                </tr>
            </tfoot>
        </table>
        
        <div class="row view-detail-row">
            <div class="col-md-5">
                <table id="view-detail" class="table dt-responsive">
                    <tbody>
                        <tr>
                            <th>Tanggal permintaan pengiriman barang :</th>
                        </tr>
                        <tr>
                            <th id="tanggal_pengiriman" class="text-right"></th>
                        </tr>
                        <tr>
                            <th>Tanggal penerimaan barang :</th>
                        </tr>
                        <tr>
                            <th id="tanggal_penerimaan" class="text-right"></th>
                        </tr>
                    </tbody>
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
        $.getJSON('{{base_url()}}suratjalan/suratjalans/getDipo', {id: $('#dipo_partner_id').val()}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data;
                var i;
                var html = "";

                $('[name="dipo_name"]').val(row.name);
                $('[name="dipo_address"]').val(row.address);
                $('[name="dipo_pic"]').val(row.pic);
                $('[name="dipo_phone"]').val(row.phone);
                // $('[name="sp_date"]').focus();

            }else if(json.status == "error"){
                toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
            }
            App.unblockUI('#form-wrapper');
        });

        $.getJSON('{{base_url()}}suratjalan/suratjalans/getspbydipo', {id: $('#dipo_partner_id').val()}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data;
                var html = '<option value=""><?= lang('select_your_option') ?></option>';

                $.each(row, function(){
                    var val_id = '';
                    var val_text = '';
                    $.each(this, function(name, value){
                        if(name == 'id')
                            val_id = value;

                        if(name == 'sp_no')
                            val_text = value;
    
                    });
                    html += '<option value="' + val_id + '">' + val_text + '</option>';
                });

                $('#sp_id').html(html);

            }else if(json.status == "error"){
                toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
            }
            App.unblockUI('#form-wrapper');
        });
    });

    $('#sp_id').change(function(){
        if($('#sp_id').val() != ""){
            $.getJSON('{{base_url()}}suratjalan/suratjalans/getspbyid', {id: $('#sp_id').val()}, function(json, textStatus) {
                if(json.status == "success"){
                    var row = json.data;
                    var i;
                    var html = "";

                    $('[name="sp_date"]').val(formatDate(row.sp_date));


                    $.getJSON('{{base_url()}}suratjalan/suratjalans/viewdetailsp', {id: $('#sp_id').val()}, function(json, textStatus) {
                        if(json.status == "success"){
                            var rowDetail = json.dataDetail;
                            var i;
                            var html = "";
                            var dataLength = rowDetail.length;
                            var total_order = 0;
                            var total_volume = 0;
                            var total_weight = 0;

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
                                        '<td class="text-center"><input type="text" class="form-control input-sm" name="order_volume[]" id="order_volume_'+i+'" readonly/>' +
                                        '<td class="text-center"><input type="text" class="form-control input-sm" name="order_weight[]" id="order_weight_'+i+'" readonly/></td>' +
                                    '</tr>'
                                );

                                var order = rowDetail[i-1].order_amount_in_ctn;
                                var volume = order * rowDetail[i-1].volume;
                                var weight = volume * rowDetail[i-1].weight;
                                $('#sp_detail_id_'+i).val(rowDetail[i-1].spdetail_id);
                                $('#pricelist_id_'+i).val(rowDetail[i-1].pricelist_id);
                                $('#product_code_'+i).val(rowDetail[i-1].product_code);
                                $('#product_name_'+i).val(rowDetail[i-1].name);
                                $('#order_amount_in_ctn_'+i).val(order);
                                $('#order_volume_'+i).val(volume.toFixed(2));
                                $('#order_weight_'+i).val(weight.toFixed(2));

                                total_order = total_order + order;
                                total_volume = total_volume + volume;
                                total_weight = total_weight + weight;
                            }

                            $('#total_order_amount_in_ctn').val(total_order);
                            $('#total_order_volume').val(total_volume.toFixed(2));
                            $('#total_order_weight').val(total_weight.toFixed(2));

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

    function add_surat_jalan(){
        $('#form-surat-jalan')[0].reset(); 
        $('#modal_form').modal('show'); 
        $('.modal-title').text('<?=lang('tambah_surat_jalan')?>'); 

        $('[name="sj_id"]').val('');
        $('[name="dipo_partner_id"]').val('').change();
        $('[name="sj_no"]').attr('readonly', false);
    }
    toastr.options = { "positionClass": "toast-top-right", };

    // Pengaturan Datatable 
    var oTable =$('#table-surat-jalan').dataTable({
        "responsive": false,
        "bProcessing": true,
        "bServerSide": true,
        "bLengthChange": true,
        "sServerMethod": "GET",
        "sAjaxSource": "{{ base_url() }}suratjalan/suratjalans/fetch_data",
        "columnDefs": [
            {"targets": [9], "orderable": false}
        ],
        "order": [0,"asc"],
    }).fnSetFilteringDelay(1000);

    // Pengaturan Form Validation 
    var form_validator = $("#form-surat-jalan").validate({
        errorPlacement: function(error, element) {
            $(element).parent().closest('.form-group').append(error);
        },
        errorElement: "span",
        rules: {
            sj_no: "required",
            sp_id: "required",
            dipo_partner_id: "required",
            sp_date: "required",
        },
        messages: {
            sj_no: "{{lang('sj_no')}}" + " {{lang('not_empty')}}",
            sp_id: "{{lang('sp_no')}}" + " {{lang('not_empty')}}",
            dipo_partner_id: "{{lang('account')}}" + " {{lang('not_empty')}}",
            sp_date: "{{lang('date_issued')}}" + " {{lang('not_empty')}}",
        },
        submitHandler : function(form){
            App.blockUI({
                target: '#form-wrapper'
            });
            $(form).ajaxSubmit({  
                beforeSubmit:  showRequest,  
                success:       showResponse,
                url:       '{{base_url()}}suratjalan/suratjalans/save',      
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

        $.getJSON('{{base_url()}}suratjalan/suratjalans/view', {id: value}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data[0];
                var i;
                var html = "";

                $('[name="sj_id"]').val(row.id);
                $('#dipo_partner_id').val(row.dipo_id).change();
                $('[name="sj_no"]').val(row.sj_no);
                $('[name="dipo_name"]').val(row.dipo_name);
                $('[name="dipo_address"]').val(row.dipo_address);
                $('[name="dipo_pic"]').val(row.dipo_pic);
                $('[name="dipo_phone"]').val(row.dipo_phone);

                $.getJSON('{{base_url()}}suratjalan/suratjalans/getspbyid', {id: row.sp_id}, function(json, textStatus) {
                    if(json.status == "success"){
                        var row_sp = json.data;
                        var i;
                        var html = "";

                        $('[name="sp_id"]').val(row.sp_id);
                        $('[name="sp_date"]').val(formatDate(row_sp.sp_date));

                        $.getJSON('{{base_url()}}suratjalan/suratjalans/viewdetailsp', {id: row.sp_id}, function(json, textStatus) {
                            if(json.status == "success"){
                                var rowDetail = json.dataDetail;
                                var i;
                                var html = "";
                                var dataLength = rowDetail.length;
                                var total_order = 0;
                                var total_volume = 0;
                                var total_weight = 0;

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
                                            '<td class="text-center"><input type="text" class="form-control input-sm" name="order_volume[]" id="order_volume_'+i+'" readonly/>' +
                                            '<td class="text-center"><input type="text" class="form-control input-sm" name="order_weight[]" id="order_weight_'+i+'" readonly/></td>' +
                                        '</tr>'
                                    );

                                    var order = rowDetail[i-1].order_amount_in_ctn;
                                    var volume = order * rowDetail[i-1].volume;
                                    var weight = volume * rowDetail[i-1].weight;
                                    $('#sp_detail_id_'+i).val(rowDetail[i-1].spdetail_id);
                                    $('#pricelist_id_'+i).val(rowDetail[i-1].pricelist_id);
                                    $('#product_code_'+i).val(rowDetail[i-1].product_code);
                                    $('#product_name_'+i).val(rowDetail[i-1].name);
                                    $('#order_amount_in_ctn_'+i).val(order);
                                    $('#order_volume_'+i).val(volume.toFixed(2));
                                    $('#order_weight_'+i).val(weight.toFixed(2));

                                    total_order = total_order + order;
                                    total_volume = total_volume + volume;
                                    total_weight = total_weight + weight;
                                }

                                $('#total_order_amount_in_ctn').val(total_order);
                                $('#total_order_volume').val(total_volume.toFixed(2));
                                $('#total_order_weight').val(total_weight.toFixed(2));

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
                
                $('[name="sj_no"]').attr('readonly', true);
                $('#modal_form').modal('show');
                $('.modal-title').text('<?=lang('ubah_surat_jalan')?>'); 

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
        $.getJSON('{{base_url()}}suratjalan/suratjalans/view', {id: value}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data[0];
                var i;
                var html = "";

                $('[name="sj_id"]').val(row.id);
                $('[name="sj_no"]').val(row.sj_no);
                $('[name="sp_no"]').val(row.sp_no);
                $('[name="dipo_code"]').val(row.dipo_code);
                $('[name="dipo_name"]').val(row.dipo_name);
                $('[name="dipo_address"]').val(row.dipo_address);
                $('[name="dipo_pic"]').val(row.dipo_pic);
                $('[name="dipo_phone"]').val(row.dipo_phone);
                $('[name="sp_date"]').val(formatDate(row.sp_date));

                $('[name="view_total_order_amount_in_ctn"]').val(row.total_order_amount_in_ctn);
                $('[name="view_total_order_volume"]').val(row.total_order_volume.toFixed(2));
                $('[name="view_total_order_weight"]').val(row.total_order_weight.toFixed(2));
                $('#tanggal_pengiriman').text(formatDate(row.sp_date))
                $('#tanggal_penerimaan').text(formatDate(row.sp_date))

                $('[name="sj_no"]').attr('readonly', true);
                $('#modal_detail').modal('show');
                $('.modal-title').text('<?=lang('surat_jalan')?>'); 
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
            "sAjaxSource": "{{ base_url() }}suratjalan/suratjalans/fetch_data_jalan/?id="+value,
            "order": [1,"asc"],
            "columnDefs": [
                {"className": "dt-center", "targets": [0, 3, 4, 5]},
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
                $.getJSON('{{base_url()}}suratjalan/suratjalans/delete', {id: value}, function(json, textStatus) {
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
        return window.open('{{base_url()}}reports/suratjalan/pdf/?id='+$('[name="sj_id"]').val())
    }

    function printExcel(){
        return window.open('{{base_url()}}reports/suratjalan/excel/?id='+$('[name="sj_id"]').val())
    }

</script>
@stop