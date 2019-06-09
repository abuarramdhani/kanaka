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
                            <button onClick="return window.open('{{base_url()}}master/suratjalan/pdf')" class="btn btn-danger btn-sm">
                                <i class="fa fa-file-pdf-o"></i> {{ lang('print_pdf') }}
                            </button>
                            <button onClick="return window.open('{{base_url()}}master/suratjalan/excel')" class="btn btn-success btn-sm">
                                <i class="fa fa-file-excel-o"></i> {{ lang('print_excel') }}
                            </button>
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
        <h3><?=lang('tambah_surat_jalan')?></h3>
      </div>
      {{ form_open(null,array('id' => 'form-surat-jalan', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
      <div class="modal-body">
        <input type="hidden" name="sp_id" value="">
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('account')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
               <select id="dipo_partner_id" name="dipo_partner_id" class="form-control">
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
               <select id="sp_no" name="sp_no" class="form-control">
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
            <label class="col-lg-4 control-label">Tanggal<span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="sp_date" id="sp_date" placeholder="<?=lang('sp_date')?>" readonly="readonly" maxlength="10" />
               <div class="form-control-focus"> </div>
            </div>
        </div>
        
        <button type="button" class="btn_add_row"><i class="fa fa-plus"></i>Add Row</button>
        <button type="button" class="btn_add_row_edit"><i class="fa fa-plus"></i>Add Row</button>
        <table id="add-table-surat" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
            <thead>
                <tr>
                    <th class="text-center">{{ lang('product_code') }</th>
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
                    <th class="text-center"><input readonly type="text" class="form-control input-sm" name="total_volume" id="total_volume"/></th>
                    <th class="text-center"><input readonly type="text" class="form-control input-sm" name="total_weight" id="total_weight"/></th>
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

<select id="pricelist_id_tmp" name="pricelist_id_tmp" class="form-control" style="display:none;">
    <option selected disabled value="">{{ lang('select_your_option') }}</option>
    @if (!empty($pricelists))
        @foreach ($pricelists as $c) {
            <option value="{{ $c->id }}">{{ ucfirst($c->product_code) }}</option>
        @endforeach
    @endif
</select> 

<div class="modal fade" id="modal_detail" role="dialog">
  <div class="modal-dialog" style="width:70%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3><?=lang('surat_jalan')?></h3>
      </div>
      {{ form_open(null,array('id' => 'form-surat-jalan-view', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
      <div class="modal-body">
        <input type="hidden" name="id_pesanan" value="">
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Kepada</label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="principle_code" id="principle_code" placeholder="<?=lang('principle_code')?>" maxlength="50" />
                <input type="text" class="form-control input-sm" name="principle_address" id="principle_address" placeholder="<?=lang('principle_address')?>" />
               <div class="form-control-focus"> </div>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('sp_no')?></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="sp_no" id="sp_no" placeholder="<?=lang('sp_no')?>" maxlength="50" />
               <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('ship_to')?></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="dipo_name" id="dipo_name" placeholder="<?=lang('dipo_name')?>" maxlength="50" />
               <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Alamat</label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="dipo_address" id="dipo_address" placeholder="<?=lang('dipo_address')?>" />
               <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Tanggal</label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="sp_date" id="sp_date" placeholder="<?=lang('sp_date')?>" maxlength="10" />
               <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Metode Pembayaran</label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="metode_pembayaran" id="metode_pembayaran" placeholder="Metode Pembayaran" maxlength="50" />
               <div class="form-control-focus"> </div>
            </div>
        </div>

        <table id="table-surat" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
            <thead>
                <tr>
                    <th class="text-center">Kode Produk</th>
                    <th class="text-center">Nama Produk</th>
                    <th class="text-center">Jumlah Pesanan (Per Karton)</th>
                    <th class="text-center">Harga Pesanan (Per Karton) Before Tax</th>
                    <th class="text-center">Harga Pesanan (Per Karton) After Tax</th>
                    <!-- <th class="text-center">Jumlah Pesanan After Tax</th> -->
                </tr>
            </thead>
        </table>

      </div>
      <div class="modal-footer">
      </div>
      {{ form_close() }}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop

@section('scripts')
<script type="text/javascript">

    // $('#pricelist_id').change(function(){
    //     $.getJSON('{{base_url()}}suratjalan/suratjalans/getPricelist', {id: $('#pricelist_id').val()}, function(json, textStatus) {
    //         if(json.status == "success"){
    //             var row = json.data[0];
    //             var i;
    //             var html = "";

    //             $('[name="product_name"]').val(row.name);
    //             $('[name="order_price_before_tax"]').val(row.company_before_tax_ctn);
    //             $('[name="order_price_after_tax"]').val(row.company_after_tax_ctn);
    //             $('[name="order_amount_in_ctn"]').focus();

    //         }else if(json.status == "error"){
    //             toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
    //         }
    //         App.unblockUI('#form-wrapper');
    //    });
    // });

    var i = 1;

    $('.btn_add_row').show();
    $('.btn_add_row_edit').hide();
    $('.btn_add_row').click(function(){
        $("#add-table-surat tbody").append(
            '<tr>' +
                '<td class="text-center">'+
                    '<select onchange="getProduct('+i+')" id="pricelist_id_'+i+'" name="pricelist_id[]" class="form-control"></select> '+
                '</td>' +
                '<td class="text-center"><input readonly type="text" class="form-control input-sm" name="product_name[]" id="product_name_'+i+'"/></td>' +
                '<td class="text-center"><input onchange="get_total('+i+')" type="text" class="form-control input-sm" name="order_amount_in_ctn[]" id="order_amount_in_ctn_'+i+'"/></td>' +
                '<td class="text-center"><input readonly type="text" class="form-control input-sm" name="order_volume[]" id="order_volume_'+i+'"/>' +
                '<td class="text-center"><input readonly type="text" class="form-control input-sm" name="order_weight[]" id="order_weight_'+i+'"/></td>' +
            '</tr>'
        );
        $('#pricelist_id_'+i).html($('#pricelist_id_tmp').html());
        i++;
    });

    function get_total(x){
        var amount = $('#order_amount_in_ctn_'+x).val();
        var volume = $('#order_volume_'+x).val();

        var voume_total = amount*volume;

        $('#order_volume_'+x).val(voume_total);
        
        var total_order_amount_in_ctn = 0;
        var total_order_price_before_tax = 0;
        var total_order_price_after_tax = 0;
        var total_order_amount_after_tax = 0;
        for (var y = 1; y < i; y++) {
            total_order_amount_in_ctn = parseInt($('#order_amount_in_ctn_'+y).val()) + parseInt(total_order_amount_in_ctn);
            total_order_price_before_tax = parseInt($('#order_price_before_tax_'+y).val()) + parseInt(total_order_price_before_tax);
            total_order_price_after_tax = parseInt($('#order_price_after_tax_'+y).val()) + parseInt(total_order_price_after_tax);
            total_order_amount_after_tax = parseInt($('#order_amount_after_tax_'+y).val()) + parseInt(total_order_amount_after_tax);
        } 

        $('#total_order_amount_in_ctn').val(total_order_amount_in_ctn);
        $('#total_order_price_before_tax').val(total_order_price_before_tax);
        $('#total_order_price_after_tax').val(total_order_price_after_tax);
        $('#total_order_amount_after_tax').val(total_order_amount_after_tax);
    }

    function getProduct(x){
        $.getJSON('{{base_url()}}suratjalan/suratjalans/getPricelist', {id: $('#pricelist_id_'+x).val()}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data[0];
                var i;
                var html = "";

                $('#product_name_'+x).val(row.name);
                $('#order_price_before_tax_'+x).val(row.company_before_tax_ctn);
                $('#order_price_after_tax_'+x).val(row.company_after_tax_ctn);
                $('#order_amount_in_ctn_'+x).focus();

            }else if(json.status == "error"){
                toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
            }
            App.unblockUI('#form-wrapper');
       });
    }

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

                $('#sp_no').html(html);

            }else if(json.status == "error"){
                toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
            }
            App.unblockUI('#form-wrapper');
        });
    });

    $('#sp_no').change(function(){
        $.getJSON('{{base_url()}}suratjalan/suratjalans/getspbyid', {id: $('#sp_no').val()}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data;
                var i;
                var html = "";

                $('[name="sp_date"]').val(row.sp_date);

            }else if(json.status == "error"){
                toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
            }
            App.unblockUI('#form-wrapper');
        });
    });

    function add_surat_jalan(){
        $('#form-surat-jalan')[0].reset(); 
        $('#modal_form').modal('show'); 
        $('.modal-title').text('<?=lang('tambah_surat_jalan')?>'); 

        $('[name="id"]').val('');
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
            {"className": "dt-center", "targets": [5]},
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
            sp_no: "required",
            dipo_partner_id: "required",
            sp_date: "required",
            pricelist_id: "required",
            order_amount_in_ctn: "required",
        },
        messages: {
            sp_no: "{{lang('sp_no')}}" + " {{lang('not_empty')}}",
            dipo_partner_id: "{{lang('dipo')}}" + " {{lang('not_empty')}}",
            sp_date: "{{lang('sp_date')}}" + " {{lang('not_empty')}}",
            pricelist_id: "{{lang('product_code')}}" + " {{lang('not_empty')}}",
            order_amount_in_ctn: "Jumlah Pesanan (Per Karton)" + " {{lang('not_empty')}}",
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

    function get_total_edit(x){
        var amount = $('#order_amount_in_ctn_'+x).val();
        var price = $('#order_price_after_tax_'+x).val();

        var total = amount*price;

        $('#order_amount_after_tax_'+x).val(total);
        
        var total_order_amount_in_ctn = 0;
        var total_order_price_before_tax = 0;
        var total_order_price_after_tax = 0;
        var total_order_amount_after_tax = 0;
        
        for (var y = 1; y < x+1; y++) {
            total_order_amount_in_ctn = parseInt($('#order_amount_in_ctn_'+y).val()) + parseInt(total_order_amount_in_ctn);
            total_order_price_before_tax = parseInt($('#order_price_before_tax_'+y).val()) + parseInt(total_order_price_before_tax);
            total_order_price_after_tax = parseInt($('#order_price_after_tax_'+y).val()) + parseInt(total_order_price_after_tax);
            total_order_amount_after_tax = parseInt($('#order_amount_after_tax_'+y).val()) + parseInt(total_order_amount_after_tax);
        } 

        $('#total_order_amount_in_ctn').val(total_order_amount_in_ctn);
        $('#total_order_price_before_tax').val(total_order_price_before_tax);
        $('#total_order_price_after_tax').val(total_order_price_after_tax);
        $('#total_order_amount_after_tax').val(total_order_amount_after_tax);
    }
   
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
                var rowDetail = json.dataDetail;
                var i;
                var html = "";
                var dataLength = rowDetail.length;

                $('[name="sp_id"]').val(row.id);
                $('#dipo_partner_id').val(row.dipo_id);
                $('[name="principle_code"]').val(row.principle_code);
                $('[name="principle_address"]').val(row.principle_address);
                $('[name="principle_pic"]').val(row.principle_pic);
                $('[name="sp_no"]').val(row.sp_no);
                $('[name="dipo_name"]').val(row.dipo_name);
                $('[name="dipo_address"]').val(row.dipo_address);
                $('[name="sp_date"]').val(row.sp_date);

                for(i=1; i<=dataLength; i++){
                    $("#add-table-surat tbody").append(
                        '<tr>' +
                            '<td class="text-center">'+
                                '<input type="hidden" class="form-control input-sm" name="sp_detail_id[]" id="sp_detail_id_'+i+'"/>'+
                                '<select onchange="getProduct('+i+')" id="pricelist_id_'+i+'" name="pricelist_id[]" class="form-control"></select> '+
                            '</td>' +
                            '<td class="text-center"><input type="text" class="form-control input-sm" name="product_name[]" id="product_name_'+i+'"/></td>' +
                            '<td class="text-center"><input onchange="get_total_edit('+i+')" type="text" class="form-control input-sm" name="order_amount_in_ctn[]" id="order_amount_in_ctn_'+i+'"/></td>' +
                            '<td class="text-center"><input type="text" class="form-control input-sm" name="order_price_before_tax[]" id="order_price_before_tax_'+i+'"/>' +
                            '<td class="text-center"><input type="text" class="form-control input-sm" name="order_price_after_tax[]" id="order_price_after_tax_'+i+'"/></td>' +
                            '<td class="text-center"><input type="text" class="form-control input-sm" name="order_amount_after_tax[]" id="order_amount_after_tax_'+i+'"/></td>' +
                        '</tr>'
                    );
                    $('#pricelist_id_'+i).html($('#pricelist_id_tmp').html());

                    $('#sp_detail_id_'+i).val(rowDetail[i-1].spdetail_id);
                    $('#product_name_'+i).val(rowDetail[i-1].name);
                    $('#order_price_before_tax_'+i).val(rowDetail[i-1].company_before_tax_ctn);
                    $('#order_price_after_tax_'+i).val(rowDetail[i-1].company_after_tax_ctn);
                    $('#order_amount_in_ctn_'+i).val(rowDetail[i-1].order_amount_in_ctn);
                    $('#order_amount_after_tax_'+i).val(rowDetail[i-1].order_amount_after_tax);
                    $('#pricelist_id_'+i).val(rowDetail[i-1].pricelist_id);
                    $('#total_order_amount_in_ctn').val(row.total_order_amount_in_ctn);
                    $('#total_order_price_before_tax').val(row.total_order_price_before_tax);
                    $('#total_order_price_after_tax').val(row.total_order_price_after_tax);
                    $('#total_order_amount_after_tax').val(row.total_order_amount_after_tax);
                }

                $('.btn_add_row_edit').show();
                $('.btn_add_row').hide();
                var z = dataLength+1;

                $('.btn_add_row_edit').click(function(){
                    $("#add-table-surat tbody").append(
                        '<tr>' +
                            '<td class="text-center">'+
                                '<input type="hidden" class="form-control input-sm" name="sp_detail_id[]" id="sp_detail_id_'+i+'"/>'+
                                '<select onchange="getProduct('+z+')" id="pricelist_id_'+z+'" name="pricelist_id[]" class="form-control"></select> '+
                            '</td>' +
                            '<td class="text-center"><input type="text" class="form-control input-sm" name="product_name[]" id="product_name_'+z+'"/></td>' +
                            '<td class="text-center"><input onchange="get_total_edit('+z+')" type="text" class="form-control input-sm" name="order_amount_in_ctn[]" id="order_amount_in_ctn_'+z+'"/></td>' +
                            '<td class="text-center"><input type="text" class="form-control input-sm" name="order_price_before_tax[]" id="order_price_before_tax_'+z+'"/>' +
                            '<td class="text-center"><input type="text" class="form-control input-sm" name="order_price_after_tax[]" id="order_price_after_tax_'+z+'"/></td>' +
                            '<td class="text-center"><input type="text" class="form-control input-sm" name="order_amount_after_tax[]" id="order_amount_after_tax_'+z+'"/></td>' +
                        '</tr>'
                    );
                    $('#pricelist_id_'+z).html($('#pricelist_id_tmp').html());
                    z++;
                });

                $('#modal_form').modal('show');
                $('.modal-title').text('<?=lang('edit_suratjalan')?>'); 

            }else if(json.status == "error"){
                toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
            }
            App.unblockUI('#form-wrapper');
       });
    }

    // Menampilkan detail data pesanan
    function viewDetail(value){   
        form_validator.resetForm();
        $("html, body").animate({
            scrollTop: 0
        }, 500);
        App.blockUI({
            target: '#form-wrapper'
        });
        $.getJSON('{{base_url()}}suratjalan/suratjalans/viewDetail', {id: value}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data[0];
                var i;
                var html = "";

                $('[name="id_pesanan"]').val(row.id);
                $('[name="principle_code"]').val(row.principle_code);
                $('[name="principle_address"]').val(row.principle_address);
                $('[name="sp_no"]').val(row.sp_no);
                $('[name="dipo_name"]').val(row.dipo_name);
                $('[name="dipo_address"]').val(row.dipo_address);
                $('[name="sp_date"]').val(row.sp_date);

                $('#modal_detail').modal('show');
                $('.modal-title').text('<?=lang('edit_suratjalan')?>'); 
            }else if(json.status == "error"){
                toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
            }
            App.unblockUI('#form-wrapper');
       });

        //Pengaturan Datatable 
        var oTable =$('#table-surat').dataTable({
            "responsive": false,
            "paging": false,
            "searching": false,
            "bProcessing": true,
            "bServerSide": true,
            "bLengthChange": true,
            "sServerMethod": "GET",
            "sAjaxSource": "{{ base_url() }}suratjalan/suratjalans/fetch_data_pesanan/?id="+value,
            "order": [0,"asc"],
        }).fnSetFilteringDelay(1000);
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
</script>
@stop