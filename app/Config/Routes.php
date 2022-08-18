<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/login', 'Auth\LoginController::index', ["as" => "login.index"]);
$routes->post('/login', 'Auth\LoginController::store', ["as" => "login.store"]);
$routes->get('/register', 'Auth\RegisterController::index', ["as" => "register.index"]);
$routes->post('/register', 'Auth\RegisterController::store', ["as" => "register.store"]);
$routes->get('/logout', 'Auth\LogoutController::index', ["as" => "logout"]);
$routes->get('/test', 'Home::template');

$routes->group('admin', ['filter' => 'adminfilter'], function ($routes) {
    $routes->get('dashboards', 'Admin\DashboardController::index', ["as" => "admin.dashboards.index"]);

    $routes->get('rooms', 'Admin\RoomController::index', ["as" => "admin.rooms.index"]);
    $routes->put('rooms/(:num)', 'Admin\RoomController::update/$1', ["as" => "admin.rooms.update"]);

    $routes->get('occupants', 'Admin\OccupantController::index', ["as" => "admin.occupants.index"]);
    $routes->put('occupants/(:num)', 'Admin\OccupantController::update/$1', ["as" => "admin.occupants.update"]);
});

$routes->group('member', ['filter' => 'memberfilter'], function ($routes) {
    $routes->get('dashboards', 'Member\DashboardController::index', ["as" => "member.dashboards.index"]);

    $routes->get('payments', 'Member\PaymentController::index', ["as" => "admin.payments.index"]);
    $routes->post('payments', 'Member\PaymentController::store', ["as" => "admin.payments.store"]);
});

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
