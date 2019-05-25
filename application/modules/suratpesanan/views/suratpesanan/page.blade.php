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
                            <button onclick="add_product()" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>{{lang('tambah_surat_pesanan')}}</button>
                        @endif

                        @if($print_limited_access == 1 || $print_unlimited_access == 1)
                            <button onClick="return window.open('{{base_url()}}master/product/pdf')" class="btn btn-danger btn-sm">
                                <i class="fa fa-file-pdf-o"></i> {{ lang('print_pdf') }}
                            </button>
                            <button onClick="return window.open('{{base_url()}}master/product/excel')" class="btn btn-success btn-sm">
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
 <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog" style="width:50%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?=lang('new_product')?></h3>
      </div>
      {{ form_open(null,array('id' => 'form-product', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
      <div class="modal-body">
        <input type="hidden" name="id" value="">
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('product_code')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="product_code" id="product_code" placeholder="<?=lang('product_code')?>" maxlength="50" />
                <div class="form-control-focus"> </div>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('barcode')?></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="barcode_product" id="barcode_product" placeholder="<?=lang('product')?>" maxlength="50" />
                <input type="text" class="form-control input-sm" name="barcode_carton" id="barcode_carton" placeholder="<?=lang('carton')?>" maxlength="50" />
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('product_name')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="name" id="name" placeholder="<?=lang('name')?>" maxlength="50" />
                <div class="form-control-focus"> </div>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('packing_size')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="packing_size" id="packing_size" placeholder="<?=lang('packing_size')?>" maxlength="50" />
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('qty_per_ctn')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input type="number" class="form-control input-sm" name="qty" id="qty" placeholder="<?=lang('qty_per_ctn')?>" maxlength="50" />
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('carton_dimension')?></label>
            <div class="col-lg-7 form-inline">
                <input oninput="get_volume()" type="number" class="form-control input-sm" name="length" id="length" placeholder="Length" maxlength="20" />
                <input oninput="get_volume()" type="number" class="form-control input-sm" name="width" id="width" placeholder="Width" maxlength="20" />
                <input oninput="get_volume()" type="number" class="form-control input-sm" name="height" id="height" placeholder="Height" maxlength="20" />
                <input type="number" class="form-control input-sm" name="volume" id="volume" placeholder="Volume" maxlength="20" />
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('weight')?></label>
            <div class="col-lg-7">
                <input type="number" class="form-control input-sm" name="weight" id="weight" placeholder="<?=lang('weight')?>" maxlength="50" />
                <div class="form-control-focus"> </div>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('category')?><span class="text-danger">*</span></label>
            <div class="col-md-7">
                <select name="category_id" class="form-control">
                <?php
                    if (!empty($categories)) {
                        foreach ($categories as $c) { ?>
                        <option value="<?=$c->id?>"><?=ucfirst($c->name)?></option>
                <?php } } ?>
                </select>  
            </div>  
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('description')?></label>
            <div class="col-lg-7">
                <textarea rows="4" cols="50" class="form-control input-sm" name="description" id="description" placeholder="<?=lang('description')?>"></textarea>
                <div class="form-control-focus"> </div>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('feature')?></label>
            <div class="col-lg-7">
                <textarea rows="4" cols="50" class="form-control input-sm" name="feature" id="feature" placeholder="<?=lang('feature')?>"></textarea>
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('image')?></label>
            <div class="col-lg-7">
            <input type="file" class="form-control" name="upload_Files[]" multiple/>
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input" id="preview-upload-image-field">
            <div class="col-md-12">
                <div class="product-image preview-upload-image text-center"></div>
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
    $('#preview-upload-image-field').hide();

    function get_volume(){
        var length = $('#length').val();
        var height = $('#height').val();
        var width  = $('#width').val();
        var volume = 0;

        if(length != '' && height != '' && width != ''){
            var volume = (length * height * width)/1000000;
        }

        $('#volume').val(volume.toFixed(2));
    }

    function add_product(){
        $('#form-product')[0].reset(); 
        $('#modal_form').modal('show'); 
        $('.modal-title').text('<?=lang('new_product')?>'); 

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
    var form_validator = $("#form-product").validate({
        errorPlacement: function(error, element) {
            $(element).parent().closest('.form-group').append(error);
        },
        errorElement: "span",
        rules: {
            name: "required",
            product_code: "required",
            packing_size: "required",
            qty: "required",
            category_id: "required",
        },
        messages: {
            name: "{{lang('product_name')}}" + " {{lang('not_empty')}}",
            product_code: "{{lang('product_code')}}" + " {{lang('not_empty')}}",
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
                url:       '{{base_url()}}product/products/save',      
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
        $.getJSON('{{base_url()}}product/products/view', {id: value}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data;
                var rowImage = json.image;
                var i;
                var html = "";

                $('[name="id"]').val(row.id);
                $('[name="product_code"]').val(row.product_code);
                $('[name="barcode_product"]').val(row.barcode_product);
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
                    html += '<div class="product-image"> <a href="javascript:void()" onclick="deleteImage(' + rowImage[i].id + ')" class="btn btn-danger btn-icon-only btn-circle" title="DELETE"><i class="fa fa-trash-o"></i></a><img width="150" style="padding: 10px;" src="{{ base_url() }}uploads/images/products/' + rowImage[i].image + '"></div>';
                }
               
                $('.preview-upload-image').html(html);
                $('#preview-upload-image-field').show();

                $('#modal_form').modal('show');
                $('.modal-title').text('<?=lang('edit_product')?>'); 
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
                $.getJSON('{{base_url()}}product/products/delete', {id: value}, function(json, textStatus) {
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
                $.getJSON('{{base_url()}}product/products/deleteImage', {id: value}, function(json, textStatus) {
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