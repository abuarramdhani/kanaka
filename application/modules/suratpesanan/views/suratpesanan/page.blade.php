@extends('default.views.layouts.default')

@section('title') {{lang('surat_pesanan')}} @stop

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
                <span>{{lang('surat_pesanan')}}</span>
            </li>
        </ul>
        
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title"> {{lang('surat_pesanan')}} </h3>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADERs-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="table-wrapper" class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-grid font-dark"></i>
                        <span class="caption-subject">{{lang('surat_pesanan')}}</span>
                    </div>
                    <div class="tools">
                        @if($add_access == 1)
                            <button onclick="add_suratpesanan()" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>{{lang('tambah_surat_pesanan')}}</button>
                        @endif

                        @if($print_limited_access == 1 || $print_unlimited_access == 1)
                            <button onClick="return window.open('{{base_url()}}master/suratpesanan/pdf')" class="btn btn-danger btn-sm">
                                <i class="fa fa-file-pdf-o"></i> {{ lang('print_pdf') }}
                            </button>
                            <button onClick="return window.open('{{base_url()}}master/suratpesanan/excel')" class="btn btn-success btn-sm">
                                <i class="fa fa-file-excel-o"></i> {{ lang('print_excel') }}
                            </button>
                        @endif
                    </div>
                </div>
                <div class="portlet-body">
                    <table id="table-pesanan" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                        <thead>
                            <tr>
                                <th class="text-center"><?=lang('no_sp')?></th>
                                <th class="text-center"><?=lang('principle_code')?></th>
                                <th class="text-center"><?=lang('principle_address')?></th>
                                <th class="text-center"><?=lang('principle_pic')?></th>
                                <th class="text-center"><?=lang('dipo_name')?></th>
                                <th class="text-center"><?=lang('dipo_address')?></th>
                                <th class="text-center"><?=lang('sp_date')?></th>
                                <th class="text-center"><?=lang('created_date')?></th>
                                <th width="25%"><?=lang('options')?></th>
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
        <h3><?=lang('new_data')?></h3>
      </div>
      {{ form_open(null,array('id' => 'form-suratpesanan', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
      <div class="modal-body">
        <input type="hidden" name="sp_id" value="">
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Kepada<span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <select id="principle_id" name="principle_id" class="form-control">
                    <option selected disabled value=""><?=lang('select')?> <?=lang('principle_code')?></option>
                    <?php
                        if (!empty($principles)) {
                            foreach ($principles as $c) { ?>
                            <option value="<?=$c->id?>"><?=ucfirst($c->code)?></option>
                    <?php } } ?>
                </select>  
                <input readonly type="text" class="form-control input-sm" name="principle_address" id="principle_address" placeholder="<?=lang('principle_address')?>" />
                <input readonly type="text" class="form-control input-sm" name="principle_pic" id="principle_pic" placeholder="<?=lang('principle_pic')?>" />
                <div class="form-control-focus"> </div>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('no_sp')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="no_sp" id="no_sp" placeholder="<?=lang('no_sp')?>" maxlength="50" />
               <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('ship_to')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
               <select id="dipo_partner_id" name="dipo_partner_id" class="form-control">
                    <option selected disabled value=""><?=lang('select')?> <?=lang('dipo_code')?></option>
                    <?php
                        if (!empty($dipos)) {
                            foreach ($dipos as $c) { ?>
                            <option value="<?=$c->id?>"><?=ucfirst($c->code)?></option>
                    <?php } } ?>
                </select>  
                <input readonly type="text" class="form-control input-sm" name="dipo_name" id="dipo_name" placeholder="<?=lang('dipo_name')?>" />
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Alamat</label>
            <div class="col-lg-7">
                <input readonly type="text" class="form-control input-sm" name="dipo_address" id="dipo_address" placeholder="<?=lang('dipo_address')?>" />
               <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Tanggal<span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="sp_date" id="sp_date" placeholder="<?=lang('sp_date')?>" maxlength="50" />
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
        
        <button type="button" class="btn_add_row"><i class="fa fa-plus"></i>Add Row</button>
        <button type="button" class="btn_add_row_edit"><i class="fa fa-plus"></i>Add Row</button>
        <table id="add-table-surat" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
            <thead>
                <tr>
                    <!-- <th class="text-center">Option</th> -->
                    <th class="text-center">Kode Produk</th>
                    <th class="text-center">Nama Produk</th>
                    <th class="text-center">Jumlah Pesanan (Per Karton)</th>
                    <th class="text-center">Harga Pesanan (Per Karton) Before Tax</th>
                    <th class="text-center">Harga Pesanan (Per Karton) After Tax</th>
                    <th class="text-center">Jumlah Pesanan After Tax</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2" class="text-center">Total</th>
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

<select id="pricelist_id_tmp" name="pricelist_id_tmp" class="form-control" style="display:none;">
    <option selected disabled value=""><?=lang('select')?> <?=lang('product_code')?></option>
    <?php
        if (!empty($pricelists)) {
            foreach ($pricelists as $c) { ?>
            <option value="<?=$c->id?>"><?=ucfirst($c->product_code)?></option>
    <?php } } ?>
</select> 

<div class="modal fade" id="modal_detail" role="dialog">
  <div class="modal-dialog" style="width:70%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3><?=lang('surat_pesanan')?></h3>
      </div>
      {{ form_open(null,array('id' => 'form-suratpesanan-view', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
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
            <label class="col-lg-4 control-label"><?=lang('no_sp')?></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="no_sp" id="no_sp" placeholder="<?=lang('no_sp')?>" maxlength="50" />
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
                <input type="text" class="form-control input-sm" name="sp_date" id="sp_date" placeholder="<?=lang('sp_date')?>" maxlength="50" />
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
                    <th class="text-center">No</th>
                    <th class="text-center">Kode Produk</th>
                    <th class="text-center">Nama Produk</th>
                    <th class="text-center">Jumlah Pesanan (Per Karton)</th>
                    <th class="text-center">Harga Pesanan (Per Karton) Before Tax</th>
                    <th class="text-center">Harga Pesanan (Per Karton) After Tax</th>
                    <th class="text-center">Jumlah Pesanan After Tax</th>
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
                            <th>Tanggal permintaan pengiriman barang :</th>
                        </tr>
                        <tr>
                            <th colspan="2" id="tanggal_pengiriman" class="text-right"></th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-2">
            </div>
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
      </div>
      {{ form_close() }}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop

@section('scripts')
<script type="text/javascript">

    $('#sp_date').datepicker();

    $('#pricelist_id').change(function(){
        $.getJSON('{{base_url()}}suratpesanan/suratpesanans/getPricelist', {id: $('#pricelist_id').val()}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data[0];
                var i;
                var html = "";

                $('[name="product_name"]').val(row.name);
                $('[name="order_price_before_tax"]').val(row.company_before_tax_ctn);
                $('[name="order_price_after_tax"]').val(row.company_after_tax_ctn);
                $('[name="order_amount_in_ctn"]').focus();

            }else if(json.status == "error"){
                toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
            }
            App.unblockUI('#form-wrapper');
       });
    });

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
                '<td class="text-center"><input readonly type="text" class="form-control input-sm" name="order_price_before_tax[]" id="order_price_before_tax_'+i+'"/>' +
                '<td class="text-center"><input readonly type="text" class="form-control input-sm" name="order_price_after_tax[]" id="order_price_after_tax_'+i+'"/></td>' +
                '<td class="text-center"><input readonly type="text" class="form-control input-sm" name="order_amount_after_tax[]" id="order_amount_after_tax_'+i+'"/></td>' +
            '</tr>'
        );
        $('#pricelist_id_'+i).html($('#pricelist_id_tmp').html());
        i++;
    });

    function get_total(x){
        var amount = $('#order_amount_in_ctn_'+x).val();
        var price = $('#order_price_after_tax_'+x).val();

        var total = amount*price;

        $('#order_amount_after_tax_'+x).val(total);
        
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
        $.getJSON('{{base_url()}}suratpesanan/suratpesanans/getPricelist', {id: $('#pricelist_id_'+x).val()}, function(json, textStatus) {
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

    $('#principle_id').change(function(){
        $.getJSON('{{base_url()}}suratpesanan/suratpesanans/getPrinciple', {id: $('#principle_id').val()}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data;
                var i;
                var html = "";

                $('[name="principle_address"]').val(row.address);
                $('[name="principle_pic"]').val(row.pic);
                $('[name="no_sp"]').focus();

            }else if(json.status == "error"){
                toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
            }
            App.unblockUI('#form-wrapper');
       });
    });

    $('#dipo_partner_id').change(function(){
        $.getJSON('{{base_url()}}suratpesanan/suratpesanans/getDipo', {id: $('#dipo_partner_id').val()}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data;
                var i;
                var html = "";

                $('[name="dipo_name"]').val(row.name);
                $('[name="dipo_address"]').val(row.address);
                // $('[name="sp_date"]').focus();

            }else if(json.status == "error"){
                toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
            }
            App.unblockUI('#form-wrapper');
       });
    });

    function add_suratpesanan(){
        $('#form-suratpesanan')[0].reset(); 
        $('#modal_form').modal('show'); 
        $('.modal-title').text('<?=lang('new_suratpesanan')?>'); 

        $('[name="id"]').val('');
    }
    toastr.options = { "positionClass": "toast-top-right", };

    // Pengaturan Datatable 
    var oTable =$('#table-pesanan').dataTable({
        "responsive": false,
        "bProcessing": true,
        "bServerSide": true,
        "bLengthChange": true,
        "sServerMethod": "GET",
        "sAjaxSource": "{{ base_url() }}suratpesanan/suratpesanans/fetch_data",
        "columnDefs": [
            {"className": "dt-center", "targets": [5]},
            {"targets": [5], "orderable": false}
        ],
        "order": [0,"asc"],
    }).fnSetFilteringDelay(1000);

    // Pengaturan Form Validation 
    var form_validator = $("#form-suratpesanan").validate({
        errorPlacement: function(error, element) {
            $(element).parent().closest('.form-group').append(error);
        },
        errorElement: "span",
        rules: {
            principle_id: "required",
            no_sp: "required",
            dipo_partner_id: "required",
            sp_date: "required",
            pricelist_id: "required",
            order_amount_in_ctn: "required",
        },
        messages: {
            principle_id: "{{lang('principle')}}" + " {{lang('not_empty')}}",
            no_sp: "{{lang('no_sp')}}" + " {{lang('not_empty')}}",
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
                url:       '{{base_url()}}suratpesanan/suratpesanans/save',      
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
        $.getJSON('{{base_url()}}suratpesanan/suratpesanans/view', {id: value}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data[0];
                var rowDetail = json.dataDetail;
                var i;
                var html = "";
                var dataLength = rowDetail.length;

                $('[name="sp_id"]').val(row.id);
                $('#principle_id').val(row.principle_id);
                $('#dipo_partner_id').val(row.dipo_id);
                $('[name="principle_code"]').val(row.principle_code);
                $('[name="principle_address"]').val(row.principle_address);
                $('[name="principle_pic"]').val(row.principle_pic);
                $('[name="no_sp"]').val(row.sp_no);
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
                $('.modal-title').text('<?=lang('edit_suratpesanan')?>'); 

            }else if(json.status == "error"){
                toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
            }
            App.unblockUI('#form-wrapper');
       });
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

    $('#modal_detail').on('hidden.bs.modal', function () {
        location.reload();
    })

    $('#modal_form').on('hidden.bs.modal', function () {
        location.reload();
    })

    // Menampilkan detail data pesanan
    function viewDetail(value){   
        form_validator.resetForm();
        $("html, body").animate({
            scrollTop: 0
        }, 500);
        App.blockUI({
            target: '#form-wrapper'
        });
        $.getJSON('{{base_url()}}suratpesanan/suratpesanans/viewDetail', {id: value}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data[0];
                var i;
                var html = "";

                $('[name="id_pesanan"]').val(row.id);
                $('[name="principle_code"]').val(row.principle_code);
                $('[name="principle_address"]').val(row.principle_address);
                $('[name="no_sp"]').val(row.sp_no);
                $('[name="dipo_name"]').val(row.dipo_name);
                $('[name="dipo_address"]').val(row.dipo_address);
                $('[name="sp_date"]').val(formatDate(row.sp_date));
                $('[name="view_total_order_amount_in_ctn"]').val(row.total_order_amount_in_ctn);
                $('[name="view_total_order_price_before_tax"]').val(row.total_order_price_before_tax);
                $('[name="view_total_order_price_after_tax"]').val(row.total_order_price_after_tax);
                $('[name="view_total_order_amount_after_tax"]').val(row.total_order_amount_after_tax);
                $('#tanggal_pengiriman').text(formatDate(row.sp_date))
                $('#total_value').text(row.total_order_amount_after_tax)
                $('#total_niv').text(row.total_niv)

                $('#modal_detail').modal('show');
                $('.modal-title').text('<?=lang('edit_suratpesanan')?>'); 
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
            "sAjaxSource": "{{ base_url() }}suratpesanan/suratpesanans/fetch_data_pesanan/?id="+value,
            "order": [0,"asc"],
            "columnDefs": [
            {"className": "dt-center", "targets": [0, 3, 4, 5, 6]}
            ],
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
                $.getJSON('{{base_url()}}suratpesanan/suratpesanans/delete', {id: value}, function(json, textStatus) {
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