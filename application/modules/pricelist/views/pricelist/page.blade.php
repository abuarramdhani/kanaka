@extends('default.views.layouts.default')

@section('title') {{lang('pricelist')}} @stop

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
                <span>{{lang('pricelist')}}</span>
            </li>
        </ul>
        
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title"> {{lang('pricelist')}} </h3>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADERs-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="table-wrapper" class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-grid font-dark"></i>
                        <span class="caption-subject">{{lang('pricelist')}}</span>
                    </div>
                    <div class="tools">
                        @if($add_access == 1)
                            <button onclick="add_pricelist()" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>{{lang('new_pricelist')}}</button>
                        @endif

                        @if($print_limited_access == 1 || $print_unlimited_access == 1)
                            <button onClick="return window.open('{{base_url()}}master/pricelist/pdf')" class="btn btn-danger btn-sm">
                                <i class="fa fa-file-pdf-o"></i> {{ lang('print_pdf') }}
                            </button>
                            <button onClick="return window.open('{{base_url()}}master/pricelist/excel')" class="btn btn-success btn-sm">
                                <i class="fa fa-file-excel-o"></i> {{ lang('print_excel') }}
                            </button>
                        @endif
                    </div>
                </div>
                <div class="portlet-body">
                    <table id="table-pricelist" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                        <thead>
                            <tr>
                                <th rowspan="3" class="text-center"><?=lang('product_code')?></th>
                                <th colspan="2" class="text-center"><?=lang('barcode')?></th>
                                <th rowspan="3" class="text-center"><?=lang('product_name')?></th>
                                <th rowspan="3" class="text-center"><?=lang('packing_size')?></th>
                                <th rowspan="3" class="text-center"><?=lang('qty_per_ctn')?></th>
                                <th colspan="4" class="text-center"><?=lang('carton_dimension')?></th>
                                <th rowspan="3" class="text-center"><?=lang('weight')?></th>
                                <th rowspan="3" class="text-center"><?=lang('normal_price')?></th>
                                <th colspan="5" class="text-center"><?=lang('kanaka')?></th>
                                <th colspan="5" class="text-center">DIST-POINT (DIPO)</th>
                                <th rowspan="3" class="text-center"><?=lang('created_date')?></th>
                                <th rowspan="3" width="13%"><?=lang('options')?></th>
                            </tr>
                            <tr>
                                <th rowspan="2"><?=lang('product')?></th>
                                <th rowspan="2"><?=lang('carton')?></th> 
                                <th rowspan="2">L</th> 
                                <th rowspan="2">W</th> 
                                <th rowspan="2">H</th> 
                                <th rowspan="2">Vol (m<sup>3</sup>)</th> 
                                <th colspan="2"><?=lang('before_tax')?></th> 
                                <th colspan="2"><?=lang('after_tax')?></th> 
                                <th rowspan="2" class="text-center"><?=lang('stock_availibility')?></th>
                                <th colspan="2"><?=lang('before_tax')?></th> 
                                <th colspan="3"><?=lang('after_tax')?></th>
                            </tr>
                            <tr>
                                <th><?=lang('in_pcs')?></th> 
                                <th><?=lang('in_ctn')?></th> 
                                <th><?=lang('in_pcs')?></th> 
                                <th><?=lang('in_ctn')?></th> 
                                <th><?=lang('in_ctn')?></th> 
                                <th><?=lang('in_pcs')?></th> 
                                <th><?=lang('in_ctn')?></th> 
                                <th><?=lang('in_pcs')?></th> 
                                <th><?=lang('in_ctn')?></th> 
                                <th><?=lang('round_up_in_ctn')?></th> 
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
        <h3 class="modal-title"><?=lang('new_pricelist')?></h3>
      </div>
      {{ form_open(null,array('id' => 'form-pricelist', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
      <div class="modal-body">
        <input type="hidden" name="id" value="">

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('product_code')?><span class="text-danger">*</span></label>
            <div class="col-md-7">
                <select id="product_code" name="product_id" class="form-control">
                    <option selected disabled value=""><?=lang('select')?> <?=lang('product_code')?></option>
                <?php
                    if (!empty($products)) {
                        foreach ($products as $c) { ?>
                        <option value="<?=$c->id?>"><?=ucfirst($c->product_code)?></option>
                <?php } } ?>
                </select>  
            </div>  
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('barcode')?></label>
            <div class="col-lg-7">
                <input disabled="disabled" type="text" class="form-control input-sm" name="barcode_product" id="barcode_product" placeholder="<?=lang('product')?>" maxlength="50" />
                <input disabled="disabled" type="text" class="form-control input-sm" name="barcode_carton" id="barcode_carton" placeholder="<?=lang('carton')?>" maxlength="50" />
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('product_name')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input disabled="disabled" type="text" class="form-control input-sm" name="name" id="name" placeholder="<?=lang('name')?>" maxlength="50" />
                <div class="form-control-focus"> </div>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('packing_size')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input disabled="disabled" type="text" class="form-control input-sm" name="packing_size" id="packing_size" placeholder="<?=lang('packing_size')?>" maxlength="50" />
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('qty_per_ctn')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input disabled="disabled" type="number" class="form-control input-sm" name="qty" id="qty" placeholder="<?=lang('qty_per_ctn')?>" maxlength="50" />
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('carton_dimension')?></label>
            <div class="col-lg-7 form-inline">
                <input disabled="disabled" type="number" class="form-control input-sm" name="length" id="length" placeholder="Length" maxlength="20" />
                <input disabled="disabled" type="number" class="form-control input-sm" name="width" id="width" placeholder="Width" maxlength="20" />
                <input disabled="disabled" type="number" class="form-control input-sm" name="height" id="height" placeholder="Height" maxlength="20" />
                <input disabled="disabled" type="number" class="form-control input-sm" name="volume" id="volume" placeholder="Volume" maxlength="20" />
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('weight')?></label>
            <div class="col-lg-7">
                <input disabled="disabled" type="number" class="form-control input-sm" name="weight" id="weight" placeholder="<?=lang('weight')?>" maxlength="50" />
                <div class="form-control-focus"> </div>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('normal_price')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="normal_price" id="normal_price" placeholder="<?=lang('normal_price')?>" maxlength="50" />
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('stock_availibility')?><span class="text-danger">*</span></label>
            <div class="col-md-7">
                <select name="stock_availibility" class="form-control">
                    <option value="0"><?=lang('out_of_stock')?></option>
                    <option value="1"><?=lang('available')?></option>
                </select>  
            </div>  
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('after_tax')?> <?=lang('in_ctn')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input oninput="get_pricelist()" type="text" class="form-control input-sm" name="company_after_tax_ctn" id="company_after_tax_ctn" placeholder="<?=lang('after_tax')?> <?=lang('in_ctn')?>" maxlength="50" />
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <input type="number" name="company_before_tax_pcs" value="">
        <input type="number" name="company_before_tax_ctn" value="">
        <input type="number" name="company_after_tax_pcs" value="">
        <input type="number" name="dipo_before_tax_pcs" value="">
        <input type="number" name="dipo_before_tax_ctn" value="">
        <input type="number" name="dipo_after_tax_pcs" value="">
        <input type="number" name="dipo_after_tax_ctn" value="">
        <input type="number" name="dipo_after_tax_round_up" value="">
        <input type="number" name="mitra_before_tax_pcs" value="">
        <input type="number" name="mitra_before_tax_ctn" value="">
        <input type="number" name="mitra_after_tax_pcs" value="">
        <input type="number" name="mitra_after_tax_ctn" value="">
        <input type="number" name="mitra_after_tax_round_up" value="">
        <input type="number" name="customer_before_tax_pcs" value="">
        <input type="number" name="customer_before_tax_ctn" value="">
        <input type="number" name="customer_after_tax_pcs" value="">
        <input type="number" name="customer_after_tax_ctn" value="">
        <input type="number" name="customer_after_tax_round_up" value="">
        <input type="number" name="het_round_up_pcs" value="">
        <input type="number" name="het_round_up_ctn" value="">

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
    $('#product_code').change(function(){
        $.getJSON('{{base_url()}}pricelist/pricelists/getProductData', {id: $('#product_code').val()}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data;
                var i;
                var html = "";

                $('[name="barcode_pricelist"]').val(row.barcode_pricelist);
                $('[name="barcode_carton"]').val(row.barcode_carton);
                $('[name="name"]').val(row.name);
                $('[name="packing_size"]').val(row.packing_size);
                $('[name="qty"]').val(row.qty);
                $('[name="length"]').val(row.length);
                $('[name="width"]').val(row.width);
                $('[name="height"]').val(row.height);
                $('[name="volume"]').val(row.volume);
                $('[name="weight"]').val(row.weight);
                $('[name="normal_price"]').focus();

            }else if(json.status == "error"){
                toastr.error('{{ lang("data_not_found") }}','{{ lang("notification") }}');
            }
            App.unblockUI('#form-wrapper');
       });
    });

    function get_pricelist(){
        var company_before_tax_ctn = $('[name="company_after_tax_ctn"]').val()/1.1;
        $('[name="company_before_tax_ctn"]').val(company_before_tax_ctn);

        var company_before_tax_pcs = $('[name="company_before_tax_ctn"]').val()/$('[name="qty"]').val();
        $('[name="company_before_tax_pcs"]').val(company_before_tax_pcs);

        var company_after_tax_pcs = $('[name="company_after_tax_ctn"]').val();
        var dipo_before_tax_pcs = $('[name="company_after_tax_ctn"]').val();
        var dipo_before_tax_ctn = $('[name="company_after_tax_ctn"]').val();
        var dipo_after_tax_pcs = $('[name="company_after_tax_ctn"]').val();
        var dipo_after_tax_ctn = $('[name="company_after_tax_ctn"]').val();
        var dipo_after_tax_round_up = $('[name="company_after_tax_ctn"]').val();
        var mitra_before_tax_pcs = $('[name="company_after_tax_ctn"]').val();
        var mitra_before_tax_ctn = $('[name="company_after_tax_ctn"]').val();
        var mitra_after_tax_pcs = $('[name="company_after_tax_ctn"]').val();
        var mitra_after_tax_ctn = $('[name="company_after_tax_ctn"]').val();
        var mitra_after_tax_round_up = $('[name="company_after_tax_ctn"]').val();
        var customer_before_tax_pcs = $('[name="company_after_tax_ctn"]').val();
        var customer_before_tax_ctn = $('[name="company_after_tax_ctn"]').val();
        var customer_after_tax_pcs = $('[name="company_after_tax_ctn"]').val();
        var customer_after_tax_ctn = $('[name="company_after_tax_ctn"]').val();
        var customer_after_tax_round_up = $('[name="company_after_tax_ctn"]').val();
        var het_round_up_pcs = $('[name="company_after_tax_ctn"]').val();
        var het_round_up_ctn = $('[name="company_after_tax_ctn"]').val();

        if(length != '' && height != '' && width != ''){
            var volume = (length * height * width)/100;
        }

        $('#volume').val(volume);
    }

    function add_pricelist(){
        $('#form-pricelist')[0].reset(); 
        $('#modal_form').modal('show'); 
        $('.modal-title').text('<?=lang('new_pricelist')?>'); 

        $('[name="id"]').val('');
    }
    toastr.options = { "positionClass": "toast-top-right", };

    // Pengaturan Datatable 
    var oTable =$('#table-pricelist').dataTable({
        "bProcessing": true,
        "bServerSide": true,
        "bLengthChange": true,
        "sServerMethod": "GET",
        "sAjaxSource": "{{ base_url() }}pricelist/pricelists/fetch_data",
        "columnDefs": [
            {"className": "dt-center", "targets": [11]},
            {"targets": [11], "orderable": false}
        ],
        "order": [0,"asc"],
    }).fnSetFilteringDelay(1000);

    // Pengaturan Form Validation 
    var form_validator = $("#form-pricelist").validate({
        errorPlacement: function(error, element) {
            $(element).parent().closest('.form-group').append(error);
        },
        errorElement: "span",
        rules: {
            name: "required",
            pricelist_code: "required",
            packing_size: "required",
            qty: "required",
            category_id: "required",
        },
        messages: {
            name: "{{lang('pricelist_name')}}" + " {{lang('not_empty')}}",
            pricelist_code: "{{lang('pricelist_code')}}" + " {{lang('not_empty')}}",
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
                url:       '{{base_url()}}pricelist/pricelists/save',      
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
        $.getJSON('{{base_url()}}pricelist/pricelists/view', {id: value}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data;
                var rowImage = json.image;
                var i;
                var html = "";

                $('[name="id"]').val(row.id);
                $('[name="pricelist_code"]').val(row.pricelist_code);
                $('[name="barcode_pricelist"]').val(row.barcode_pricelist);
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
                    html += '<div class="pricelist-image"> <a href="javascript:void()" onclick="deleteImage(' + rowImage[i].id + ')" class="btn btn-danger btn-icon-only btn-circle" title="DELETE"><i class="fa fa-trash-o"></i></a><img width="150" style="padding: 10px;" src="{{ base_url() }}uploads/images/pricelists/' + rowImage[i].image + '"></div>';
                }
               
                $('.preview-upload-image').html(html);
                $('#preview-upload-image-field').show();

                $('#modal_form').modal('show');
                $('.modal-title').text('<?=lang('edit_pricelist')?>'); 
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
                $.getJSON('{{base_url()}}pricelist/pricelists/delete', {id: value}, function(json, textStatus) {
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