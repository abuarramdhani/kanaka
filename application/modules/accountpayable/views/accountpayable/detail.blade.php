@extends('default.views.layouts.default')

@section('title') {{lang('accountpayable')}} @stop

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
                <span>{{lang('accountpayable')}}</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title"> {{lang('accountpayable')}} - {{ ucwords($customer->name) }} </h3>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADERs-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="table-wrapper" class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-grid font-dark"></i>
                        <span class="caption-subject">{{lang('accountpayable')}}</span>
                    </div>
                    <div class="tools">
                        <button onclick="return window.location='{{ base_url() }}reports/accountpayable'" class="btn btn-default btn-sm">
                            <i class="fa fa-chevron-left"></i> {{ lang('back') }}
                        </button>

                        @if($print_limited_access == 1 || $print_unlimited_access == 1)
                            <button onClick="return window.open('{{base_url()}}reports/accountpayable/pdf_detail/{{ $customer_id }}')" class="btn btn-danger btn-sm">
                                <i class="fa fa-file-pdf-o"></i> {{ lang('print_pdf') }}
                            </button>
                            <button onClick="return window.open('{{base_url()}}reports/accountpayable/excel_detail/{{ $customer_id }}')" class="btn btn-success btn-sm">
                                <i class="fa fa-file-excel-o"></i> {{ lang('print_excel') }}
                            </button>
                        @endif
                    </div>
                </div>
                <div class="portlet-body">
                    <table id="table-accountpayable-detail" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                        <thead>
                            <tr>
                                <th style="text-align: center;">No</th>
                                <th style="text-align: center;"><?=lang('name')?></th>
                                <th style="text-align: center;"><?=lang('nominal')?></th>
                                <th style="text-align: center;"><?=lang('invoice_no')?></th>
                                <th style="text-align: center;"><?=lang('due_date')?></th>
                                <th style="text-align: center;">0-30</th>
                                <th style="text-align: center;">31-60</th>
                                <th style="text-align: center;">61-90</th>
                                <th style="text-align: center;">> 90</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLES PORTLET-->
        </div>
    </div>
</div>

@stop

@section('scripts')
<script type="text/javascript">
    $(function(){

    });

    // Pengaturan Datatable 
    var oTable =$('#table-accountpayable-detail').dataTable({
        "responsive": false,
        "bProcessing": true,
        "bServerSide": true,
        "bLengthChange": true,
        "sServerMethod": "GET",
        "sAjaxSource": "{{ base_url() }}accountpayable/accountpayables/fetch_data_detail/{{ $customer_id }}",
        "columnDefs": [
            {"className": "dt-center", "targets": [3, 4]},
            {"className": "dt-right", "targets": [2, 5, 6, 7, 8]},
            {"targets": [2, 5, 6, 7, 8], "orderable": false}
        ],
        "order": [0,"asc"],
    }).fnSetFilteringDelay(1000);


</script>
@stop