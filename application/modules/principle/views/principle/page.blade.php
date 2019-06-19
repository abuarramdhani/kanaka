@extends('default.views.layouts.default')

@section('title') {{lang('principle')}} @stop

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
                <span>{{lang('principle')}}</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title"> {{lang('principle')}} </h3>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADERs-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="table-wrapper" class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-grid font-dark"></i>
                        <span class="caption-subject">{{lang('principle')}}</span>
                    </div>
                    <div class="tools">
                        @if($add_access == 1)
                            <button onclick="add_principle()" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>{{lang('new_principle')}}</button>
                        @endif

                        @if($print_limited_access == 1 || $print_unlimited_access == 1)
                            <button onClick="return window.open('{{base_url()}}master/vendor/pdf')" class="btn btn-danger btn-sm">
                                <i class="fa fa-file-pdf-o"></i> {{ lang('print_pdf') }}
                            </button>
                            <button onClick="return window.open('{{base_url()}}master/vendor/excel')" class="btn btn-success btn-sm">
                                <i class="fa fa-file-excel-o"></i> {{ lang('print_excel') }}
                            </button>
                        @endif
                    </div>
                </div>
                <div class="portlet-body">
                    <table id="table-principle" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-center"><?=lang('code')?></th>
                                <th rowspan="2" class="text-center"><?=lang('name')?></th>
                                <th rowspan="2" class="text-center"><?=lang('address')?></th>
                                <th rowspan="2" class="text-center"><?=lang('product')?></th>
                                <th rowspan="2" class="text-center"><?=lang('brand')?></th>
                                <th rowspan="2" class="text-center"><?=lang('top')?></th>
                                <th rowspan="2" class="text-center"><?=lang('pic')?></th>
                                <th colspan="3" class="text-center"><?=lang('phone')?></th>
                                <th colspan="2" class="text-center"><?=lang('email')?></th>
                                <th rowspan="2" class="text-center"><?=lang('web')?></th>
                                <th colspan="4" class="text-center"><?=lang('discount')?></th>
                                <th rowspan="2" class="text-center"><?=lang('created_date')?></th>
                                <th rowspan="2" width="13%"><?=lang('options')?></th>
                            </tr>
                            <tr>
                                <th><?=lang('office')?></th>
                                <th><?=lang('personal')?></th> 
                                <th><?=lang('fax')?></th> 
                                <th><?=lang('office')?></th>
                                <th><?=lang('personal')?></th> 
                                <th>Reg Disc</th>
                                <th>Add Disc 1</th> 
                                <th>Add Disc 2</th> 
                                <th>BTW Disc</th> 
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
        <h3 class="modal-title"><?=lang('new_principle')?></h3>
      </div>
      {{ form_open(null,array('id' => 'form-principle', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
      <div class="modal-body">
        <input type="hidden" name="id" value="">

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('code')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="code" id="code" placeholder="<?=lang('code')?>" maxlength="10" />
                <div class="form-control-focus"> </div>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('name')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="name" id="name" placeholder="<?=lang('name')?>" maxlength="50" />
                <div class="form-control-focus"> </div>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('address')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="address" id="address" placeholder="<?=lang('address')?>" maxlength="150" />
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('product')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="product" id="product" placeholder="<?=lang('product')?>" maxlength="150" />
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('brand')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="brand" id="brand" placeholder="<?=lang('brand')?>" maxlength="150" />
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('top')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="top" id="top" placeholder="<?=lang('top')?>" maxlength="50" />
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('pic')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="pic" id="pic" placeholder="<?=lang('pic')?>" maxlength="50" />
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('phone')?></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm number" name="phone_office" id="phone_office" placeholder="<?=lang('office')?>" maxlength="20" />
                <input type="text" class="form-control input-sm number" name="phone_personal" id="phone_personal" placeholder="<?=lang('personal')?>" maxlength="20" />
                <input type="text" class="form-control input-sm number" name="fax" id="fax" placeholder="<?=lang('fax')?>" maxlength="20" />
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('email')?></label>
            <div class="col-lg-7">
                <input type="email" class="form-control input-sm" name="email_office" id="email_office" placeholder="<?=lang('office')?>" maxlength="50" />
                <input type="email" class="form-control input-sm" name="email_personal" id="email_personal" placeholder="<?=lang('personal')?>" maxlength="50" />
                <div class="form-control-focus"> </div>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('web')?></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="web" id="web" placeholder="<?=lang('web')?>" maxlength="50" />
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Reg Disc</label>
            <div class="col-lg-7">
                <input type="number" class="form-control input-sm" name="reg_disc" id="reg_disc" placeholder="Reg Disc" maxlength="50" />
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Add Disc 1</label>
            <div class="col-lg-7">
                <input type="number" class="form-control input-sm" name="add_disc_1" id="add_disc_1" placeholder="Add Disc 1" maxlength="50" />
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Add Disc 2</label>
            <div class="col-lg-7">
                <input type="number" class="form-control input-sm" name="add_disc_2" id="add_disc_2" placeholder="Add Disc 2" maxlength="50" />
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">BTW Disc</label>
            <div class="col-lg-7">
                <input type="number" class="form-control input-sm" name="btw_disc" id="btw_disc" placeholder="BTW Disc" maxlength="50" />
                <div class="form-control-focus"> </div>
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
        $('#zona_id').select2();
    });

    function add_principle(){
        $('#form-principle')[0].reset(); 
        $('#modal_form').modal('show'); 
        $('.modal-title').text('<?=lang('new_principle')?>'); 

        $('[name="id"]').val('');
    }
    toastr.options = { "positionClass": "toast-top-right", };

    // Pengaturan Datatable 
    var oTable =$('#table-principle').dataTable({
        "responsive": false,
        "bProcessing": true,
        "bServerSide": true,
        "bLengthChange": true,
        "sServerMethod": "GET",
        "sAjaxSource": "{{ base_url() }}principle/principles/fetch_data",
        "columnDefs": [
            {"className": "dt-center", "targets": [18]},
            {"targets": [18], "orderable": false}
        ],
        "order": [0,"asc"],
    }).fnSetFilteringDelay(1000);

    // Pengaturan Form Validation 
    var form_validator = $("#form-principle").validate({
        errorPlacement: function(error, element) {
            $(element).parent().closest('.form-group').append(error);
        },
        errorElement: "span",
        rules: {
            code: "required",
            name: "required",
            address: "required",
            product: "required",
            brand: "required",
            top: "required",
            pic: "required",
        },
        messages: {
            code: "{{lang('code')}}" + " {{lang('not_empty')}}",
            name: "{{lang('name')}}" + " {{lang('not_empty')}}",
            address: "{{lang('address')}}" + " {{lang('not_empty')}}",
            product: "{{lang('product')}}" + " {{lang('not_empty')}}",
            brand: "{{lang('brand')}}" + " {{lang('not_empty')}}",
            top: "{{lang('top')}}" + " {{lang('not_empty')}}",
            pic: "{{lang('pic')}}" + " {{lang('not_empty')}}",
        },
        submitHandler : function(form){
            App.blockUI({
                target: '#form-wrapper'
            });
            $(form).ajaxSubmit({  
                beforeSubmit:  showRequest,  
                success:       showResponse,
                url:       '{{base_url()}}principle/principles/save',      
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
        $.getJSON('{{base_url()}}principle/principles/view', {id: value}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data;
                $('[name="id"]').val(row.id);
                $('[name="code"]').val(row.code);
                $('[name="name"]').val(row.name);
                $('[name="address"]').val(row.address);
                $('[name="product"]').val(row.product);
                $('[name="brand"]').val(row.brand);
                $('[name="top"]').val(row.top);
                $('[name="pic"]').val(row.pic);
                $('[name="phone_office"]').val(row.phone_office).change();
                $('[name="phone_personal"]').val(row.phone_personal);
                $('[name="fax"]').val(row.fax);
                $('[name="email_office"]').val(row.email_office);
                $('[name="email_personal"]').val(row.email_personal);
                $('[name="web"]').val(row.web);
                $('[name="reg_disc"]').val(row.reg_disc);
                $('[name="add_disc_1"]').val(row.add_disc_1);
                $('[name="add_disc_2"]').val(row.add_disc_2);
                $('[name="btw_disc"]').val(row.btw_disc);

                $('#modal_form').modal('show');
                $('.modal-title').text('<?=lang('edit_principle')?>'); 
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
                $.getJSON('{{base_url()}}principle/principles/delete', {id: value}, function(json, textStatus) {
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