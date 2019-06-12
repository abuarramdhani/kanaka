<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@section('title') @show</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta name="description" content="{{ lang('system_description') }}">
        <meta name="keywords" content="{{ lang('system_keywords') }}">
        <meta name="author" content="{{ lang('system_author') }}">

        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ base_url() }}assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ base_url() }}assets/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ base_url() }}assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ base_url() }}assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="{{ base_url() }}assets/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ base_url() }}assets/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ base_url() }}assets/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="{{ base_url() }}assets/plugins/bootstrap-toastr/toastr.css" rel="stylesheet" type="text/css" />
        <link href="{{ base_url() }}assets/plugins/confirm/css/jquery-confirm.css" rel="stylesheet" type="text/css" />
        <link href="{{ base_url() }}assets/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />
        <link href="{{ base_url() }}assets/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="{{ base_url() }}assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ base_url() }}assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ base_url() }}assets/plugins/easy-autocomplete/easy-autocomplete.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ base_url() }}assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
        <link href="{{ base_url() }}assets/plugins/tipso/src/tipso.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ base_url() }}assets/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ base_url() }}assets/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ base_url() }}assets/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ base_url() }}assets/css/themes/light.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{ base_url() }}assets/css/custom.css" rel="stylesheet" type="text/css" />

        <link rel="icon" href="{{ base_url() }}assets/img/favicon.ico" />
    </head>

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="#">
                        <img src="{{ base_url() }}assets/img/logo-nav.png" alt="logo" class="logo-default" /> </a>
                    <!-- <h4 class="logo-default font-white pull-left">TIK Systems</h4> -->
                    <div class="menu-toggler sidebar-toggler" onclick="toggle()"></div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <img alt="" class="img-circle" src="{{ base_url() }}assets/img/avatar.png" />
                                <span class="username username-hide-on-mobile"> {{ ucfirst(auth_username()) }} </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="{{ base_url() }}profile">
                                        <i class="icon-user"></i> {{ lang('my_profile') }} </a>
                                </li>
                                <!-- <li>
                                    <a href="{{ base_url() }}notification">
                                        <i class="icon-bell"></i> {{ lang('notif_event') }} </a>
                                </li> -->
                                <li>
                                    <a href="{{ base_url() }}logout">
                                        <i class="icon-key"></i> {{ lang('logout') }} </a>
                                </li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->

                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">

                        <li class="sidebar-toggler-wrapper hide">
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <div class="sidebar-toggler"> </div>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                        </li>

                        <li class="heading">
                            <h3 class="uppercase">{{ lang('navigation') }}</h3>
                        </li>
                        @include('default.views.layouts.menu')
                    </ul>
                    <!-- END SIDEBAR MENU -->
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                @yield('body')
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->

            <!-- List Reminder  -->
            <!-- <div id="reminder" style="z-index:99999;background-color:#F1F1F1;">
                <div id="scollReminder">
                    <div class="col-md-12" style="padding-top: 10px;">
                       
                       <a href="{{base_url()}}">
                           <div class="alert alert-danger">
                                <strong> Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</strong>
                           </div>
                       </a>
                       <a href="{{base_url()}}">
                           <div class="alert alert-danger">
                                <strong> Lorem ipsum dolor sit amet, ei ius rebum dicit quaeque.</strong>
                           </div>
                       </a>
                    </div>
                </div>
            </div>
             <div id="btn-reminder" style="position:absolute;right:0;top:60px;">
                <button class="btn yellow-crusta"><i class="fa fa-bell"></i>Info <span class="badge badge-danger"> 2 </span></button>
            </div> -->
           
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner"> {{ lang('system_production_year') }} &copy; {{ lang('system_author') }}</div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- END FOOTER -->
        <!--[if lt IE 9]>
        <script src="{{ base_url() }}assets/plugins/respond.min.js"></script>
        <script src="{{ base_url() }}assets/plugins/excanvas.min.js"></script>
        <![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="{{ base_url() }}assets/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{ base_url() }}assets/scripts/datatable.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/datatables/fnPagingInfo.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/datatables/jquery.dataTables.delay.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{ base_url() }}assets/scripts/app.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{ base_url() }}assets/scripts/table-datatables-responsive.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="{{ base_url() }}assets/scripts/layout.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/scripts/demo.min.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/scripts/knockout-3.4.0.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/jquery-validation/js/jquery.validate.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/form/jquery.form.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/confirm/js/jquery-confirm.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/bootstrap-select/js/bootstrap-select.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/moment.min.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/currency/currency.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/jquery-mask/jquery.mask.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/jquery.chained.min.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/jquery.chained.remote.min.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/easy-autocomplete/jquery.easy-autocomplete.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/select2/js/select2.full.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/input-mask/inputmask.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/highcharts/js/highcharts.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/tipso/src/tipso.min.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/scripts/slidereveal.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/noty/packaged/jquery.noty.packaged.min.js" type="text/javascript" ></script>
        <script src="{{ base_url() }}assets/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/ckeditor/adapters/jquery.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <script type="text/javascript">    
            $(function() {
                $("input[type='search']").focus();
                $('.select2').select2();
                $('.number').mask('000000000000000');
                $(".currency").inputmask("999,999,999",{numericInput:!0,rightAlignNumerics:!1,greedy:!1});
                $(".currency_decimal").inputmask("999,999,999.99",{numericInput:!0,rightAlignNumerics:!1,greedy:!1});
                $('.datepicker').datepicker({
                    autoclose: true,
                    format: 'dd-mm-yyyy',
                    todayBtn: 'linked',
                    todayHighlight: true,
                    clearBtn: true,
                });
            });
        </script>
        <!-- Reminder -->
        <script type="text/javascript">
            // $("#reminder").slideReveal({
            //   trigger: $("#btn-reminder"),
            //   'position': 'right'
            // }); 

            // $('#scollReminder').slimScroll({
            //     position: 'left',
            //     height: 'auto',
            //     railVisible: true,
            //     alwaysVisible: true
            // });
            
        </script>
        @section('scripts') @show
    </body>
</html>