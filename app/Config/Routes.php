<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'LoginController::index');
// $routes->get('/detail/(:num)', 'Home::detail/$1');
$routes->get('/', 'Home::index');
$routes->get('/laporan', 'Laporan::index');
$routes->get('/tracking', 'Home::index');
$routes->get('/tracking/cek/(:segment)', 'Home::cekstatus/$1');
$routes->post('tracking/cek', 'Home::cekstatus');



$routes->get('/laporan-pelanggan', 'Laporan::LaporanPelanggan', ['filter' => 'role:Petugas, Kepala Kantor']);
$routes->get('/laporan/viewall-laporanpelanggan', 'Laporan::viewallLaporanPelanggan', ['filter' => 'role:Petugas, Kepala Kantor']);
$routes->get('/laporan-kota', 'Laporan::LaporanKota', ['filter' => 'role:Petugas, Kepala Kantor']);
$routes->get('/laporan/viewall-laporankota', 'Laporan::viewallLaporanKota', ['filter' => 'role:Petugas, Kepala Kantor']);
$routes->get('/laporan-tarif', 'Laporan::LaporanTarif', ['filter' => 'role:Petugas, Kepala Kantor']);
$routes->get('/laporan/viewall-laporantarif', 'Laporan::viewallLaporanTarif', ['filter' => 'role:Petugas, Kepala Kantor']);


//users
$routes->get('/user', 'User::index', ['filter' => 'role:Petugas']);
$routes->get('/user/view', 'User::view', ['filter' => 'role:Petugas']);
$routes->get('user/detail/(:num)', 'User::detail/$1', ['filter' => 'role:Petugas']);
$routes->get('user/formtambah', 'User::tambah', ['filter' => 'role:Petugas']);
$routes->post('user/save', 'User::save', ['filter' => 'role:Petugas']);
$routes->get('user/edit/(:segment)', 'User::formedit/$1', ['as' => 'user.edit', 'filter' => 'role:Petugas']);
$routes->post('user/update', 'User::update', ['filter' => 'role:Petugas']);
$routes->post('user/delete', 'User::delete', ['as' => 'user.delete', 'filter' => 'role:Petugas']);

//konsumen
$routes->get('/konsumen', 'Konsumen::index', ['filter' => 'role:Petugas']);
$routes->get('/konsumen/view', 'Konsumen::view', ['filter' => 'role:Petugas']);
$routes->get('/konsumen/formtambah', 'Konsumen::formtambah', ['filter' => 'role:Petugas']);
$routes->post('/konsumen/save', 'Konsumen::save', ['filter' => 'role:Petugas']);
$routes->post('delete', 'Konsumen::delete', ['as' => 'konsumen.delete', 'filter' => 'role:Petugas']);
$routes->get('konsumen/edit/(:segment)', 'Konsumen::formedit/$1', ['as' => 'konsumen.edit', 'filter' => 'role:Petugas']);
$routes->post('/konsumen/update', 'Konsumen::updatedata', ['filter' => 'role:Petugas']);
$routes->get('konsumen/detail/(:any)', 'Konsumen::detail/$1', ['filter' => 'role:Petugas']);
$routes->get('/laporan-konsumen', 'Laporan::Konsumen', ['filter' => 'role:Petugas']);

//Kota
$routes->get('/kota', 'Kota::index', ['filter' => 'role:Petugas']);
$routes->get('/kota/view', 'Kota::view', ['filter' => 'role:Petugas']);
$routes->get('/kota/formtambah', 'Kota::formtambah', ['filter' => 'role:Petugas']);
$routes->post('/kota/save', 'Kota::save', ['filter' => 'role:Petugas']);
$routes->get('kota/edit/(:segment)', 'Kota::formedit/$1', ['as' => 'kota.edit', 'filter' => 'role:Petugas']);
$routes->post('/kota/update', 'Kota::updatedata', ['filter' => 'role:Petugas']);
$routes->get('kota/detail/(:any)', 'Kota::detail/$1', ['filter' => 'role:Petugas']);
$routes->post('kota/delete', 'Kota::delete', ['as' => 'kota.delete', 'filter' => 'role:Petugas']);

