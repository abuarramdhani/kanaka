@extends('default.views.layouts.default')

@section('title') {{lang('profit_loss')}} @stop

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
                <span>{{lang('profit_loss')}}</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title"> {{lang('profit_loss')}} </h3>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADERs-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="table-wrapper" class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-grid font-dark"></i>
                        <span class="caption-subject">{{lang('profit_loss')}}</span>
                    </div>
                    <div class="tools">
                        
                    </div>
                </div>
                <div class="portlet-body">
                    {{ form_open(base_url().'reports/profitloss/show',array('id' => 'form-profit-loss', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
                        <div class="form-group form-md-line-input">
                            <label class="col-lg-3 control-label"><?=lang('period')?><span class="text-danger">*</span></label>
                            <div class="col-lg-5">
                                <select class="form-control input-sm" name="period" id="period" required="required">
                                    <option value=""><?= lang('select_your_option') ?></option>
                                    @for($i=2019; $i<=date('Y'); $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>
                        
                        <div class="form-group form-md-line-input">
                            <label class="col-lg-3 control-label">&nbsp;</label>
                            <div class="col-lg-5">
                                <button type="submit" id="btnOk" class="btn btn-primary">{{ lang('submit') }}</button>
                                <button type="reset" class="btn btn-default">{{ lang('reset') }}</button>
                            </div>
                        </div>
                        
                    {{ form_close() }}
                </div>
            </div>
            <!-- END EXAMPLE TABLES PORTLET-->
        </div>
    </div>
</div>

@stop

@section('scripts')
<script type="text/javascript">

</script>
@stop