@extends('default.views.layouts.default')

@section('title') {{lang('jurnal')}} @stop

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
                <span>{{lang('jurnal')}}</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title"> {{lang('jurnal')}} </h3>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADERs-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="table-wrapper" class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-grid font-dark"></i>
                        <span class="caption-subject">{{lang('jurnal')}}</span>
                    </div>
                    <div class="tools">
                        @if($add_access == 1)
                            <button onclick="add_jurnal()" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>{{lang('new_jurnal')}}</button>
                        @endif

                        @if($print_limited_access == 1 || $print_unlimited_access == 1)
                            <button onClick="return window.open('{{base_url()}}reports/jurnal/pdf')" class="btn btn-danger btn-sm">
                                <i class="fa fa-file-pdf-o"></i> {{ lang('print_pdf') }}
                            </button>
                            <button onClick="return window.open('{{base_url()}}reports/jurnal/excel')" class="btn btn-success btn-sm">
                                <i class="fa fa-file-excel-o"></i> {{ lang('print_excel') }}
                            </button>
                        @endif
                    </div>
                </div>
                <div class="portlet-body">
                    <table id="table-jurnal" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Bulan</th>
                                <!-- <th>Reff</th> -->
                                <th>Akun</th>
                                <th>Keterangan</th>
                                <th>In/Out</th>
                                <!-- <th>PIC</th> -->
                                <th><?=lang('debet')?></th>
                                <th><?=lang('kredit')?></th>
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
        <h3 class="modal-title"><?=lang('new_jurnal')?></h3>
      </div>
      {{ form_open(null,array('id' => 'form-jurnal', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
      <div class="modal-body">
        <input type="hidden" name="id" value="">

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Tanggal<span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm datepicker" name="tanggal" id="tanggal" placeholder="<?=lang('tanggal')?>" maxlength="50" />
               <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('month')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="month" id="month" placeholder="<?=lang('month')?>" maxlength="20" />
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <!-- <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Reff</label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="reff" id="reff" placeholder="Reff" maxlength="50" />
                <div class="form-control-focus"> </div>
            </div>
        </div> -->

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Keterangan<span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="keterangan" id="keterangan" placeholder="Keterangan" maxlength="20" />
                <div class="form-control-focus"> </div>
            </div>
        </div>
        
        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">In/Out<span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <select class="form-control input-sm" name="d_k" id="d_k" style="width: 100%;">
                    <option value=""><?= lang('select_your_option') ?></option>
                    <option value="D">In</option>
                    <option value="K">Out</option>
                </select>
                <div class="form-control-focus"> </div>
            </div>
        </div>

        <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label">Reff<span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <select class="form-control input-sm" name="coa_id" id="coa_id" style="width: 100%;">
                    <option value=""><?= lang('select_your_option') ?></option>
                    <?php
                        if (!empty($chartofaccounts)) {
                            foreach ($chartofaccounts as $c) { ?>
                            <option value="<?=$c->id?>"><?=ucfirst($c->code)?>-<?=ucfirst($c->description)?></option>
                    <?php } } ?>
                </select>
                <div class="form-control-focus"> </div>
            </div>
        </div>
        
        <!-- <div class="form-group form-md-line-input">
            <label class="col-lg-4 control-label"><?=lang('pic')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="pic" id="pic" placeholder="<?=lang('pic')?>" maxlength="100" />
                <div class="form-control-focus"> </div>
            </div>
        </div> -->

        <div class="form-group form-md-line-input div-total">
            <label class="col-lg-4 control-label total-label"><?=lang('debet')?><span class="text-danger">*</span></label>
            <div class="col-lg-7">
                <input type="text" class="form-control input-sm" name="total" id="total" placeholder="<?=lang('debet')?>" maxlength="50" />
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

    $('.div-total').hide();

    $('#tanggal').change(function(){
        var date = $('#tanggal').val();
        var newdate = date.split("-").reverse().join("-");

        const formatdate = new Date(newdate);
        var month = formatdate.toLocaleString('en-us', { month: 'long' });
        $('[name="month"]').val(month);
    });

    $('#d_k').change(function(){
        var type = $('#d_k').val();
        $('.div-total').show();
        
        if(type == 'D'){
            $('.total-label').html('<?=lang('debet')?><span class="text-danger">*</span>'); 
            $('[name="total"]').attr('placeholder','<?=lang('debet')?>');
        }else{
            $('.total-label').html('<?=lang('kredit')?><span class="text-danger">*</span>'); 
            $('[name="total"]').attr('placeholder','<?=lang('kredit')?>');
        }
    });

    function add_jurnal(){
        $('#form-jurnal')[0].reset(); 
        $('#modal_form').modal('show'); 
        $('.modal-title').text('<?=lang('new_jurnal')?>'); 

        $('[name="id"]').val('');
    }
    toastr.options = { "positionClass": "toast-top-right", };

    // Pengaturan Datatable 
    var oTable =$('#table-jurnal').dataTable({
        "responsive": false,
        "bProcessing": true,
        "bServerSide": true,
        "bLengthChange": true,
        "sServerMethod": "GET",
        "sAjaxSource": "{{ base_url() }}jurnal/jurnals/fetch_data",
        "columnDefs": [
            {"className": "dt-center", "targets": [4, 5, 6]},
            {"targets": [8], "orderable": false}
        ],
        "order": [0,"asc"],
    }).fnSetFilteringDelay(1000);

    // Pengaturan Form Validation 
    var form_validator = $("#form-jurnal").validate({
        errorPlacement: function(error, element) {
            $(element).parent().closest('.form-group').append(error);
        },
        errorElement: "span",
        rules: {
            dipo_id: "required",
            code: "required",
            name: "required",
            address: "required",
            phone: "required",
            city: "required",
            subdistrict: "required",
            zona_id: "required",
            pic: "required",
            top: "required",
        },
        messages: {
            dipo_id: "{{lang('dipo')}}" + " {{lang('not_empty')}}",
            code: "{{lang('code')}}" + " {{lang('not_empty')}}",
            name: "{{lang('name')}}" + " {{lang('not_empty')}}",
            address: "{{lang('address')}}" + " {{lang('not_empty')}}",
            phone: "{{lang('phone')}}" + " {{lang('not_empty')}}",
            city: "{{lang('city')}}" + " {{lang('not_empty')}}",
            subdistrict: "{{lang('subdistrict')}}" + " {{lang('not_empty')}}",
            zona_id: "{{lang('zona')}}" + " {{lang('not_empty')}}",
            pic: "{{lang('pic')}}" + " {{lang('not_empty')}}",
            top: "{{lang('top')}}" + " {{lang('not_empty')}}",
        },
        submitHandler : function(form){
            App.blockUI({
                target: '#form-wrapper'
            });
            $(form).ajaxSubmit({  
                beforeSubmit:  showRequest,  
                success:       showResponse,
                url:       '{{base_url()}}jurnal/jurnals/save',      
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

    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [day, month, year].join('-');
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
        $.getJSON('{{base_url()}}jurnal/jurnals/view', {id: value}, function(json, textStatus) {
            if(json.status == "success"){
                var row = json.data;
                $('[name="id"]').val(row.id);
                $('[name="coa_id"]').val(row.coa_id).change();
                $('[name="tanggal"]').val(formatDate(row.jurnal_date));
                $('[name="month"]').val(row.month);
                // $('[name="reff"]').val(row.reff);
                // $('[name="pic"]').val(row.pic);
                $('[name="keterangan"]').val(row.description);
                $('[name="total"]').val(row.total);
                $('[name="d_k"]').val(row.d_k).change();

                // $('[name="code"').attr('readonly',true);

                $('#modal_form').modal('show');
                $('.modal-title').text('<?=lang('edit_jurnal')?>'); 
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
                $.getJSON('{{base_url()}}jurnal/jurnals/delete', {id: value}, function(json, textStatus) {
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