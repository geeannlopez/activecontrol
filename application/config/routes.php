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

/*
$route['admin/banner_delete']			= 'admin/banner_delete';
$route['admin/update_about']			= 'admin/update_about';
$route['admin/delete_content']			= 'admin/delete_content';
$route['admin/add_messagebox']			= 'admin/add_messagebox';
// $route['admin/users']					= 'admin/get_users';
$route['admin/records']					= 'admin/get_records';
$route['admin/logout']					= 'main/logout';
$route['admin/banner_upload']			= 'admin/banner_upload';
$route['admin/(:any)']					= 'admin/view/$1';
$route['admin/(:any)/(:any)']			= 'admin/$1/$2';
$route['admin/print']                           = 'admin/print';

// $route['user/getEvents']				= 'user/getEvent';
// $route['user/(:any)']			= 'user/$1';
$route['patient/logout']				= 'main/logout';
$route['patient/(:any)/(:any)']			= 'user/$1/$2';
$route['patient/(:any)']				= 'user/view/$1';
$route['login']							= 'main/login';

$route['register']						= 'user/register';

$route['(:any/)']						= 'main/view/$1'; 

$route['default_controller']			= 'main/view';
$route['404_override']					= 'errors/404.php';
$route['translate_uri_dashes']			= FALSE;
*/
$route['default_controller']            = 'Main';
$route['404_override']                  = 'Main/error';
$route['translate_uri_dashes']          = FALSE;
