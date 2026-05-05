<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/', 'Auth::index');
$routes->get('login', 'Auth::index');
$routes->post('login/process', 'Auth::process');
$routes->get('logout', 'Auth::logout');
$routes->post('/ganti-password/process', 'Auth::processGantiPassword', ['filter' => 'penghuni']);

//middleware
$routes->group('admin', ['filter' => 'admin'], static function ($routes) 
{
    $routes->get('dashboard', 'AdminController::index');
    $routes->get('tipe-kamar', 'TipeKamarController::index');
    $routes->get('tipe-kamar/create', 'TipeKamarController::create');
    $routes->post('tipe-kamar/store', 'TipeKamarController::store');
    $routes->get('tipe-kamar/edit/(:num)', 'TipeKamarController::edit/$1');
    $routes->post('tipe-kamar/update/(:num)', 'TipeKamarController::update/$1');
    $routes->get('tipe-kamar/delete/(:num)', 'TipeKamarController::delete/$1');
});

$routes->group('penghuni', ['filter' => 'penghuni'], static function ($routes) 
{
    $routes->get('dashboard', 'PenghuniController::index');
});

$routes->get('/ganti-password', 'Auth::gantiPassword', ['filter' => 'penghuni']);