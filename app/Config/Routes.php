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


$routes->post('/booking/submit', 'Home::submitBooking');
$routes->get('track/(:num)', 'Home::track/$1');
$routes->get('pay-dp/(:num)', 'Home::payDP/$1');

//middleware
$routes->group('admin', ['filter' => 'admin'], static function ($routes) 
{

    $routes->get('booking', 'AdminBookingController::index');
    $routes->get('booking/approve/(:num)', 'AdminBookingController::approve/$1');
    $routes->get('booking/create-account/(:num)', 'AdminBookingController::createAccount/$1');
    $routes->get('booking/delete/(:num)', 'AdminBookingController::delete/$1');
    $routes->get('booking/clear-cancelled', 'AdminBookingController::clearCancelled');

    $routes->get('dashboard', 'AdminController::index');
    $routes->get('tipe-kamar', 'TipeKamarController::index');
    $routes->get('tipe-kamar/create', 'TipeKamarController::create');
    $routes->post('tipe-kamar/store', 'TipeKamarController::store');
    $routes->get('tipe-kamar/edit/(:num)', 'TipeKamarController::edit/$1');
    $routes->post('tipe-kamar/update/(:num)', 'TipeKamarController::update/$1');
    $routes->get('tipe-kamar/delete/(:num)', 'TipeKamarController::delete/$1');

    $routes->get('kamar', 'KamarController::index');
    $routes->get('kamar/create', 'KamarController::create');
    $routes->post('kamar/store', 'KamarController::store');
    $routes->get('kamar/edit/(:num)', 'KamarController::edit/$1');
    $routes->post('kamar/update/(:num)', 'KamarController::update/$1');
    $routes->get('kamar/delete/(:num)', 'KamarController::delete/$1');

    $routes->get('penghuni', 'AdminPenghuniController::index');
    $routes->get('penghuni/create', 'AdminPenghuniController::create');
    $routes->post('penghuni/store', 'AdminPenghuniController::store');
    $routes->get('penghuni/delete/(:num)', 'AdminPenghuniController::delete/$1');

    $routes->get('tagihan', 'AdminTagihanController::index');
    $routes->get('tagihan/create', 'AdminTagihanController::create');
    $routes->post('tagihan/store', 'AdminTagihanController::store');
    $routes->get('tagihan/lunasi/(:num)', 'AdminTagihanController::lunasi/$1');

    $routes->get('komplain', 'AdminKomplainController::index');
    $routes->post('komplain/update/(:num)', 'AdminKomplainController::updateStatus/$1');

    $routes->get('pembayaran', 'AdminPembayaranController::index');
});

$routes->group('penghuni', ['filter' => 'penghuni'], static function ($routes) 
{
    $routes->get('dashboard', 'PenghuniController::index');

    $routes->get('tagihan', 'PenghuniTagihanController::index');
    $routes->get('komplain', 'PenghuniKomplainController::index');
    $routes->get('komplain/create', 'PenghuniKomplainController::create');
    $routes->post('komplain/store', 'PenghuniKomplainController::store');

    $routes->get('pembayaran', 'PenghuniPembayaranController::index');
    $routes->post('pembayaran/checkout', 'PenghuniPembayaranController::checkout');
    $routes->get('pembayaran/invoice/(:segment)', 'PenghuniPembayaranController::invoice/$1');
    $routes->get('pembayaran/simulate/(:segment)', 'PenghuniPembayaranController::simulatePay/$1');
});

$routes->get('/ganti-password', 'Auth::gantiPassword', ['filter' => 'penghuni']);