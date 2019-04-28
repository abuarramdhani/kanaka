<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'dashboard/dashboard/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/**
 * DASHBOARD
 */
$route['dashboard'] = 'dashboard/dashboard/index';
	
$route['login'] = 'user/users/login';
$route['auth/login'] = 'user/users/login';
$route['logout']	= 'user/users/logout';
$route['profile'] = 'user/users/profile';
$route['profile/save'] = 'user/users/profile_save';
$route['profile/data'] = 'user/users/profile_data';
$route['change-password'] = 'user/users/change_password';
$route['change-password/save'] = 'user/users/change_password_save';
$route['forgot-password']	= "user/users/forgot_password";
$route['reset-password/(:any)'] = "user/users/reset_password/$1";

/**
* MENU
*/
$route['master/menu'] = 'menu/menus/index';
$route['master/menu/fetch-data']	= 'menu/menus/fetch_data';
$route['master/menu/save'] = 'menu/menus/save';
$route['master/menu/update'] = 'menu/menus/update';
$route['master/menu/view']	= 'menu/menus/view';
$route['master/menu/delete'] = 'menu/menus/delete';

/**
* USER
*/
$route['master/users/account'] = 'user/users/index';
$route['master/users/account/fetch-data'] = 'user/users/fetch_data';
$route['master/users/save'] = 'user/users/save';
$route['master/users/view']	= 'user/users/view';
$route['master/users/update'] = 'user/users/update';
$route['master/users/delete'] = 'user/users/delete';
$route['master/users/reset-password'] = 'user/users/reset_password';

/**
* USER MENU
*/
$route['master/users/usermenu/(:any)'] = 'user/users_menu/index/$1';
$route['master/users/usermenu/fetch-data/(:any)']	= 'user/users_menu/fetch_data/$1';
$route['master/users/usermenu/save'] = 'user/users_menu/save';

/**
* LOGS
*/
$route['logs'] = 'log/activities/index';
$route['logs/fetch-data-group'] = 'log/activities/fetch_data_group';
$route['logs/fetch-data/(:any)'] = 'log/activities/fetch_data/$1';
$route['logs/lists/(:any)'] = 'log/activities/lists/$1';
$route['logs/detail/(:any)']	= 'log/activities/detail/$1';

/**
* BRAND
*/
$route['master/brand'] = 'brand/brands/index';
$route['master/brand/pdf']	= 'brand/brands/pdf';
$route['master/brand/excel']	= 'brand/brands/excel';

/**
* AREA
*/
$route['master/area'] = 'area/areas/index';
$route['master/area/pdf']	= 'area/areas/pdf';
$route['master/area/excel']	= 'area/areas/excel';

/**
* PRODUCT
*/
$route['master/product'] = 'product/products/index';
$route['master/product/pdf']	= 'product/products/pdf';
$route['master/product/excel']	= 'product/products/excel';

/**
* DIPO
*/
$route['master/dipo'] = 'dipo/dipos/index';
$route['master/dipo/pdf']	= 'dipo/dipos/pdf';
$route['master/dipo/excel']	= 'dipo/dipos/excel';

/**
* PARTNER
*/
$route['master/partner'] = 'partner/partners/index';
$route['master/partner/pdf']	= 'partner/partners/pdf';
$route['master/partner/excel']	= 'partner/partners/excel';

/**
* TRANSFER
*/
$route['master/transfer'] = 'transfer/transfers/index';
$route['master/transfer/pdf']	= 'transfer/transfers/pdf';
$route['master/transfer/excel']	= 'transfer/transfers/excel';

/**
* CUSTOMER REPORT
*/
$route['report/customer'] = 'customer/customers/index';
$route['report/customer/pdf']	= 'customer/customers/pdf';
$route['report/customer/excel']	= 'customer/customers/excel';

/**
* COMPANY REPORT
*/
$route['report/company'] = 'company/companies/index';
$route['report/company/pdf']	= 'company/companies/pdf';
$route['report/company/excel']	= 'company/companies/excel';

/**
* DIPO REPORT
*/
$route['report/dipo_report'] = 'dipo_report/dipo_reports/index';
$route['report/dipo_report/pdf']	= 'dipo_report/dipo_reports/pdf';
$route['report/dipo_report/excel']	= 'dipo_report/dipo_reports/excel';

/**
* PARTNER REPORT
*/
$route['report/partner'] = 'partner/partners/index';
$route['report/partner/pdf']	= 'partner/partners/pdf';
$route['report/partner/excel']	= 'partner/partners/excel';
