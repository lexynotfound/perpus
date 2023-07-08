<?php

namespace Config;

use CodeIgniter\Config\Services;

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
$routes->get('/admin', 'Admin::index');
$routes->get('/admin/(:num)', 'Admin::detail/$1', ['filter' => 'role:petugas']);
/* $routes->delete('delete/(:num)', 'Admin::delete/$1'); */


$routes->group('home', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('searchRiwayat', 'Home::searchRiwayat');
    $routes->get('searchBuku', 'Home::searchBuku');
    $routes->get('detail/(:num)', 'Home::detail/$1');
});

$routes->group('admin', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('tambahUserView', 'Admin::tambahUserView', ['filter' => 'role:petugas']);
    $routes->get('detail/(:num)', 'Admin::detail/$1', ['filter' => 'role:petugas']);
    $routes->get('detail_card/(:num)', 'Admin::detail/$1', ['filter' => 'role:petugas']);
    $routes->get('download/(:num)', 'Admin::download/$1', ['filter' => 'role:petugas']);
    $routes->post('tambahUser', 'Admin::tambahUser', ['filter' => 'role:petugas']);
    $routes->get('edit/(:num)', 'Admin::edit/$1', ['filter' => 'role:petugas']);
    $routes->get('editProfileViews', 'Admin::editProfileViews', ['filter' => 'role:petugas']);
    $routes->post('editProfile', 'Admin::editProfile', ['filter' => 'role:petugas']); // New delete route
    $routes->post('edit/(:num)', 'Admin::updateUser/$1', ['filter' => 'role:petugas']); // New delete route
    $routes->get('delete/(:num)', 'Admin::delete/$1');
    $routes->get('data', 'Admin::data', ['filter' => 'role:petugas']);
    $routes->get('register', 'Admin::register');
    $routes->get('profile', 'Admin::profile/$1');
    $routes->get('generatePDF/(:num)', 'Admin::generatePDF/$1', ['filter' => 'role:petugas']);
});


$routes->group('buku', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Buku::index', ['filter' => 'role:petugas']);
    $routes->get('create', 'Buku::create', ['filter' => 'role:petugas']);
    $routes->post('store', 'Buku::store', ['filter' => 'role:petugas']);
    $routes->get('detail/(:num)', 'Buku::detail/$1', ['filter' => 'role:petugas']);
    $routes->get('edit/(:num)', 'Buku::edit/$1', ['filter' => 'role:petugas']);
    $routes->post('update/(:num)', 'Buku::update/$1', ['filter' => 'role:petugas']);
    $routes->get('delete/(:num)', 'Buku::delete/$1', ['filter' => 'role:petugas']);
});

$routes->group('laporan', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Laporan::index', ['filter' => 'role:petugas']);
    $routes->get('create', 'Laporan::create', ['filter' => 'role:petugas']);
    $routes->post('store', 'Laporan::store', ['filter' => 'role:petugas']);
    $routes->get('detail/(:num)', 'Laporan::detail/$1', ['filter' => 'role:petugas']);
    $routes->get('edit/(:num)', 'Laporan::edit/$1', ['filter' => 'role:petugas']);
    $routes->post('update/(:num)', 'Laporan::update/$1', ['filter' => 'role:petugas']);
    $routes->get('delete/(:num)', 'Laporan::delete/$1', ['filter' => 'role:petugas']);
    $routes->get('generatePdf', 'Laporan::generatePdf', ['filter' => 'role:petugas']);
    
});

$routes->group('denda', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Denda::index', ['filter' => 'role:petugas']);
    $routes->get('create', 'Denda::create', ['filter' => 'role:petugas']);
    $routes->post('store', 'Denda::store', ['filter' => 'role:petugas']);
    $routes->get('detail/(:num)', 'Denda::detail/$1', ['filter' => 'role:petugas']);
    $routes->get('edit/(:num)', 'Denda::edit/$1', ['filter' => 'role:petugas']);
    $routes->post('update/(:num)', 'Denda::update/$1', ['filter' => 'role:petugas']);
    $routes->get('delete/(:num)', 'Denda::delete/$1', ['filter' => 'role:petugas']);
});

// Rak routes
$routes->group('rak', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Rak::index', ['filter' => 'role:petugas']);
    $routes->get('create', 'Rak::create', ['filter' => 'role:petugas']);
    $routes->post('addrk', 'Rak::addrk', ['filter' => 'role:petugas']);
    $routes->get('edit/(:num)', 'Rak::edit/$1', ['filter' =>'role:petugas']);
    $routes->post('edit/(:num)', 'Rak::update/$1', ['filter' => 'role:petugas']);
    $routes->get('delete/(:num)', 'Rak::delete/$1', ['filter' => 'role:petugas']);
});

