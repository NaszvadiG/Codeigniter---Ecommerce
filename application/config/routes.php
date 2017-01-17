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
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['default_controller'] = 'buyer';
$route['home'] = 'buyer/index';
$route['story'] = 'buyer/story';
$route['faq'] = 'buyer/faq';
$route['how-we-ship'] = 'buyer/how_we_ship';
$route['emailpreference'] = 'buyer/emailpreference';
$route['coming-soon'] = 'buyer/soon';

$route['curators-pick/([\w\-]+)'] = 'catalog/curators_pick/$1';
$route['about/([\w\-]+)'] = 'buyer/about/$1';

// all module/list will redirect to index
$route['(\w+)/list'] = '$1/index';

$route['shopping-cart'] = 'catalog/cart/view';
$route['shopping-cart/(\w+)'] = 'catalog/cart/$1';

$route['catalog/([0-9]+)'] = 'catalog/index/$1';
// force category :sad:
$route['home-and-living']= 'catalog/index/7';
$route['clothing-and-accessories']= 'catalog/index/8';
$route['health-and-beauty']= 'catalog/index/9';
$route['food']= 'catalog/index/10';
$route['furniture']= 'catalog/index/11';
$route['dining']= 'catalog/index/12';
$route['decorative-arts']= 'catalog/index/13';
$route['lacquerware']= 'catalog/index/14';
$route['lighting']= 'catalog/index/15';
$route['sustainable-arts']= 'catalog/index/16';
$route['cushions']= 'catalog/index/17';
$route['glassware']= 'catalog/index/18';
$route['apparel']= 'catalog/index/19';
$route['shoes']= 'catalog/index/20';
$route['jewelry']= 'catalog/index/21';
$route['bags']= 'catalog/index/22';
$route['hats-and-scarves']= 'catalog/index/23';
$route['accessories']= 'catalog/index/24';
$route['necklaces']= 'catalog/index/25';
$route['earrings']= 'catalog/index/26';
$route['bangles']= 'catalog/index/27';
$route['straw-bags']= 'catalog/index/28';
$route['backpacks']= 'catalog/index/29';
$route['clutches']= 'catalog/index/30';
$route['key-rings']= 'catalog/index/31';
$route['plush']= 'catalog/index/32';
$route['purses']= 'catalog/index/33';
$route['skin-care']= 'catalog/index/34';
$route['bath-and-body']= 'catalog/index/35';
$route['hair-care']= 'catalog/index/36';
$route['make-up']= 'catalog/index/37';
$route['spa-treatment']= 'catalog/index/38';
$route['balms']= 'catalog/index/39';
$route['snack']= 'catalog/index/40';
$route['coffee']= 'catalog/index/41';
$route['organic-food']= 'catalog/index/42';
$route['cookies']= 'catalog/index/43';
$route['jam-jelly-peanut']= 'catalog/index/44';
$route['butter']= 'catalog/index/45';
$route['cocoa']= 'catalog/index/46';
$route['seasonings']= 'catalog/index/47';
$route['benjarong']= 'catalog/index/48';
$route['lux']= 'catalog/index/49';
$route['express-upgrade']= 'catalog/index/51';
$route['all-sacict']= 'catalog/index/52';
$route['made-to-order']= 'catalog/index/53';