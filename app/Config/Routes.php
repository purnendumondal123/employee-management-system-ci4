<?php

use CodeIgniter\Router\RouteCollection;
use Config\Services;

/**
 * @var RouteCollection $routes
 */

$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('AuthController');
$routes->setDefaultMethod('login');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

$routes->get('/', 'AuthController::login', ['as' => 'login', 'filter' => 'noauth' ]);

$routes->post('login', 'AuthController::authenticate', [
    'filter' => 'noauth'
]);

$routes->get('register', 'AuthController::register', ['filter' => 'noauth']);

$routes->post('register', 'AuthController::store', [
    'filter' => 'noauth'
]);

$routes->match(['get', 'post'], 'verify-otp', 'AuthController::verifyOtp');

$routes->get('resend-otp', 'AuthController::resendOtp');

$routes->get('forgot-password', 'AuthController::forgotPassword');

$routes->post('forgot-password', 'AuthController::sendForgotOtp');

$routes->match(['get', 'post'], 'reset-password', 'AuthController::resetPassword');

$routes->get('logout', 'AuthController::logout', [
    'filter' => 'auth'
]);

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

$routes->get('dashboard', 'DashboardController::index', [
    'filter' => 'auth'
]);

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

$routes->get('profile', 'ProfileController::index', [
    'filter' => 'auth'
]);

$routes->post('profile/update', 'ProfileController::update', [
    'filter' => 'auth'
]);

$routes->post('profile/upload-photo', 'ProfileController::uploadPhoto', [
    'filter' => 'auth'
]);

/*
|--------------------------------------------------------------------------
| Employee CRUD
|--------------------------------------------------------------------------
*/

$routes->group('employees', ['filter' => 'admin'], function ($routes) {

    $routes->get('/', 'EmployeeController::index');

    $routes->get('create', 'EmployeeController::create');

    $routes->post('store', 'EmployeeController::store');

    $routes->get('edit/(:num)', 'EmployeeController::edit/$1');

    $routes->post('update/(:num)', 'EmployeeController::update/$1');

    $routes->get('delete/(:num)', 'EmployeeController::delete/$1');

    $routes->post('delete/(:num)', 'EmployeeController::delete/$1');

    $routes->post('datatable', 'EmployeeController::datatable');
});

/*
|--------------------------------------------------------------------------
| Environment Routes
|--------------------------------------------------------------------------
*/

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}