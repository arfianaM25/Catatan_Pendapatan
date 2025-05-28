<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->get('/login', 'Auth::login');
$routes->post('/auth/process', 'Auth::process');
$routes->get('/logout', 'Auth::logout');
$routes->get('auth/logout', 'Auth::logout');

$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);

$routes->get('/master_pendapatan', 'MasterPendapatan::index');
$routes->get('/master_pendapatan/rekening', 'MasterPendapatan::rekening');
$routes->post('master_pendapatan/rekening', 'MasterPendapatan::rekening');

$routes->get('/master_pendapatan/create', 'MasterPendapatan::create');
$routes->post('/master_pendapatan/store', 'MasterPendapatan::store');
$routes->get('/master_pendapatan/upload', 'MasterPendapatan::upload');
$routes->post('/master_pendapatan/import', 'MasterPendapatan::import');
$routes->post('/master_pendapatan/update/(:any)', 'MasterPendapatan::update/$1');
$routes->post('/master_pendapatan/destroy/(:any)', 'MasterPendapatan::destroy/$1');

$routes->get('/master_pendapatan/opd', 'OPDController::index');
$routes->get('opd', 'OPDController::index');
$routes->post('opd/store', 'OPDController::store');
$routes->post('opd/update/(:num)', 'OPDController::update/$1');
$routes->post('opd/delete/(:num)', 'OPDController::delete/$1');

$routes->post('opd/update/(:num)', 'OPDController::update/$1');

$routes->get('/pendapatan', 'PendapatanController::index');
$routes->get('/pendapatan/create', 'PendapatanController::create');
$routes->post('/pendapatan/store', 'PendapatanController::store');
$routes->get('/pendapatan/edit/(:num)', 'PendapatanController::edit/$1');
$routes->post('/pendapatan/update/(:num)', 'PendapatanController::update/$1'); 
$routes->post('pendapatan/updateJumlah', 'Pendapatan::updateJumlah');
$routes->post('/pendapatan/delete/(:num)', 'PendapatanController::delete/$1');
$routes->post('/pendapatan/import', 'PendapatanController::import');

$routes->get('laporan/realisasi', 'LaporanController::realisasi');
$routes->get('laporan/realisasi/pdf', 'LaporanController::realisasiPdf');
$routes->get('laporan/buku_besar', 'LaporanController::bukuBesar');
$routes->get('laporan/buku_besar/pdf', 'LaporanController::bukuBesarPdf');
$routes->get('rekonsiliasi', 'RekonsiliasiController::index');
$routes->get('rekonsiliasi/pdf', 'RekonsiliasiController::pdf');