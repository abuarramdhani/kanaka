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
$route['register-customer']	= "user/users/register_customer";
$route['check-code-customer']	= "user/users/check_code_customer";
$route['check-code-principal']	= "user/users/check_code_principal";
$route['get-district-by-city']	= "user/users/get_district_by_city_id";
$route['register-principal']	= "user/users/register_principal";

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
$route['get-customer-by-role']	= "user/users/get_customer_by_role";

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
* CATEGORY
*/
$route['master/category'] = 'category/categories/index';
$route['master/category/pdf']	= 'category/categories/pdf';
$route['master/category/excel']	= 'category/categories/excel';

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
* ZONA
*/
$route['master/zona'] = 'zona/zonas/index';
$route['master/zona/pdf']	= 'zona/zonas/pdf';
$route['master/zona/excel']	= 'zona/zonas/excel';

/**
* VENDOR/PRINCIPLE
*/
$route['master/vendor'] = 'principle/principles/index';
$route['master/vendor/pdf']	= 'principle/principles/pdf';
$route['master/vendor/excel'] = 'principle/principles/excel';

/**
* PRICELIST
*/
$route['reports/pricelist'] = 'pricelist/pricelists/index';
$route['reports/pricelist/pdf'] = 'pricelist/pricelists/pdf';
$route['reports/pricelist/excel'] = 'pricelist/pricelists/excel';
$route['reports/pricelist/excel_kanaka'] = 'pricelist/pricelists/excel_kanaka';

/**
* COMPANY REPORT
*/
$route['reports/companyreport'] = 'companyreport/companyreports/index';
$route['reports/companyreport/pdf']	= 'companyreport/companyreports/pdf';
$route['reports/companyreport/excel']	= 'companyreport/companyreports/excel';
$route['reports/companyreport/excel_out']	= 'companyreport/companyreports/excel_out';

/**
* COMPANY REPORT
*/
$route['reports/retur'] = 'retur/returs/index';
$route['reports/retur/pdf']	= 'retur/returs/pdf';
$route['reports/retur/excel']	= 'retur/returs/excel';

/**
* DIPO REPORT
*/
$route['reports/dipo_report'] = 'dipo_report/dipo_reports/index';
$route['reports/dipo_report/pdf']	= 'dipo_report/dipo_reports/pdf';
$route['reports/dipo_report/excel']	= 'dipo_report/dipo_reports/excel';

/**
* PARTNER REPORT
*/
$route['reports/partner'] = 'partner/partners/index';
$route['reports/partner/pdf']	= 'partner/partners/pdf';
$route['reports/partner/excel']	= 'partner/partners/excel';

/**
* CUSTOMER REPORT
*/
$route['reports/customer'] = 'customer/customers/index';
$route['reports/customer/pdf']	= 'customer/customers/pdf';
$route['reports/customer/excel']	= 'customer/customers/excel';

/**
* SURAT PESANAN
*/
$route['reports/suratpesanan'] = 'suratpesanan/suratpesanans/index';
$route['reports/suratpesanan/pdf'] = 'suratpesanan/suratpesanans/pdf';
$route['reports/suratpesanan/excel'] = 'suratpesanan/suratpesanans/excel';

/**
* SURAT JALAN
*/
$route['reports/suratjalan'] = 'suratjalan/suratjalans/index';
$route['reports/suratjalan/pdf'] = 'suratjalan/suratjalans/pdf';
$route['reports/suratjalan/excel'] = 'suratjalan/suratjalans/excel';

/**
* INVOICE
*/
$route['reports/invoice'] = 'invoice/invoices/index';
$route['reports/invoice/pdf'] = 'invoice/invoices/pdf';
$route['reports/invoice/excel'] = 'invoice/invoices/excel';

/**
* CHART OF ACCOUNTS
*/
$route['master/chartofaccount'] = 'chartofaccount/chartofaccounts/index';
$route['master/chartofaccount/pdf'] = 'chartofaccount/chartofaccounts/pdf';
$route['master/chartofaccount/excel'] = 'chartofaccount/chartofaccounts/excel';

/**
* JURNAL
*/
$route['reports/jurnal'] = 'jurnal/jurnals/index';
$route['reports/jurnal/pdf'] = 'jurnal/jurnals/pdf';
$route['reports/jurnal/excel'] = 'jurnal/jurnals/excel';

/**
* CATALOG PRODUCT
*/
$route['catalogproduct'] = 'product/products/catalog';
$route['catalogproduct/salestalk'] = 'product/products/salestalk';
$route['catalogproduct/price'] = 'product/products/price';
$route['catalogproduct/comparison'] = 'product/products/comparison';
$route['catalogproduct/buildingblock'] = 'product/products/buildingblock';

/**
* STOCK
*/
$route['reports/stock'] = 'companyreport/companyreports/stock';

/**
* PROFIT AND LOSS
*/
$route['reports/profitloss'] = 'profitloss/profitlosses/index';
$route['reports/profitloss/show'] = 'profitloss/profitlosses/show';
$route['reports/profitloss/pdf/(:num)'] = 'profitloss/profitlosses/pdf/$1';
$route['reports/profitloss/excel/(:num)'] = 'profitloss/profitlosses/excel/$1';

/**
* ACCOUNT PAYABLE
*/
$route['reports/accountpayable'] = 'accountpayable/accountpayables/index';
$route['reports/accountpayable/pdf'] = 'accountpayable/accountpayables/pdf';
$route['reports/accountpayable/excel'] = 'accountpayable/accountpayables/excel';
$route['reports/accountpayable/detail/(:any)'] = 'accountpayable/accountpayables/detail/$1';
$route['reports/accountpayable/pdf_detail/(:any)'] = 'accountpayable/accountpayables/pdf_detail/$1';
$route['reports/accountpayable/excel_detail/(:any)'] = 'accountpayable/accountpayables/excel_detail/$1';

/**
* ACCOUNT RECEIVABLE
*/
$route['reports/accountreceivable'] = 'accountreceivable/accountreceivables/index';
$route['reports/accountreceivable/pdf'] = 'accountreceivable/accountreceivables/pdf';
$route['reports/accountreceivable/excel'] = 'accountreceivable/accountreceivables/excel';
$route['reports/accountreceivable/detail/(:any)'] = 'accountreceivable/accountreceivables/detail/$1';
$route['reports/accountreceivable/pdf_detail/(:any)'] = 'accountreceivable/accountreceivables/pdf_detail/$1';
$route['reports/accountreceivable/excel_detail/(:any)'] = 'accountreceivable/accountreceivables/excel_detail/$1';