//tarif
$routes->get('/tarif', 'Tarif::index', ['filter' => 'role:Petugas']);
$routes->get('/tarif/view', 'Tarif::view', ['filter' => 'role:Petugas']);
$routes->get('/tarif/formtambah', 'Tarif::formtambah', ['filter' => 'role:Petugas']);
$routes->post('/tarif/save', 'Tarif::save', ['filter' => 'role:Petugas']);
$routes->get('tarif/edit/(:segment)', 'Tarif::formedit/$1', ['as' => 'tarif.edit', 'filter' => 'role:Petugas']);
$routes->post('/tarif/update', 'Tarif::updatedata', ['filter' => 'role:Petugas']);
$routes->get('tarif/detail/(:any)', 'Tarif::detail/$1', ['filter' => 'role:Petugas']);
$routes->post('tarif/delete', 'Tarif::delete', ['as' => 'tarif.delete', 'filter' => 'role:Petugas']);


//Pengiriman
$routes->get('/pengiriman', 'Pengiriman::index', ['filter' => 'role:Petugas']);
$routes->get('/pengiriman/view', 'Pengiriman::view', ['filter' => 'role:Petugas']);
$routes->get('/pengiriman/tambah', 'Pengiriman::formtambah', ['filter' => 'role:Petugas']);
$routes->get('/pengiriman/getkonsumen', 'Pengiriman::getKonsumen', ['filter' => 'role:Petugas']);
$routes->get('/pengiriman/viewGetKonsumen', 'Pengiriman::viewGetKonsumen', ['filter' => 'role:Petugas']);

$routes->get('/pengiriman/gettarif', 'Pengiriman::getTarif', ['filter' => 'role:Petugas']);
$routes->get('/pengiriman/viewGetTarif', 'Pengiriman::viewGetTarif', ['filter' => 'role:Petugas']);
$routes->post('/pengiriman/save', 'Pengiriman::save', ['filter' => 'role:Petugas']);
$routes->get('/pengiriman/detail/(:any)', 'Pengiriman::Detail/$1', ['filter' => 'role:Petugas']);
$routes->get('pengiriman/edit/(:segment)', 'Pengiriman::formedit/$1', ['as' => 'pengiriman.edit', 'filter' => 'role:Petugas']);
$routes->post('/pengiriman/update', 'Pengiriman::updatedata', ['filter' => 'role:Petugas']);
$routes->post('/pengiriman/delete', 'Pengiriman::delete', ['as' => 'noresi.delete', 'filter' => 'role:Petugas']);
$routes->post('/pengiriman/ubahstatus', 'Pengiriman::ubahstatus', ['filter' => 'role:Petugas']);



$routes->get('/laporan-pengiriman', 'Laporan::LaporanPengiriman', ['filter' => 'role:Petugas, Kepala Kantor']);
$routes->get('/laporan/viewall-laporanpengiriman', 'Laporan::viewallLaporanPengiriman', ['filter' => 'role:Petugas, Kepala Kantor']);
$routes->get('/laporan/viewall-laporanpengirimanproses', 'Laporan::viewallLaporanPengirimanProses', ['filter' => 'role:Petugas, Kepala Kantor']);
$routes->get('/laporan/viewall-laporanpengirimanselesai', 'Laporan::viewallLaporanPengirimanSelesai', ['filter' => 'role:Petugas, Kepala Kantor']);
$routes->post('/laporan/viewall-laporanpengirimantanggal', 'Laporan::viewallLaporanPengirimanTanggal', ['filter' => 'role:Petugas, Kepala Kantor']);
$routes->post('/laporan/viewall-laporanpengirimanperbulan', 'Laporan::viewallLaporanPengirimanPerBulan', ['filter' => 'role:Petugas, Kepala Kantor']);

// Routes publik (tanpa login)
$routes->get('/', 'Home::index');
$routes->get('cekstatus', 'Home::cekstatus');
$routes->post('cekstatus', 'Home::cekstatus');
$routes->get('cekstatus/(:segment)', 'Home::cekstatus/$1');

// Routes yang memerlukan login
$routes->group('', ['filter' => 'login'], function ($routes) {
    $routes->get('dashboard', 'Home::dashboard');
});
