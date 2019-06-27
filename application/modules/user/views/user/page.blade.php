@extends('default.views.layouts.default')

@section('title') {{lang('users')}} @stop

@section('body')
<style type="text/css">
    .form-group span.error {
        margin-left: 0% !important;
    }
    .form-edit span.error {
        margin-left: 15% !important;
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
                <span>{{lang('users')}}</span>
            </li>
        </ul>
        
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title">{{lang('users')}}</h3>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="table-wrapper" class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-grid font-dark"></i>
                        <span class="caption-subject">{{lang('users')}}</span>
                    </div>
                    <div class="tools"> 
                        @if($add_access == 1)
                            <button id="add-new" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i>{{lang('new_user')}}
                            </button>
                        @endif
                    </div>
                </div>
                <div class="portlet-body">
                    <table id="table-user" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                        <thead>
                            <tr>
                                <th><?=lang('full_name')?></th>  
                                <th><?=lang('username')?> </th>
                                <th><?=lang('company_name')?> </th>
                                <th><?=lang('role')?> </th>
                                <th><?=lang('registered_on')?> </th>
                                <th><?=lang('avatar_image')?></th>
                                <th width="18%"><?=lang('options')?></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
</div>

<!-- Bootstrap modal -->
<div class="modal fade" id="modalAddNewUser" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?=lang('new_user')?></h4>
            </div>
            
            {{ form_open(null,array('id' => 'form-user', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
            <div class="modal-body">
               <input type="hidden" name="r_url" value="<?=base_url()?>users/account">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-md-line-input">
                            <label class="col-md-12"><?=lang('full_name')?><span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <input type="text" class="input-sm form-control" value="<?=set_value('fullname')?>" placeholder="Full Name" name="fullname" required>
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-12"><?=lang('username')?><span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <input type="text" name="username" placeholder="Min. 4 & Max. 20 Character" value="<?=set_value('username')?>" class="input-sm form-control" required>
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-12"><?=lang('email')?><span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <input type="email" placeholder="email@me.com" name="email" value="<?=set_value('email')?>" class="input-sm form-control" required>
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-12"><?=lang('phone')?></label>
                            <div class="col-md-12">
                                <input type="text" class="input-sm form-control number" value="<?=set_value('phone')?>" name="phone" placeholder="Phone Number">
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-12"><?=lang('company_name')?></label>
                            <div class="col-md-12">
                                <input type="text" class="input-sm form-control" value="<?=set_value('company')?>" name="company" placeholder="Company Name"> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-md-line-input">
                            <label class="col-md-12"><?=lang('password')?><span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <input type="password" placeholder="<?=lang('password')?>" value="<?=set_value('password')?>" name="password"  class="input-sm form-control" required>
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-12"><?=lang('confirm_password')?><span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <input type="password" placeholder="<?=lang('confirm_password')?>" value="<?=set_value('confirm_password')?>" name="confirm_password"  class="input-sm form-control" required>
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-12"><?=lang('role')?></label>
                            <div class="col-md-12">
                                <select name="role" id="role" class="form-control">
                                <?php
                                    if (!empty($roles)) {
                                        foreach ($roles as $r) { 
                                ?>
                                            <option value="<?=$r->id?>"><?=ucfirst($r->description)?></option>
                                <?php 
                                        }
                                    } 
                                ?>
                                </select>  
                            </div>     
                        </div>

                        <div class="form-group form-md-line-input dipo_partner_field">
                            <label class="col-md-12"><span id="txt_customer"><?=lang('dipo')?></span><span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <select class="form-control input-sm select2" name="dipo_partner_id" id="dipo_partner_id" style="width: 100%;"></select>
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>

                    </div> 
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">{{ lang('save') }}</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{ lang('close') }}</button>
            </div>
           {{ form_close() }}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modalEditUser" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
            <h4 class="modal-title"><?=lang('edit')?> <?=lang('user')?></h4>
        </div>
        {{ form_open(base_url() . 'user/update',array('id' => 'form-user-edit', 'class' => 'form-horizontal')) }}
        <div class="modal-body">
            <input type="hidden" name="user_id" value="">
            <div class="form-group form-edit form-md-line-input">
                <label class="col-lg-3 control-label"><?=lang('full_name')?> <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="" name="fullname">
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            <div class="form-group form-edit form-md-line-input">
                <label class="col-lg-3 control-label"><?=lang('email')?> <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <input type="email" class="form-control" value="" name="email" required>
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            <div class="form-group form-edit form-md-line-input">
                <label class="col-lg-3 control-label"><?=lang('company_name')?> </label>
                <div class="col-lg-8">
                    <input type="text" class="input-sm form-control" value="<?=set_value('company')?>" name="company"> 
                </div>
            </div>
            <div class="form-group form-edit form-md-line-input">
                <label class="col-lg-3 control-label"><?=lang('phone')?> </label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="" name="phone">
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            <div class="form-group form-edit form-md-line-input">
                <label class="col-lg-3 control-label"><?=lang('address')?> </label>
                <div class="col-lg-8">
                    <textarea name="address" class="form-control"></textarea>
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            <div class="form-group form-edit form-md-line-input">
                <label class="col-lg-3 control-label"><?=lang('city')?> </label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="" name="city">
                    <div class="form-control-focus"> </div>
                </div>
            </div>    
            <div class="form-group form-edit form-md-line-input">
                <label class="col-lg-3 control-label"><?=lang('role')?> <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <select name="role_id" id="role_edit" class="form-control">
                        <?php
                            if (!empty($roles)) {
                                foreach ($roles as $r) { 
                        ?>
                                    <option value="<?=$r->id?>"><?=ucfirst($r->description)?></option>
                        <?php 
                                } 
                            } 
                        ?>     
                    </select>
                </div>
            </div>

            <div class="form-group form-md-line-input dipo_partner_edit_field">
                <label class="col-lg-3 control-label"><span id="txt_customer_edit"><?=lang('dipo')?></span><span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <select class="form-control input-sm select2" name="dipo_partner_id" id="dipo_partner_id_edit" style="width: 100%;"></select>
                    <div class="form-control-focus"> </div>
                </div>
            </div>

        </div>
        <div class="modal-footer"> 
            <button type="submit" class="btn btn-primary"><?=lang('save')?></button>
            <a href="#" class="btn btn-danger" data-dismiss="modal"><?=lang('close')?></a>      
        </div>
        {{ form_close() }}
        </div>
    </div>
</div>

@stop

@section('scripts')
<script type="text/javascript">
    // Pengaturan awal halaman 
    $('.number').mask('000000000000000000');

    $('.dipo_partner_field').hide();
    $('.dipo_partner_edit_field').hide();
    
     $("#chk_status").bootstrapSwitch({
        'onText' : 'Active',
        'offText' : 'Not',
    });
    $('#parent_id').select2({
        theme: "bootstrap",
        width: "100%"
    });
    toastr.options = { "positionClass": "toast-top-right", };

    $('#add-new').click(function(e){
        form_validator.resetForm();
        $('#form-user')[0].reset(); 
        $('.modal-title').text('<?=lang('new_user')?>'); 
        $('#modalAddNewUser').modal('show');
    });

    // Pengaturan Datatable 
    var oTable =$('#table-user').dataTable({
        "bProcessing": true,
        "bServerSide": true,
        "bLengthChange": true,
        "sServerMethod": "GET",
        "sAjaxSource": "{{ base_url() }}master/users/account/fetch-data",
        "columnDefs": [
            {"className": "dt-center", "targets": [3, 5]},
            {"className": "dt-body-left", "targets": [6]},
            {"targets": [5, 6], "orderable": false}
        ],
        "order": [0,"asc"],
    }).fnSetFilteringDelay(1000);

    // Pengaturan Form Validation 
    var form_validator = $("#form-user").validate({
        errorPlacement: function(error, element) {
            $(element).parent().closest('.form-group').append(error);
        },
        errorElement: "span",
        rules: {
            fullname: "required",
            username: "required",
            email: "required",
            password: "required",
            confirm_password: "required"
        },
        messages: {
            fullname: "{{lang('full_name')}}" + " {{lang('not_empty')}}",
            username: "{{lang('username')}}" + " {{lang('not_empty')}}",
            email: "{{lang('email')}}" + " {{lang('not_empty')}}",
            password: "{{lang('password')}}" + " {{lang('not_empty')}}",
            confirm_password: "{{lang('confirm_password')}}" + " {{lang('not_empty')}}",
        },
        submitHandler : function(form){
            App.blockUI({
                target: '#form-wrapper'
            });
            $(form).ajaxSubmit({  
                beforeSubmit:  showRequest,  
                success:       showResponse,
                url:       '{{base_url()}}master/users/save',      
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
                    toastr.success('{{lang("message_save_success")}}','{{ lang("notification") }}');
                }else if(responseText.status == "error"){
                    toastr.error('{{lang("message_save_failed")}}','{{ lang("notification") }}');
                }else if(responseText.status == "unique"){
                    toastr.error('{{lang("already_exist")}}','{{ lang("notification") }}');
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
    var form_validator = $("#form-user-edit").validate({
        errorPlacement: function(error, element) {
            $(element).parent().closest('.form-edit').append(error);
        },
        errorElement: "span",
        rules: {
            fullname: "required",
            email: "required",
            role_id: "required",
        },
        messages: {
            fullname: "{{lang('full_name')}}" + " {{lang('not_empty')}}",
            email: "{{lang('email')}}" + " {{lang('not_empty')}}",
            role_id: "{{lang('role')}}" + " {{lang('not_empty')}}"
        },
        submitHandler : function(form){
            App.blockUI({
                target: '#form-wrapper'
            });
            $(form).ajaxSubmit({  
                beforeSubmit:  showRequest,  
                success:       showResponse,
                url:       '{{base_url()}}master/users/update',      
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
                    toastr.success('{{lang("message_save_success")}}','{{ lang("notification") }}');
                }else if(responseText.status == "error"){
                    toastr.error('{{lang("message_save_failed")}}','{{ lang("notification") }}');
                }else if(responseText.status == "unique"){
                    toastr.error('{{lang("already_exist")}}','{{ lang("notification") }}');
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
        $.getJSON('{{base_url()}}master/users/view', {id: value}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data;
                $('[name="user_id"]').val(row.id);
                $('[name="company"]').val(row.company);
                $('[name="fullname"]').val(row.full_name);
                $('[name="email"]').val(row.email);
                $('[name="phone"]').val(row.phone);
                $('[name="city"]').val(row.city);
                $('[name="address"]').val(row.address);
                $('[name="role_id"]').val(row.group_id);

                if($('#role_edit').val() == '2' || $('#role_edit').val() == '3'){
                    $('.dipo_partner_edit_field').show();

                    $.getJSON('{{base_url()}}get-customer-by-role', {role: $('#role_edit').val()}, function(json, textStatus) {
                        if(json.status == "error"){
                            toastr.error(json.message,'{{ lang("notification") }}');
                        }
                        else{
                            $('#dipo_partner_id_edit').html(json.tag_html);
                            $('#dipo_partner_id_edit').val(row.dipo_partner_id).change();
                        }
                        App.unblockUI('#form-wrapper');
                    });
                }
                else{
                    $('.dipo_partner_edit_field').hide();
                }

                $('#txt_customer_edit').text($('#role_edit option:selected').text());

                $('#dep_name').empty().append(json.dep_name);
                $('#modalEditUser').modal('show');
                $('.modal-title').text('Edit User'); 
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
                $.getJSON('{{base_url()}}master/users/delete', {id: value}, function(json, textStatus) {
                    if(json.status == "success"){
                        toastr.success('{{lang("deleted_succesfully")}}','{{ lang("notification") }}');
                    }else if(json.status == "error"){
                        toastr.error('Delete user failed','{{ lang("notification") }}');
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

    function reset_password(value){
        form_validator.resetForm();
        $("html, body").animate({
            scrollTop: 0
        }, 500);

        $.confirm({
            content : "Are you sure to reset password this user?",
            title : "Reset password !",
            confirm: function() {
                App.blockUI({
                    target: '#table-wrapper'
                });
                $.getJSON('{{base_url()}}master/users/reset-password', {id: value}, function(json, textStatus) {
                    if(json.status == "success"){
                        toastr.success('Reset password successfull','{{ lang("notification") }}');
                    }else if(json.status == "error"){
                        toastr.error('Reset password failed','{{ lang("notification") }}');
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
    
    function changeOrderMenu(id){
        $('#view_'+id).hide();
        $('#input_'+id).show();
        $('#link_'+id).hide();
        $('#save_'+id).show();
    }

    $('#role').change(function(){
        if($('#role').val() == '2' || $('#role').val() == '3'){
            $('.dipo_partner_field').show();

            $.getJSON('{{base_url()}}get-customer-by-role', {role: $('#role').val()}, function(json, textStatus) {
                if(json.status == "error"){
                    toastr.error(json.message,'{{ lang("notification") }}');
                }
                else{
                    $('#dipo_partner_id').html(json.tag_html);
                }
                App.unblockUI('#form-wrapper');
            });
        }
        else{
            $('.dipo_partner_field').hide();
        }

        $('#dipo_partner_id').val('').change();        
        $('#txt_customer').text($('#role option:selected').text());
    });

    $('#role_edit').change(function(){
        if($('#role_edit').val() == '2' || $('#role_edit').val() == '3'){
            $('.dipo_partner_edit_field').show();

            $.getJSON('{{base_url()}}get-customer-by-role', {role: $('#role_edit').val()}, function(json, textStatus) {
                if(json.status == "error"){
                    toastr.error(json.message,'{{ lang("notification") }}');
                }
                else{
                    $('#dipo_partner_id_edit').html(json.tag_html);
                }
                App.unblockUI('#form-wrapper');
            });
        }
        else{
            $('.dipo_partner_edit_field').hide();
        }

        $('#dipo_partner_id_edit').val('').change();        
        $('#txt_customer_edit').text($('#role_edit option:selected').text());
    });

</script>
@stop