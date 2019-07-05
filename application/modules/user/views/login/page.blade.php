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
        <link href="{{ base_url() }}assets/plugins/bootstrap-toastr/toastr.css" rel="stylesheet" type="text/css" />
        <link href="{{ base_url() }}assets/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />
        <link href="{{ base_url() }}assets/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />
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

                    <div class="block-register">
                        <p><button onclick="register_customer()" class="btn btn-primary btn-md"><i class="fa fa-plus"></i>{{lang('register_customer')}}</button></p>
                        <p><button onclick="register_principal()" class="btn btn-info btn-md"><i class="fa fa-plus"></i>{{lang('register_principal')}}</button></p>
                    </div>
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

        <div class="modal fade" id="modal_form" role="dialog">
            <div class="modal-dialog" style="width:80%;">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title"><?=lang('new_partner')?></h3>
                </div>
                {{ form_open(null,array('id' => 'form-partner', 'class' => 'form-horizontal', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data')) }}
                <div class="row modal-body">
                    <div class="col-md-6">
                        <div class="form-group form-md-line-input">
                            <label class="col-lg-4 control-label"><?=lang('username')?><span class="text-danger">*</span></label>
                            <div class="col-lg-7">
                                <input type="text" class="form-control input-sm" name="username_customer" id="username_customer" placeholder="<?=lang('username')?>" maxlength="15" />
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>
                        
                        <div class="form-group form-md-line-input">
                            <label class="col-lg-4 control-label"><?=lang('code')?><span class="text-danger">*</span></label>
                            <div class="col-lg-7">
                                <input type="text" class="form-control input-sm" name="code" id="code_customer" placeholder="<?=lang('code')?>" maxlength="10" />
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>
                        
                        <div class="form-group form-md-line-input">
                            <label class="col-lg-4 control-label"><?=lang('cooperation_system')?><span class="text-danger">*</span></label>
                            <div class="col-lg-7">
                                <select class="form-control input-sm" name="type" id="type_customer" style="width: 100%;">
                                    <option value="dipo"><?= lang('distribution_point') ?></option>
                                    <option value="partner"><?= lang('partner') ?></option>
                                    <option value="independent_partner"><?= lang('independent_partner') ?></option>
                                    <!-- <option value="customer"><?= lang('customer') ?></option> -->
                                </select>
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input dipo_field">
                            <label class="col-lg-4 control-label"><?=lang('dipo')?><span class="text-danger">*</span></label>
                            <div class="col-lg-7">
                                <select class="form-control input-sm select2" name="dipo_id" id="dipo_id" style="width: 100%;">
                                    @foreach($dipos as $dipo)
                                        <option value="{{ $dipo->id }}">{{ $dipo->name }}</option>
                                    @endforeach
                                </select>
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-lg-4 control-label"><?=lang('name')?><span class="text-danger">*</span></label>
                            <div class="col-lg-7">
                                <input type="text" class="form-control input-sm" name="name" id="name_customer" placeholder="<?=lang('name')?>" maxlength="50" />
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>
                        
                        <div class="form-group form-md-line-input">
                            <label class="col-lg-4 control-label"><?=lang('pic_name')?><span class="text-danger">*</span></label>
                            <div class="col-lg-7">
                                <input type="text" class="form-control input-sm" name="pic_customer" id="pic_customer" placeholder="<?=lang('pic_name')?>" maxlength="50" />
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

                        <hr>

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
                        
                    </div>
                    <div class="col-md-6">
                    
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
                        
                        <h5>{{ lang('guarantee_collateral') }}</h5>
                        
                        <div class="form-group form-md-line-input">
                            <label class="col-lg-4 control-label"><?=lang('guarantee_form')?></label>
                            <div class="col-lg-7">
                                <input type="text" class="form-control input-sm" name="guarantee_form" id="guarantee_form" placeholder="<?=lang('guarantee_form')?>" maxlength="50" />
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-lg-4 control-label"><?=lang('guarantee_receipt')?></label>
                            <div class="col-lg-7">
                                <input type="text" class="form-control input-sm" name="guarantee_receipt" id="guarantee_receipt" placeholder="<?=lang('guarantee_receipt')?>" maxlength="50" />
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-lg-4 control-label"><?=lang('safety_box')?></label>
                            <div class="col-lg-7">
                                <input type="text" class="form-control input-sm" name="safety_box" id="safety_box" placeholder="<?=lang('safety_box')?>" maxlength="50" />
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-lg-4 control-label"><?=lang('guarantee_photo')?></label>
                            <div class="col-lg-7">
                                <input type="file" class="form-control" name="guarantee_photo" id="guarantee_photo" accept="image/*">
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
                    <button type="submit" id="btnSaveCustomer" class="btn btn-primary">{{ lang('save') }}</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ lang('close') }}</button>
                </div>
                {{ form_close() }}
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal fade" id="modal_form_principal" role="dialog">
            <div class="modal-dialog" style="width:80%;">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title"><?=lang('new_principle')?></h3>
                </div>
                {{ form_open(null,array('id' => 'form-principal', 'class' => 'form-horizontal', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data')) }}
                <div class="row modal-body">
                    <div class="col-md-6">
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
                    <button type="submit" id="btnSavePrincipal"  class="btn btn-primary">{{ lang('save') }}</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ lang('close') }}</button>
                </div>
                {{ form_close() }}
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

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
        <script src="{{ base_url() }}assets/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{ base_url() }}assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/form/jquery.form.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
        <script src="{{ base_url() }}assets/plugins/jquery-mask/jquery.mask.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{ base_url() }}assets/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{ base_url() }}assets/scripts/login-4.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->

        <script type="text/javascript">
            $(function(){
                $('.select2').select2();
                $('.number').mask('0000000000000000000000000');

                $('.dipo_field').hide();

            });

            toastr.options = { "positionClass": "toast-top-right", "timeOut": "10000",};

            function register_customer(){
                $('#form-partner')[0].reset(); 
                $('#modal_form').modal('show'); 
                $('.modal-title').text('<?=lang('new_customer')?>'); 
            }

            // Pengaturan Form Validation Customer
            var form_validator = $("#form-partner").validate({
                errorPlacement: function(error, element) {
                    $(element).parent().closest('.form-group').append(error);
                },
                errorElement: "span",
                rules: {
                    username_customer: "required",
                    code: "required",
                    type: "required",
                    name: "required",
                    pic_customer: "required",
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
                    username_customer: "{{lang('username')}}" + " {{lang('not_empty')}}",
                    code: "{{lang('code')}}" + " {{lang('not_empty')}}",
                    type: "{{lang('cooperation_system')}}" + " {{lang('not_empty')}}",
                    name: "{{lang('name')}}" + " {{lang('not_empty')}}",
                    pic_customer: "{{lang('pic_name')}}" + " {{lang('not_empty')}}",
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
                        url:       '{{ base_url() . "register-customer" }}',
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

            $('#username_customer').change(function(){
                if($('#username_customer').val() != "" && $('#code_customer').val() != ""){
                    $.getJSON('{{base_url()}}check-code-customer', {code: $('#code_customer').val(), username: $('#username_customer').val(), type: $('#type_customer').val()}, function(json, textStatus) {
                        if(json.status == "error"){
                            toastr.error(json.message,'{{ lang("notification") }}');
                            $('#username_customer').val('');
                            $('#username_customer').focus();
                        }
                        else{
                            toastr.success(json.message,'{{ lang("notification") }}');                        
                        }
                        App.unblockUI('#form-wrapper');
                    });
                }
            });

            $('#code_customer').change(function(){
                if($('#username_customer').val() != "" && $('#code_customer').val() != ""){
                    $.getJSON('{{base_url()}}check-code-customer', {code: $('#code_customer').val(), username: $('#username_customer').val(), type: $('#type_customer').val()}, function(json, textStatus) {
                        if(json.status == "error"){
                            toastr.error(json.message,'{{ lang("notification") }}');
                            $('#code_customer').val('');
                            $('#code_customer').focus();
                        }
                        else{
                            toastr.success(json.message,'{{ lang("notification") }}');                        
                        }
                        App.unblockUI('#form-wrapper');
                    });
                }
            });

            $('#type_customer').change(function(){
                if($('#username_customer').val() != "" && $('#code_customer').val() != ""){
                    $.getJSON('{{base_url()}}check-code-customer', {code: $('#code_customer').val(), username: $('#username_customer').val(), type: $('#type_customer').val()}, function(json, textStatus) {
                        if(json.status == "error"){
                            toastr.error(json.message,'{{ lang("notification") }}');
                            $('#username_customer').val('');
                            $('#code_customer').val('');
                            $('#username_customer').focus();
                        }
                        else{
                            toastr.success(json.message,'{{ lang("notification") }}');                        
                        }
                        App.unblockUI('#form-wrapper');
                    });
                }

                if($('#type_customer').val() == 'partner'){
                    $('.dipo_field').hide();
                }
                else{
                    $('.dipo_field').show();
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


            // BLOCK PRINCIPAL

            function register_principal(){
                $('#form-principal')[0].reset(); 
                $('#modal_form_principal').modal('show'); 
                $('.modal-title').text('<?=lang('new_principle')?>'); 
            }
            
            $('#code_principal').change(function(){
                $.getJSON('{{base_url()}}check-code-principal', {code: $('#code_principal').val(), type: 'principal'}, function(json, textStatus) {
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

            // Pengaturan Form Validation Principal
            var form_validator = $("#form-principal").validate({
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
                        url:       '{{ base_url() . "register-principal" }}',
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
                
        </script>
    </body>

</html>