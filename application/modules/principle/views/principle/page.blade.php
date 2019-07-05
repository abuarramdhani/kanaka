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
                                <!-- <th rowspan="2" class="text-center"><?=lang('product')?></th> -->
                                <!-- <th rowspan="2" class="text-center"><?=lang('brand')?></th> -->
                                <th rowspan="2" class="text-center"><?=lang('top')?></th>
                                <th rowspan="2" class="text-center"><?=lang('pic')?></th>
                                <th colspan="3" class="text-center"><?=lang('phone')?></th>
                                <th rowspan="2" class="text-center"><?=lang('email')?></th>
                                <!-- <th rowspan="2" class="text-center"><?=lang('web')?></th> -->
                                <!-- <th colspan="4" class="text-center"><?=lang('discount')?></th> -->
                                <th rowspan="2" class="text-center"><?=lang('created_date')?></th>
                                <th rowspan="2" width="13%"><?=lang('options')?></th>
                            </tr>
                            <tr>
                                <th><?=lang('office')?></th>
                                <th><?=lang('personal')?></th> 
                                <th><?=lang('fax')?></th> 
                                <!-- <th><?=lang('office')?></th> -->
                                <!-- <th><?=lang('personal')?></th>  -->
                                <!-- <th>Reg Disc</th> -->
                                <!-- <th>Add Disc 1</th>  -->
                                <!-- <th>Add Disc 2</th>  -->
                                <!-- <th>BTW Disc</th>  -->
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
  <div class="modal-dialog" style="width:80%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?=lang('new_principle')?></h3>
      </div>
      {{ form_open(null,array('id' => 'form-principle', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
      <div class="row modal-body">
            <div class="col-md-6">
                <input type="hidden" name="id" value="">
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('code')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="code" id="code_principal" placeholder="<?=lang('code')?>" maxlength="10" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('name')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="name" id="name_principal" placeholder="<?=lang('name')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('phone')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm number" name="phone_office" id="phone_office" placeholder="<?=lang('phone')?>" maxlength="20" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('fax')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm number" name="fax" id="fax_principal" placeholder="<?=lang('fax')?>" maxlength="20" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('email')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="email" class="form-control input-sm" name="email_office" id="email_office" placeholder="<?=lang('email')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('address')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="address" id="address_principal" placeholder="<?=lang('shipping_address')?>" maxlength="150" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('postal_code')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm number" name="postal_code" id="postal_code_principal" placeholder="<?=lang('postal_code')?>" maxlength="5" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('latitude')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="latitude" id="latitude_principal" placeholder="<?=lang('latitude')?>" maxlength="30" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('longitude')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="longitude" id="longitude_principal" placeholder="<?=lang('longitude')?>" maxlength="30" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <h5>{{ lang('text_pic_company') }}</h5>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('pic_operational')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="pic_operational" id="pic_operational" placeholder="<?=lang('pic_operational')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('pic_name')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="pic" id="pic" placeholder="<?=lang('pic_name')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('pic_phone')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="phone_personal" id="phone_personal" placeholder="<?=lang('pic_phone')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('pic_finance')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="pic_finance" id="pic_finance" placeholder="<?=lang('pic_finance')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('pic_finance_name')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="pic_finance_name" id="pic_finance_name" placeholder="<?=lang('pic_finance_name')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('pic_finance_phone')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm number" name="pic_finance_phone" id="pic_finance_phone" placeholder="<?=lang('pic_finance_phone')?>" maxlength="20" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
            </div>
            <div class="col-md-6">
                <h5>{{ lang('text_identitas_npwp') }}</h5>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('taxable')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <select class="form-control input-sm" name="taxable" id="taxable_principal" style="width: 100%;">
                            <option value=""><?= lang('select_your_option') ?></option>
                            <option value="0"><?= lang('no') ?></option>
                            <option value="1"><?= lang('yes') ?></option>
                        </select>
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('npwp')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm number" name="npwp" id="npwp_principal" placeholder="<?=lang('npwp')?>" maxlength="15" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('name')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="tax_name" id="tax_name_principal" placeholder="<?=lang('name')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('tdp')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm number" name="tdp" id="tdp" placeholder="<?=lang('tdp')?>" maxlength="20" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('siup')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm number" name="siup" id="siup" placeholder="<?=lang('siup')?>" maxlength="20" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('sppkp')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm number" name="sppkp" id="sppkp" placeholder="<?=lang('sppkp')?>" maxlength="20" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('company_name')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="tax_company_name" id="tax_company_name" placeholder="<?=lang('company_name')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('company_address')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="tax_company_address" id="tax_company_address" placeholder="<?=lang('company_address')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('payment_method')?></label>
                    <div class="col-lg-7">
                        <select class="form-control input-sm" name="tax_payment_method" id="tax_payment_method_principal" style="width: 100%;">
                            <option value=""><?= lang('select_your_option') ?></option>
                            <option value="cash"><?= lang('cash') ?></option>
                            <option value="credit"><?= lang('credit') ?></option>
                            <option value="central_ar"><?= lang('central_ar') ?></option>
                        </select>
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('payment_time')?><span class="text-danger">*</span></label>
                    <div class="col-lg-7">
                        <select class="form-control input-sm" name="top" id="top_principal" style="width: 100%;">
                            <option value=""><?= lang('select_your_option') ?></option>
                            <option value="cbd"><?= lang('cbd') ?></option>
                            <option value="cod"><?= lang('cod') ?></option>
                            <option value="3"><?= lang('3_days') ?></option>
                            <option value="7"><?= lang('7_days') ?></option>
                            <option value="14"><?= lang('14_days') ?></option>
                            <option value="21"><?= lang('21_days') ?></option>
                            <option value="30"><?= lang('30_days') ?></option>
                            <option value="45"><?= lang('45_days') ?></option>
                            <option value="60"><?= lang('60_days') ?></option>
                        </select>
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('credit_ceiling')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="tax_credit_ceiling" id="tax_credit_ceiling_principal" placeholder="<?=lang('credit_ceiling')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <hr>

                <h5>{{ lang('bank_account') }}</h5>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('account_number')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm number" name="account_number" id="account_number_principal" placeholder="<?=lang('account_number')?>" maxlength="25" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('account_name')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="account_name" id="account_name_principal" placeholder="<?=lang('account_name')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('bank_name')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="bank_name" id="bank_name_principal" placeholder="<?=lang('bank_name')?>" maxlength="50" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('bank_code')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm number" name="bank_code" id="bank_code_principal" placeholder="<?=lang('bank_code')?>" maxlength="3" />
                        <div class="form-control-focus"> </div>
                    </div>
                </div>
                
                <div class="form-group form-md-line-input">
                    <label class="col-lg-4 control-label"><?=lang('account_address')?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control input-sm" name="account_address" id="account_address_principal" placeholder="<?=lang('account_address')?>" maxlength="150" />
                        <div class="form-control-focus"> </div>
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
            {"className": "dt-center", "targets": [10]},
            {"targets": [10], "orderable": false}
        ],
        "order": [9,"desc"],
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
            phone_office: "required",
            email_office: "required",
            address: "required",
            postal_code: "required",
            taxable: "required",
            top: "required",
        },
        messages: {
            code: "{{lang('code')}}" + " {{lang('not_empty')}}",
            name: "{{lang('name')}}" + " {{lang('not_empty')}}",
            phone_office: "{{lang('phone')}}" + " {{lang('not_empty')}}",
            email_office: "{{lang('email')}}" + " {{lang('not_empty')}}",
            address: "{{lang('address')}}" + " {{lang('not_empty')}}",
            postal_code: "{{lang('postal_code')}}" + " {{lang('not_empty')}}",
            taxable: "{{lang('taxable')}}" + " {{lang('not_empty')}}",
            top: "{{lang('payment_time')}}" + " {{lang('not_empty')}}",
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
                $('[name="phone_office"]').val(row.phone_office);
                $('[name="fax"]').val(row.fax);
                $('[name="email_office"]').val(row.email_office);
                $('[name="address"]').val(row.address);
                $('[name="postal_code"]').val(row.postal_code);
                $('[name="latitude"]').val(row.latitude);
                $('[name="longitude"]').val(row.longitude);
                $('[name="pic_operational"]').val(row.pic_operational);
                $('[name="pic"]').val(row.pic);
                $('[name="phone_personal"]').val(row.phone_personal);
                $('[name="pic_finance"]').val(row.pic_finance);
                $('[name="pic_finance_name"]').val(row.pic_finance_name);
                $('[name="pic_finance_phone"]').val(row.pic_finance_phone);
                $('[name="taxable"]').val(row.taxable).change();
                $('[name="npwp"]').val(row.npwp);
                $('[name="tax_name"]').val(row.tax_name);
                $('[name="tdp"]').val(row.tdp);
                $('[name="siup"]').val(row.siup);
                $('[name="sppkp"]').val(row.sppkp);
                $('[name="tax_company_name"]').val(row.tax_company_name);
                $('[name="tax_company_address"]').val(row.tax_company_address);
                $('[name="tax_payment_method"]').val(row.tax_payment_method).change();
                $('[name="top"]').val(row.top).change();
                $('[name="tax_credit_ceiling"]').val(row.tax_credit_ceiling);
                $('[name="account_number"]').val(row.account_number);
                $('[name="account_name"]').val(row.account_name);
                $('[name="bank_name"]').val(row.bank_name);
                $('[name="bank_code"]').val(row.bank_code);
                $('[name="account_address"]').val(row.account_address);

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
    
    $('#code_principal').change(function(){
        $.getJSON('{{base_url()}}check-code-customer', {code: $('#code_principal').val(), type: 'principal'}, function(json, textStatus) {
            if(json.status == "error"){
                toastr.error(json.message,'{{ lang("notification") }}');
                $('#code_principal').val('');
                $('#code_principal').focus();
            }
            else{
                toastr.success(json.message,'{{ lang("notification") }}');                        
            }
            App.unblockUI('#form-wrapper');
        });
    });

</script>
@stop