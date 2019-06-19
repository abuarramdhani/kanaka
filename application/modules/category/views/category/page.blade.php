@extends('default.views.layouts.default')

@section('title') {{lang('category')}} @stop

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
                <span>{{lang('category')}}</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title"> {{lang('category')}} </h3>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADERs-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="table-wrapper" class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-grid font-dark"></i>
                        <span class="caption-subject">{{lang('category')}}</span>
                    </div>
                    <div class="tools">
                        @if($add_access == 1)
                            <button onclick="add_category()" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>{{lang('new_category')}}</button>
                        @endif

                        @if($print_limited_access == 1 || $print_unlimited_access == 1)
                            <button onClick="return window.open('{{base_url()}}master/category/pdf')" class="btn btn-danger btn-sm">
                                <i class="fa fa-file-pdf-o"></i> {{ lang('print_pdf') }}
                            </button>
                            <button onClick="return window.open('{{base_url()}}master/category/excel')" class="btn btn-success btn-sm">
                                <i class="fa fa-file-excel-o"></i> {{ lang('print_excel') }}
                            </button>
                        @endif
                    </div>
                </div>
                <div class="portlet-body">
                    <table id="table-category" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                        <thead>
                            <tr>
                                <th><?=lang('name')?></th>
                                <th><?=lang('description')?></th>
                                <th><?=lang('created_date')?></th>
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
        <h3 class="modal-title"><?=lang('new_category')?></h3>
      </div>
      {{ form_open(null,array('id' => 'form-category', 'class' => 'form-horizontal', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data')) }}
      <div class="modal-body">
        <input type="hidden" name="id" value="">
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('name')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="name" id="name" placeholder="<?=lang('name')?>" maxlength="50" />
                <div class="form-control-focus"> </div>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('description')?></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="description" id="description" placeholder="<?=lang('description')?>" maxlength="150" />
                <div class="form-control-focus"> </div>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('image')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input type="file" class="form-control" name="image" id="image" accept="image/*" />
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input" id="preview-upload-image-field">
            <div class="col-md-offset-4 col-md-6">
                <div class="preview-upload-image text-center"></div>
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

    function add_category(){
        $('#form-category')[0].reset(); 
        $('#modal_form').modal('show'); 
        $('.modal-title').text('<?=lang('new_category')?>'); 

        $('[name="id"]').val('');
    }
    toastr.options = { "positionClass": "toast-top-right", };

    // Pengaturan Datatable 
    var oTable =$('#table-category').dataTable({
        "responsive": false,
        "bProcessing": true,
        "bServerSide": true,
        "bLengthChange": true,
        "sServerMethod": "GET",
        "sAjaxSource": "{{ base_url() }}category/categories/fetch_data",
        "columnDefs": [
            {"className": "dt-center", "targets": [3]},
            {"targets": [3], "orderable": false}
        ],
        "order": [0,"asc"],
    }).fnSetFilteringDelay(1000);

    // Pengaturan Form Validation 
    var form_validator = $("#form-category").validate({
        errorPlacement: function(error, element) {
            $(element).parent().closest('.form-group').append(error);
        },
        errorElement: "span",
        rules: {
            name: "required",
            // image: "required",
        },
        messages: {
            name: "{{lang('name')}}" + " {{lang('not_empty')}}",
            // image: "{{lang('image')}}" + " {{lang('not_empty')}}",
        },
        submitHandler : function(form){
            App.blockUI({
                target: '#form-wrapper'
            });
            $(form).ajaxSubmit({  
                beforeSubmit:  showRequest,  
                success:       showResponse,
                url:       '{{base_url()}}category/categories/save',      
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
        $.getJSON('{{base_url()}}category/categories/view', {id: value}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data;
                $('[name="id"]').val(row.id);
                $('[name="name"]').val(row.name);
                $('[name="description"]').val(row.description);
                // $('[name="image"]').val(row.image);

                var html = '<img width="250" style="padding: 10px;" src="{{ base_url() }}uploads/images/categories/' + row.image + '">';
                $('.preview-upload-image').html(html);
                $('#preview-upload-image-field').show();

                $('#modal_form').modal('show');
                $('.modal-title').text('<?=lang('edit_category')?>'); 
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
                $.getJSON('{{base_url()}}category/categories/delete', {id: value}, function(json, textStatus) {
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