// Kategori routes
$routes->group('kategori', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Kategori::index', ['filter' => 'role:petugas']);
    $routes->get('createkt', 'Kategori::createkt', ['filter' => 'role:petugas']);
    $routes->post('add', 'Kategori::add', ['filter' => 'role:petugas']);
    $routes->get('edit/(:num)', 'Kategori::edit/$1', ['filter' =>'role:petugas']);
    $routes->post('edit/(:num)', 'Kategori::update/$1', ['filter' => 'role:petugas']);
    $routes->get('delete/(:num)', 'Kategori::delete/$1', ['filter' => 'role:petugas']);
});

// Pinjam routes
/* $routes->group('pinjam', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Pinjam::index', ['filter' => 'role:petugas']);
    $routes->get('pinjam_views', 'Pinjam::pinjam_views', ['filter' => 'role:petugas']);
    $routes->post('pinjamBuku', 'Pinjam::pinjamBuku', ['filter' => 'role:petugas']);
    $routes->get('edit/(:num)', 'Pinjam::edit/$1', ['filter' =>'role:petugas']);
    $routes->post('update/(:num)', 'Pinjam::update/$1', ['filter' => 'role:petugas']);
    $routes->get('delete/(:num)', 'Pinjam::delete/$1', ['filter' => 'role:petugas']);
}); */
$routes->group('pinjam', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/','Pinjam::index', ['filter' => 'role:petugas']);
    $routes->get('pinjam_views', 'Pinjam::pinjam_views', ['filter' => 'role:petugas']);
    $routes->post('pinjamBuku','Pinjam::pinjamBuku', ['filter' => 'role:petugas']);
    $routes->get('kembaliBuku/(:any)','Pinjam::kembaliBuku/$1', ['filter' => 'role:petugas']);
});


// Pengembalian routes
$routes->group('pengembalian', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Pengembalian::index', ['filter' => 'role:petugas']);
    $routes->get('pengembalian_views', 'Pengembalian::pengembalian_views', ['filter' => 'role:petugas']);
    $routes->post('pengembalianBuku', 'Pengembalian::PengembalianBuku', ['filter' => 'role:petugas']);
    $routes->get('edit/(:num)', 'Pengembalian::edit/$1', ['filter' =>'role:petugas']);
    $routes->post('update/(:num)', 'Pengembalian::update/$1', ['filter' => 'role:petugas']);
    $routes->get('delete/(:num)', 'Pengembalian::delete/$1', ['filter' => 'role:petugas']);
});

// Laporan routes
$routes->group('laporan', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Laporan::index', ['filter' => 'role:petugas']);
    $routes->get('edit/(:num)', 'Laporan::edit/$1', ['filter' =>'role:petugas']);
    $routes->post('update/(:num)', 'Laporan::update/$1', ['filter' => 'role:petugas']);
    $routes->post('date', 'Laporan::date', ['filter' => 'role:petugas']);
    $routes->get('delete/(:num)', 'Laporan::delete/$1', ['filter' => 'role:petugas']);
    $routes->get('generatePdf', 'Laporan::generatePdf', ['filter' => 'role:petugas']);
});

// LaporanBuku routes
$routes->group('laporanbuku', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'LaporanBuku::index', ['filter' => 'role:petugas']);
    $routes->get('edit/(:num)', 'LaporanBuku::edit/$1', ['filter' => 'role:petugas']);
    $routes->post('update/(:num)', 'LaporanBuku::update/$1', ['filter' => 'role:petugas']);
    $routes->get('delete/(:num)', 'LaporanBuku::delete/$1', ['filter' => 'role:petugas']);
    $routes->post('date', 'LaporanBuku::date', ['filter' => 'role:petugas']);
    $routes->get('generatePdf', 'LaporanBuku::generatePdf', ['filter' => 'role:petugas']);
});

// LaporanDenda routes
$routes->group('laporandenda', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'LaporanDenda::index', ['filter' => 'role:petugas']);
    $routes->get('edit/(:num)', 'LaporanDenda::edit/$1', ['filter' => 'role:petugas']);
    $routes->post('update/(:num)', 'LaporanDenda::update/$1', ['filter' => 'role:petugas']);
    $routes->get('delete/(:num)', 'LaporanDenda::delete/$1', ['filter' => 'role:petugas']);
    $routes->post('date', 'LaporanDenda::date', ['filter' => 'role:petugas']);
    $routes->get('generatePdf', 'LaporanDenda::generatePdf', ['filter' => 'role:petugas']);
});


// LaporanPengembalian routes
$routes->group('laporanpengembalian', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'LaporanPengembalian::index', ['filter' => 'role:petugas']);
    $routes->get('edit/(:num)', 'LaporanPengembalian::edit/$1', ['filter' =>'role:petugas']);
    $routes->post('update/(:num)', 'LaporanPengembalian::update/$1', ['filter' => 'role:petugas']);
    $routes->get('delete/(:num)', 'Laporan::delete/$1', ['filter' => 'role:petugas']);
    $routes->post('date', 'LaporanPengembalian::date', ['filter' => 'role:petugas']);
    $routes->get('generatePdf', 'LaporanPengembalian::generatePdf', ['filter' => 'role:petugas']);
});


/* $routes->get('/admin/(:num), Admin::profile/$1', ['filter' => 'role:petugas']); */

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
