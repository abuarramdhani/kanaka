@extends('default.views.layouts.default')

@section('title') {{lang('dipo')}} @stop

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
                <span>{{lang('dipo')}}</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title"> {{lang('dipo')}} </h3>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADERs-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="table-wrapper" class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-grid font-dark"></i>
                        <span class="caption-subject">{{lang('dipo')}}</span>
                    </div>
                    <div class="tools">
                        @if($add_access == 1)
                            <button onclick="add_dipo()" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>{{lang('new_dipo')}}</button>
                        @endif

                        @if($print_limited_access == 1 || $print_unlimited_access == 1)
                            <button onClick="return window.open('{{base_url()}}master/dipo/pdf')" class="btn btn-danger btn-sm">
                                <i class="fa fa-file-pdf-o"></i> {{ lang('print_pdf') }}
                            </button>
                            <button onClick="return window.open('{{base_url()}}master/dipo/excel')" class="btn btn-success btn-sm">
                                <i class="fa fa-file-excel-o"></i> {{ lang('print_excel') }}
                            </button>
                        @endif
                    </div>
                </div>
                <div class="portlet-body">
                    <table id="table-dipo" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                        <thead>
                            <tr>
                                <th><?=lang('code')?></th>
                                <th><?=lang('name')?></th>
                                <th><?=lang('address')?></th>
                                <th><?=lang('phone')?></th>
                                <th><?=lang('email')?></th>
                                <th><?=lang('city')?></th>
                                <th><?=lang('subdistrict')?></th>
                                <!-- <th><?=lang('zona')?></th> -->
                                <th><?=lang('latitude')?></th>
                                <th><?=lang('longitude')?></th>
                                <!-- <th><?=lang('pic')?></th> -->
                                <th><?=lang('top')?></th>
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
  <div class="modal-dialog" style="width:80%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?=lang('new_dipo')?></h3>
      </div>
      {{ form_open(null,array('id' => 'form-dipo', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
      <div class="row modal-body">
        <div class="col-md-6">
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
                <label class="col-lg-4 control-label"><?=lang('phone')?><span class="text-danger">*</span></label>
                <div class="col-lg-7">
                    <input type="text" class="form-control input-sm number" name="phone" id="phone" placeholder="<?=lang('phone')?>" maxlength="20" />
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            
            <div class="form-group form-md-line-input">
                <label class="col-lg-4 control-label"><?=lang('fax')?></label>
                <div class="col-lg-7">
                    <input type="text" class="form-control input-sm number" name="fax" id="fax_customer" placeholder="<?=lang('fax')?>" maxlength="20" />
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            
            <div class="form-group form-md-line-input">
                <label class="col-lg-4 control-label"><?=lang('email')?><span class="text-danger">*</span></label>
                <div class="col-lg-7">
                    <input type="email" class="form-control input-sm" name="email" id="email" placeholder="<?=lang('email')?>" maxlength="50" />
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            
            <div class="form-group form-md-line-input">
                <label class="col-lg-4 control-label"><?=lang('shipping_address')?><span class="text-danger">*</span></label>
                <div class="col-lg-7">
                    <input type="text" class="form-control input-sm" name="address" id="address_customer" placeholder="<?=lang('shipping_address')?>" maxlength="150" />
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            
            <div class="form-group form-md-line-input">
                <label class="col-lg-4 control-label"><?=lang('billing_address')?><span class="text-danger">*</span></label>
                <div class="col-lg-7">
                    <input type="text" class="form-control input-sm" name="billing_address" id="billing_address" placeholder="<?=lang('billing_address')?>" maxlength="150" />
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            
            <div class="form-group form-md-line-input">
                <label class="col-lg-4 control-label"><?=lang('city')?><span class="text-danger">*</span></label>
                <div class="col-lg-7">
                    <select class="form-control input-sm select2" name="city" id="city" style="width: 100%;">
                        <option value=""><?= lang('select_your_option') ?></option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ ucwords(strtolower($city->name)) }}</option>
                        @endforeach
                    </select>
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            
            <div class="form-group form-md-line-input">
                <label class="col-lg-4 control-label"><?=lang('subdistrict')?><span class="text-danger">*</span></label>
                <div class="col-lg-7">
                    <select class="form-control input-sm select2" name="subdistrict" id="subdistrict" style="width: 100%;">
                        <option value=""><?= lang('select_your_option') ?></option>
                    </select>
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            
            <div class="form-group form-md-line-input">
                <label class="col-lg-4 control-label"><?=lang('postal_code')?><span class="text-danger">*</span></label>
                <div class="col-lg-7">
                    <input type="text" class="form-control input-sm number" name="postal_code" id="postal_code_customer" placeholder="<?=lang('postal_code')?>" maxlength="5" />
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            
            <div class="form-group form-md-line-input">
                <label class="col-lg-4 control-label"><?=lang('latitude')?></label>
                <div class="col-lg-7">
                    <input type="text" class="form-control input-sm" name="latitude" id="latitude_customer" placeholder="<?=lang('latitude')?>" maxlength="30" />
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            
            <div class="form-group form-md-line-input">
                <label class="col-lg-4 control-label"><?=lang('longitude')?></label>
                <div class="col-lg-7">
                    <input type="text" class="form-control input-sm" name="longitude" id="longitude_customer" placeholder="<?=lang('longitude')?>" maxlength="30" />
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            
            <div class="form-group form-md-line-input">
                <label class="col-lg-4 control-label"><?=lang('purchase_price_type')?><span class="text-danger">*</span></label>
                <div class="col-lg-7">
                    <select class="form-control input-sm" name="purchase_price_type" id="purchase_price_type" style="width: 100%;">
                        <option value=""><?= lang('select_your_option') ?></option>
                        <option value="dipo"><?= lang('distribution_point') ?></option>
                        <option value="partner"><?= lang('partner') ?></option>
                        <option value="customer"><?= lang('customer') ?></option>
                    </select>
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            
            <div class="form-group form-md-line-input">
                <label class="col-lg-4 control-label"><?=lang('taxable')?><span class="text-danger">*</span></label>
                <div class="col-lg-7">
                    <select class="form-control input-sm" name="taxable" id="taxable_customer" style="width: 100%;">
                        <option value=""><?= lang('select_your_option') ?></option>
                        <option value="0"><?= lang('no') ?></option>
                        <option value="1"><?= lang('yes') ?></option>
                    </select>
                    <div class="form-control-focus"> </div>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <h5>{{ lang('text_identitas_npwp') }}</h5>
                        
            <div class="form-group form-md-line-input">
                <label class="col-lg-4 control-label"><?=lang('npwp')?></label>
                <div class="col-lg-7">
                    <input type="text" class="form-control input-sm number" name="npwp" id="npwp_customer" placeholder="<?=lang('npwp')?>" maxlength="15" />
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            
            <div class="form-group form-md-line-input">
                <label class="col-lg-4 control-label"><?=lang('name')?></label>
                <div class="col-lg-7">
                    <input type="text" class="form-control input-sm" name="tax_name" id="tax_name_customer" placeholder="<?=lang('name')?>" maxlength="50" />
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            
            <div class="form-group form-md-line-input">
                <label class="col-lg-4 control-label"><?=lang('tax_invoice_address')?></label>
                <div class="col-lg-7">
                    <input type="text" class="form-control input-sm" name="tax_invoice_address" id="tax_invoice_address" placeholder="<?=lang('tax_invoice_address')?>" maxlength="150" />
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            
            <div class="form-group form-md-line-input">
                <label class="col-lg-4 control-label"><?=lang('payment_method')?></label>
                <div class="col-lg-7">
                    <select class="form-control input-sm" name="tax_payment_method" id="tax_payment_method_customer" style="width: 100%;">
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
                    <select class="form-control input-sm" name="top" id="top_customer" style="width: 100%;">
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
                    <input type="text" class="form-control input-sm" name="tax_credit_ceiling" id="tax_credit_ceiling_customer" placeholder="<?=lang('credit_ceiling')?>" maxlength="50" />
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            
            <hr>

            <h5>{{ lang('bank_account') }}</h5>
            
            <div class="form-group form-md-line-input">
                <label class="col-lg-4 control-label"><?=lang('account_number')?></label>
                <div class="col-lg-7">
                    <input type="text" class="form-control input-sm number" name="account_number" id="account_number_customer" placeholder="<?=lang('account_number')?>" maxlength="25" />
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            
            <div class="form-group form-md-line-input">
                <label class="col-lg-4 control-label"><?=lang('account_name')?></label>
                <div class="col-lg-7">
                    <input type="text" class="form-control input-sm" name="account_name" id="account_name_customer" placeholder="<?=lang('account_name')?>" maxlength="50" />
                    <div class="form-control-focus"> </div>
                </div>
            </div>

            <div class="form-group form-md-line-input">
                <label class="col-lg-4 control-label"><?=lang('bank_name')?></label>
                <div class="col-lg-7">
                    <input type="text" class="form-control input-sm" name="bank_name" id="bank_name_customer" placeholder="<?=lang('bank_name')?>" maxlength="50" />
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            
            <div class="form-group form-md-line-input">
                <label class="col-lg-4 control-label"><?=lang('bank_code')?></label>
                <div class="col-lg-7">
                    <input type="text" class="form-control input-sm number" name="bank_code" id="bank_code_customer" placeholder="<?=lang('bank_code')?>" maxlength="3" />
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            
            <div class="form-group form-md-line-input">
                <label class="col-lg-4 control-label"><?=lang('account_address')?></label>
                <div class="col-lg-7">
                    <input type="text" class="form-control input-sm" name="account_address" id="account_address_customer" placeholder="<?=lang('account_address')?>" maxlength="150" />
                    <div class="form-control-focus"> </div>
                </div>
            </div>

            <hr>
            
            <div class="form-group form-md-line-input">
                <label class="col-lg-4 control-label"><?=lang('customer_photo')?></label>
                <div class="col-lg-7">
                    <input type="file" class="form-control" name="customer_photo" id="customer_photo" accept="image/*">
                    <div class="form-control-focus"> </div>
                </div>
            </div>

            <div class="form-group form-md-line-input">
                <label class="col-lg-4 control-label"><?=lang('house_photo')?></label>
                <div class="col-lg-7">
                    <input type="file" class="form-control" name="house_photo" id="house_photo" accept="image/*">
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            
            <div class="form-group form-md-line-input">
                <label class="col-lg-4 control-label"><?=lang('warehouse_photo')?></label>
                <div class="col-lg-7">
                    <input type="file" class="form-control" name="warehouse_photo" id="warehouse_photo" accept="image/*">
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

    });

    function add_dipo(){
        $('#form-dipo')[0].reset(); 
        $('#modal_form').modal('show'); 
        $('.modal-title').text('<?=lang('new_dipo')?>'); 

        $('[name="id"]').val('');
        $('[name="city"]').val('').change();
        $('[name="subdistrict"]').val('').change();
        $('[name="zona_id"]').val('').change();
        $('[name="code"').attr('readonly',false);
    }
    toastr.options = { "positionClass": "toast-top-right", };

    // Pengaturan Datatable 
    var oTable =$('#table-dipo').dataTable({
        "responsive": false,
        "bProcessing": true,
        "bServerSide": true,
        "bLengthChange": true,
        "sServerMethod": "GET",
        "sAjaxSource": "{{ base_url() }}dipo/dipos/fetch_data",
        "columnDefs": [
            {"className": "dt-center", "targets": [11]},
            {"targets": [11], "orderable": false}
        ],
        "order": [0,"asc"],
    }).fnSetFilteringDelay(1000);

    // Pengaturan Form Validation 
    var form_validator = $("#form-dipo").validate({
        errorPlacement: function(error, element) {
            $(element).parent().closest('.form-group').append(error);
        },
        errorElement: "span",
        rules: {
            code: "required",
            name: "required",
            phone: "required",
            email: "required",
            address: "required",
            billing_address: "required",
            city: "required",
            subdistrict: "required",
            postal_code: "required",
            purchase_price_type: "required",
            taxable: "required",
            top: "required",
        },
        messages: {
            code: "{{lang('code')}}" + " {{lang('not_empty')}}",
            name: "{{lang('name')}}" + " {{lang('not_empty')}}",
            phone: "{{lang('phone')}}" + " {{lang('not_empty')}}",
            email: "{{lang('email')}}" + " {{lang('not_empty')}}",
            address: "{{lang('address')}}" + " {{lang('not_empty')}}",
            billing_address: "{{lang('billing_address')}}" + " {{lang('not_empty')}}",
            city: "{{lang('city')}}" + " {{lang('not_empty')}}",
            subdistrict: "{{lang('subdistrict')}}" + " {{lang('not_empty')}}",
            postal_code: "{{lang('postal_code')}}" + " {{lang('not_empty')}}",
            purchase_price_type: "{{lang('purchase_price_type')}}" + " {{lang('not_empty')}}",
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
                url:       '{{base_url()}}dipo/dipos/save',      
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
        $.getJSON('{{base_url()}}dipo/dipos/view', {id: value}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data;
                
                $('[name="id"]').val(row.id);
                $('[name="code"]').val(row.code);
                $('[name="name"]').val(row.name);
                $('[name="phone"]').val(row.phone);
                $('[name="fax"]').val(row.fax);
                $('[name="email"]').val(row.email);
                $('[name="address"]').val(row.address);
                $('[name="billing_address"]').val(row.billing_address);
                $('[name="city"]').val(row.city).change();
                $('[name="subdistrict"]').val(row.subdistrict).change();
                $('[name="postal_code"]').val(row.postal_code);
                $('[name="latitude"]').val(row.latitude);
                $('[name="longitude"]').val(row.longitude);
                $('[name="purchase_price_type"]').val(row.purchase_price_type).change();
                $('[name="taxable"]').val(row.taxable).change();
                $('[name="npwp"]').val(row.npwp);
                $('[name="tax_name"]').val(row.tax_name);
                $('[name="tax_invoice_address"]').val(row.tax_invoice_address);
                $('[name="tax_payment_method"]').val(row.tax_payment_method).change();
                $('[name="top"]').val(row.top).change();
                $('[name="tax_credit_ceiling"]').val(row.tax_credit_ceiling);
                $('[name="account_number"]').val(row.account_number);
                $('[name="account_name"]').val(row.account_name);
                $('[name="bank_name"]').val(row.bank_name);
                $('[name="bank_code"]').val(row.bank_code);
                $('[name="account_address"]').val(row.account_address);

                $.getJSON('{{base_url()}}get-district-by-city', {city_id: row.city}, function(json_district, textStatus) {
                    if(json_district.status == "error"){
                        toastr.error(json_district.message,'{{ lang("notification") }}');
                    }
                    else{
                        $('#subdistrict').html(json_district.tag_html);
                        $('#subdistrict').val('').change();
                    }
                    $('[name="subdistrict"]').val(row.subdistrict).change();
                    App.unblockUI('#form-wrapper');
                });
                
                $('[name="code"').attr('readonly',true);
                $('#modal_form').modal('show');
                $('.modal-title').text('<?=lang('edit_dipo')?>'); 
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
                $.getJSON('{{base_url()}}dipo/dipos/delete', {id: value}, function(json, textStatus) {
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

    $('#code').change(function(){
        if($('#code').val() != ""){
            $.getJSON('{{base_url()}}check-code-customer', {code: $('#code').val(), type: 'dipo'}, function(json, textStatus) {
                if(json.status == "error"){
                    toastr.error(json.message,'{{ lang("notification") }}');
                    $('#code').val('');
                    $('#code').focus();
                }
                else{
                    toastr.success(json.message,'{{ lang("notification") }}');                        
                }
                App.unblockUI('#form-wrapper');
            });
        }
    });

    $('#city').change(function(){
        $.getJSON('{{base_url()}}get-district-by-city', {city_id: $('#city').val()}, function(json, textStatus) {
            if(json.status == "error"){
                toastr.error(json.message,'{{ lang("notification") }}');
            }
            else{
                $('#subdistrict').html(json.tag_html);
                $('#subdistrict').val('').change();
            }
            App.unblockUI('#form-wrapper');
        });
    });

</script>
@stop