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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// setting route for admin
$route['admin'] = 'admin/auth';
$route['login'] = 'admin/LoginController/login';
$route['super-admin'] = 'super_admin/LoginController/login';
//Super ADmin Show sidebar
$route['super_admin/dashboard'] = 'super_admin/Dashboard/super_dashboard';
//Super admin to admin panel to send mail
$route['send_mail'] = 'super_admin/Dashboard/quick_mail';
$route['send_msg'] = 'super_admin/Dashboard/quick_msg';
//restaurant view invoice in spuer admin
$route['invoice/view/(:num)'] = 'InvoiceController/invoice_view/$1';
$route['admin/invoice/view/(:num)'] = 'InvoiceController/invoice_view_restaurant/$1';


//super admin show transition history
$route['transition/history'] = 'super_admin/TransitionController';
$route['transition/cash'] = 'super_admin/TransitionController/payment_cash';
//discount table view and add on this page
$route['discount/view'] = 'super_admin/DiscountController';
//using this function AJAX 
$route['discount_get'] = 'super_admin/DiscountController/get_discount_byID';
//update discount 
$route['update_discount'] = 'super_admin/DiscountController/update_discount';
//for cash payment via admin
$route['cash'] = 'super_admin/TransitionController/get_restaurant_for_pay';
//using in AJAX call Transition History Page
$route['get_res_id'] = 'super_admin/TransitionController/get_restaurant';
//transition history page on show data via AJAX 
$route['date_rang'] = 'super_admin/TransitionController/get_date_range';
//super admin add new restaurant add then show email msg if availble and not
$route['check_email'] = 'super_admin/Users/check_email';

//super admin in ujser edit then select duration then increment expired date
$route['future_date'] = 'super_admin/Users/future_date';

//Super admin deleted user re-active then this call function using AJAX to reactive
$route['re_active'] = 'super_admin/Users/re_active_delete_user';
$route['delete'] = 'super_admin/Users/delete_restaurant';
//Super admin restaurant expired
$route['expired/restaurant'] = 'super_admin/Users/expired_restaurant';
//Enquiry View
$route['enquiry/list'] = 'super_admin/EnquiryController/enquiry_list';
$route['enquiry/view/(:num)'] = 'super_admin/EnquiryController/enquiry_view/$1';


$route['adminlte'] = 'admin/auth';
$route['adminlte/(:any)'] = 'admin/adminlte/$1';

//Admin Login 
$route['adminLogin'] = 'admin/LoginController/index';

//API 
$route['api/loginAPI'] = 'admin/api/Example/login/';
$route['api/userAPI/(:any)'] = 'admin/api/Example/user/$1';
//get survey form data
$route['api/surveyAPI/(:any)'] = 'admin/api/Example/survey/$1';
$route['api/surveyAPI'] = 'admin/api/Example/survey/';

//Extra URL Short 
$route['pdf/(:any)'] = 'admin/pdfexample/pdfTest';
$route['pdf1/(:any)'] = 'admin/pdfexample/test';

//on site to register aby users then call function
$route['register'] = 'Welcome/new_user/';
$route['mail'] = 'Welcome/contact_mail/';

//Payu Money payment Gateway use then after call back url
$route['api/failer'] = 'admin/api/Example/failer';

//excel export
$route['excel_download'] = 'admin/Excel_export_Controller';