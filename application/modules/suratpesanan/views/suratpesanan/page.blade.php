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
  <div class="modal-dialog" style="width:50%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3><?=lang('new_data')?></h3>
      </div>
      {{ form_open(null,array('id' => 'form-suratpesanan', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
      <div class="modal-body">
        <input type="hidden" name="id" value="">
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
                <input type="text" class="form-control input-sm" name="principle_address" id="principle_address" placeholder="<?=lang('principle_address')?>" />
                <input type="text" class="form-control input-sm" name="principle_pic" id="principle_pic" placeholder="<?=lang('principle_pic')?>" />
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
                <input type="text" class="form-control input-sm" name="dipo_name" id="dipo_name" placeholder="<?=lang('dipo_name')?>" />
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
  <div class="modal-dialog" style="width:50%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3><?=lang('surat_pesanan')?></h3>
      </div>
      {{ form_open(null,array('id' => 'form-suratpesanan', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
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

    $('.btn_add_row').click(function(){
        $("#add-table-surat tbody").append(
            '<tr>' +
                // '<td class="text-center"><input type="button" class="btn_add_row fa fa-plus"></td>' +
                '<td class="text-center">'+
                    '<select onchange="getProduct('+i+')" id="pricelist_id_'+i+'" name="pricelist_id[]" class="form-control"></select> '+
                '</td>' +
                '<td class="text-center"><input type="text" class="form-control input-sm" name="product_name[]" id="product_name_'+i+'"/></td>' +
                '<td class="text-center"><input onkeyup="get_total('+i+')" type="text" class="form-control input-sm" name="order_amount_in_ctn[]" id="order_amount_in_ctn_'+i+'" oninput="get_total()"/></td>' +
                '<td class="text-center"><input type="text" class="form-control input-sm" name="order_price_before_tax[]" id="order_price_before_tax_'+i+'"/>' +
                '<td class="text-center"><input type="text" class="form-control input-sm" name="order_price_after_tax[]" id="order_price_after_tax_'+i+'"/></td>' +
                '<td class="text-center"><input type="text" class="form-control input-sm" name="order_amount_after_tax[]" id="order_amount_after_tax_'+i+'"/></td>' +
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
    }

    function getProduct(x){
        $.getJSON('{{base_url()}}suratpesanan/suratpesanans/getPricelist', {id: $('#pricelist_id_'+x).val()}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data[0];
                var i;
                var html = "";

                console.log(row);

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
                $('[name="sp_date"]').focus();

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
            name: "required",
            suratpesanan_code: "required",
            packing_size: "required",
            qty: "required",
            category_id: "required",
        },
        messages: {
            name: "{{lang('suratpesanan_name')}}" + " {{lang('not_empty')}}",
            suratpesanan_code: "{{lang('suratpesanan_code')}}" + " {{lang('not_empty')}}",
            packing_size: "{{lang('packing_size')}}" + " {{lang('not_empty')}}",
            qty: "{{lang('qty_per_ctn')}}" + " {{lang('not_empty')}}",
            category_id: "{{lang('category')}}" + " {{lang('not_empty')}}",
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
                    // window.location.reload()
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
        $.getJSON('{{base_url()}}suratpesanan/suratpesanans/view', {id: value}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data;
                var rowImage = json.image;
                var i;
                var html = "";

                $('[name="id"]').val(row.id);
                $('[name="suratpesanan_code"]').val(row.suratpesanan_code);
                $('[name="barcode_suratpesanan"]').val(row.barcode_suratpesanan);
                $('[name="barcode_carton"]').val(row.barcode_carton);
                $('[name="name"]').val(row.name);
                $('[name="packing_size"]').val(row.packing_size);
                $('[name="qty"]').val(row.qty);
                $('[name="length"]').val(row.length);
                $('[name="width"]').val(row.width);
                $('[name="height"]').val(row.height);
                $('[name="volume"]').val(row.volume);
                $('[name="weight"]').val(row.weight);
                $('[name="category_id"]').val(row.category_id);
                $('[name="description"]').val(row.description);
                $('[name="feature"]').val(row.feature);

                for(i=0; i<rowImage.length; i++){
                    html += '<div class="suratpesanan-image"> <a href="javascript:void()" onclick="deleteImage(' + rowImage[i].id + ')" class="btn btn-danger btn-icon-only btn-circle" title="DELETE"><i class="fa fa-trash-o"></i></a><img width="150" style="padding: 10px;" src="{{ base_url() }}uploads/images/suratpesanans/' + rowImage[i].image + '"></div>';
                }
               
                $('.preview-upload-image').html(html);
                $('#preview-upload-image-field').show();

                $('#modal_form').modal('show');
                $('.modal-title').text('<?=lang('edit_suratpesanan')?>'); 
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
                $('[name="sp_date"]').val(row.sp_date);

                $('#modal_detail').modal('show');
                $('.modal-title').text('<?=lang('edit_suratpesanan')?>'); 
            }else if(json.status == "error"){
                toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
            }
            App.unblockUI('#form-wrapper');
       });

        //Pengaturan Datatable 
        var oTable =$('#table-surat').dataTable({
            "paging": false,
            "searching": false,
            "bProcessing": true,
            "bServerSide": true,
            "bLengthChange": true,
            "sServerMethod": "GET",
            "sAjaxSource": "{{ base_url() }}suratpesanan/suratpesanans/fetch_data_pesanan/?id="+value,
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

    // Proses hapus image
    function deleteImage(value){
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
                $.getJSON('{{base_url()}}suratpesanan/suratpesanans/deleteImage', {id: value}, function(json, textStatus) {
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

    // Preview image in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {
        if (input.files) {
            var reader = new FileReader();
            reader.onload = function(event) {
                $($.parseHTML('<img width="100" style="padding: 10px;">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
            }
            reader.readAsDataURL(input.files);
        }
    };

    $('#image').on('change', function() {
        $('.preview-upload-image').html('');
        imagesPreview(this, 'div.preview-upload-image');
        $('#preview-upload-image-field').show();
    });
</script>
@stop