<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.6
Version: 4.5.4
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>{{ lang('system_name') }}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta name="description" content="{{ lang('system_description') }}">
        <meta name="keywords" content="{{ lang('system_keywords') }}">
        <meta name="author" content="{{ lang('system_author') }}">

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ base_url() }}assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ base_url() }}assets/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ base_url() }}assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ base_url() }}assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="{{ base_url() }}assets/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{ base_url() }}assets/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ base_url() }}assets/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="{{ base_url() }}assets/css/login.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ base_url() }}assets/css/login-custom.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <link rel="shortcut icon" href="{{ base_url() }}assets/img/favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN LOGIN -->
        <div class="content">
            <div class="row">
                <div class="col-md-6" style="padding-top:25px;">
                    <!-- BEGIN LOGO -->
                    <div class="logo">
                        <img class="img-logo" src="{{ base_url() }}assets/img/logo.png"/>
                        <h3>{{ lang('system_name') }}<br/> <small> </small></h3>
                    </div>
                    <!-- END LOGO -->
                </div>
                
                <div class="col-md-6">
                    <!-- BEGIN LOGIN FORM -->
                    {{ form_open('auth/login', $form_attributes) }}

                    @if (!empty($message))

                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        {{ $message }}
                    </div>

                    @endif
                    
                        <h3 class="form-title">{{ lang('login_to_your_account') }}</h3>
                        <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button>
                            <span> {{ lang('enter_any_username_and_password') }} </span>
                        </div>
                        <div class="form-group form-md-line-input has-success">
                            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                            <label class="control-label visible-ie8 visible-ie9">{{ lang('username') }}</label>
                            <div class="input-icon">
                                <i class="fa fa-user"></i>
                               {{ form_input($username) }}
                            </div>
                        </div>
                        <div class="form-group form-md-line-input has-success">
                            <label class="control-label visible-ie8 visible-ie9">{{ lang('password') }}</label>
                            <div class="input-icon">
                                <i class="fa fa-lock"></i>
                                {{ form_password($password) }}
                            </div>
                        </div>
                        <div class="form-actions">
                            <label class="checkbox" style="color: #000000">
                                <input type="checkbox" name="remember" value="1" /> {{ lang('remember_me') }} </label>
                            <button type="submit" class="btn green pull-right"> {{ lang('login') }} </button>
                        </div>
                        <div class="forget-password">
                            <h4>{{ lang('forgot_your_password') }}</h4>
                            <p> {{ lang('click') }}
                                <a href="javascript:;" id="forget-password"> {{ lang('here') }} </a> {{ lang('to_reset_your_password') }} </p>
                        </div>
                    {{ form_close() }}
                    <!-- END LOGIN FORM -->
                    
                    <!-- BEGIN FORGOT PASSWORD FORM -->
                    <form class="forget-form" action="{{ base_url() . "forgot-password" }}" method="post">
                        <input type="hidden" name="{{ $csrftoken_name }}" value="{{ $csrftoken_value }}" />
                        <h3>{{ lang('forgot_your_password') }}</h3>
                        <p>{{ lang('enter_your_email_address_below_to_reset_your_password') }}</p>
                        <div class="form-group form-md-line-input has-success">
                            <div class="input-icon">
                                <i class="fa fa-envelope"></i>
                                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
                        </div>
                        <div class="form-actions">
                            <button type="button" id="back-btn" class="btn red btn-outline">{{ lang('back') }}</button>
                            <button type="submit" class="btn green pull-right">{{ lang('submit') }}</button>
                        </div>
                    </form>
                    <!-- END FORGOT PASSWORD FORM -->
                </div>
            </div>
            
        </div>
        <!-- END LOGIN -->
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
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
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{ base_url() }}assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{ base_url() }}assets/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{ base_url() }}assets/scripts/login-4.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>