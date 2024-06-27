<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index');
$routes->post('/proses_masuk', 'AuthController::proses_masuk');

$routes->get('/dashboard-user', 'UserController::index');
$routes->get('/logout', 'AuthController::logout');
