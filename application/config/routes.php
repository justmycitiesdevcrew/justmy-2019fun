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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'Home';
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
$route['default_controller'] = 'user';
/*Fornt urls*/
/* $route['customer-login'] = 'home/login';
$route['customer-signup'] = 'home/signup';
$route['products'] = 'home/products';
 */
$route['products/(:any)/(:any)'] = 'products/products/$1/$2';
 
 
$route['vegetables'] = 'products/vegetable';
$route['vegetables/(:any)'] = 'products/vegetable';
$route['fruits'] = 'products/fruits';
$route['fruits/(:any)'] = 'products/fruits';
$route['grains'] = 'products/grains';
$route['grains/(:any)'] = 'products/grains';
$route['grocery'] = 'products/grains';
$route['grocery/(:any)'] = 'products/grains';
$route['product-details/(:any)'] = 'products/productdetails/$1';
$route['recipes/cusine/(:any)'] = 'products/recipesCusineFilter/$1';
$route['recipes/(:any)'] = 'products/recipesFilter/$1';
$route['recipes'] = 'products/recipes';
$route['recipe-details/(:any)'] = 'products/recipedetails/$1';

$route['signin'] = 'users/index';
$route['signup'] = 'users/signup';
$route['myaccount'] = 'users/myaccount';
$route['logout'] = 'users/logout';
$route['my-cart'] = 'shopping/index';
$route['thank-you'] = 'shopping/thankyou';
$route['about-us'] = 'home/aboutus';
$route['forgotpassword'] = 'home/forgotpassword';
$route['why-organic'] = 'home/whyorganics';
$route['testimonials'] = 'home/testimonials';
$route['contact-us'] = 'home/contactus';
$route['term-and-conditions'] = 'home/termcondition';
$route['privacy-policy'] = 'home/privacypolicy';
$route['our-belief'] = 'home/ourbelief';
$route['our-team'] = 'home/ourteam';
//$route['gallery'] = 'home/gallery';
$route['gallery'] = 'gallery/index';
$route['refund-policy'] = 'home/refundpolicy';
$route['delivery-schedule'] = 'home/deliveryschedule';
$route['faqs'] = 'home/faqs';
//$route['faq'] = 'user/getfaqs';
$route['Market'] = 'market/Market/index';
$route['Market/editmarket'] = 'market/Market/editMarket';
$route['Market/addmarket'] = 'market/Market//addMarket';
$route['section'] = 'section/index';

$route['blog'] = 'blogs/index';
$route['blog/(:any)'] = 'blogs/searchCategory/$1';
$route['blog-details/(:any)'] = 'blogs/search/$1';


/*admin urls*/
$route['Login'] = 'login';


//$route['taxi/(:any)'] = 'search/cab/$1';
$route['404_override'] = 'Error/';
$route['translate_uri_dashes'] = false;

