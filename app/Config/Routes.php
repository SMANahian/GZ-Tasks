<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

use App\Controllers\Auth;
$routes->get('/auth/logout', 'Auth::logout');
$routes->get('/auth/(:segment)', 'Auth::auth/$1');
$routes->post('/auth/login', 'Auth::login');
$routes->post('/auth/signup', 'Auth::signup');
$routes->post('/auth/reset', 'Auth::reset');
$routes->get('/auth/reset/(:num)/(:segment)', 'Auth::resetPassword/$1/$2');
$routes->post('/auth/reset_pass', 'Auth::resetPass');

use App\Controllers\Profile;
$routes->get('/profile/(:num)/view', 'Profile::show/$1');
$routes->get('/profile/(:num)/edit', 'Profile::edit/$1');
$routes->post('/profile/update', 'Profile::update');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
