<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index');
$routes->post('/proses_masuk', 'AuthController::proses_masuk');
$routes->get('/logout', 'AuthController::logout');

$routes->get('/detail_user/(:segment)', 'UserController::detail_user/$1');
$routes->get('/tambah_user', 'UserController::tambah_user');
$routes->post('/proses_tambah_user', 'UserController::proses_tambah_user');
$routes->get('/edit_user/(:segment)', 'UserController::edit_user/$1');
$routes->post('/proses_edit_user/(:segment)', 'UserController::proses_edit_user/$1');
$routes->get('/delete_user/(:segment)', 'UserController::delete_user/$1');
$routes->post('datatable_user', 'UserController::datatable_user');
$routes->get('/dashboard-user', 'UserController::index');

$routes->get('/pegawai', 'PegawaiController::index');
$routes->post('/proses_edit_pegawai/(:segment)', 'PegawaiController::proses_edit_pegawai/$1');
