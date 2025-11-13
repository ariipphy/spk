<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->post('auth/login', 'Auth::login');
$routes->get('logout', 'Auth::logout');

// route dashboard kamu (kalau controller-nya bernama Dashboard)
$routes->get('dashboard', 'Dashboard::index');

$routes->get('/', 'Login::index');
$routes->get('login', 'Login::index');
$routes->post('login/proses', 'Login::proses');
$routes->get('dashboard_view', 'dashboard::index');
$routes->post('dashboard_view', 'dashboard::index');

$routes->get('siswa', 'Siswa::index');
$routes->get('siswa/tambah', 'Siswa::tambah');
$routes->post('siswa/simpan', 'Siswa::simpan');
$routes->get('siswa/edit/(:num)', 'Siswa::edit/$1');
$routes->post('siswa/update/(:num)', 'Siswa::update/$1');
$routes->get('siswa/hapus/(:num)', 'Siswa::hapus/$1');

$routes->get('kriteria/tambah', 'KriteriaController::tambah');
$routes->post('KriteriaController/simpan', 'KriteriaController::simpan');
$routes->get('kriteria/edit/(:num)', 'KriteriaController::edit/$1');
$routes->post('kriteria/update/(:num)', 'KriteriaController::update/$1');
$routes->get('kriteria/delete/(:num)', 'KriteriaController::delete/$1');
$routes->get('kriteria', 'KriteriaController::index');

$routes->get('subkriteria', 'SubkriteriaController::index');
$routes->post('subkriteria', 'SubkriteriaController::index');
$routes->get('subkriteria/tambah/(:num)', 'SubkriteriaController::tambah/$1');
$routes->post('subkriteria/tambah', 'SubkriteriaController::simpan');
$routes->get('subkriteria/edit/(:num)', 'SubkriteriaController::edit/$1');
$routes->post('subkriteria/update/(:num)', 'SubkriteriaController::update/$1');
$routes->get('subkriteria/delete/(:num)', 'SubkriteriaController::delete/$1');

$routes->get('subkriteria/tambah/', 'SubkriteriaController::tambah/');
$routes->post('subkriteria/simpan', 'SubkriteriaController::simpan');
$routes->post('subkriteria/simpan', 'SubKriteriaController::simpan');
$routes->get('subkriteria/simpan', 'SubKriteriaController::simpan');

$routes->get('ahp_perhitungan/', 'ahp::index/');
$routes->post('ahp_perhitungan/', 'ahp::index/');
$routes->get('ahp_perhitungan/', 'ahp::hitung/');
$routes->post('ahp_perhitungan/', 'ahp::hitung/');

$routes->get('/ahp_perhitungan', 'ahp::index');
$routes->post('ahp_perhitungan/hitung', 'ahp::hitung');

$routes->get('/ahp', 'ahp::index');
$routes->post('/ahp/hitung', 'ahp::hitung');


$routes->get('/ahp_perhitungan', 'ahp::index');
$routes->post('ahp_perhitungan/hitung', 'ahp::hitung');

$routes->get('/pelanggaran', 'Pelanggaran::index');
$routes->post('/pelanggaran/simpan', 'Pelanggaran::simpan');

$routes->get('/pelanggaran', 'Pelanggaran::index');
$routes->post('/pelanggaran/simpan', 'Pelanggaran::simpan');
$routes->get('/pelanggaran/daftar', 'Pelanggaran::daftar');

$routes->get('pelanggaran', 'Pelanggaran::index');
$routes->get('pelanggaran/tambah', 'Pelanggaran::tambah');
$routes->post('pelanggaran/simpan', 'Pelanggaran::simpan');

$routes->get('topsis', 'Topsis::index');
$routes->get('topsis/proses/(:num)', 'Topsis::proses/$1');

$routes->get('topsis', 'Topsis::index');
$routes->get('topsis/proses', 'Topsis::proses');
$routes->get('topsis/view-proses', 'Topsis::viewProses');
$routes->get('/topsis/hasil', 'Topsis::hasil');

$routes->get('/laporan/siswa/(:num)', 'Laporan::perSiswa/$1');
$routes->get('/laporan/minggu', 'Laporan::perMinggu');
$routes->get('laporan/cetak/(:num)', 'Laporan::cetak/$1');

$routes->get('/laporan', 'Topsis::laporan');
$routes->get('laporan/per-siswa/(:num)', 'Topsis::laporanSiswa/$1');

$routes->get('laporan/perMinggu', 'Laporan::perMinggu');
$routes->post('laporan/perMinggu', 'Laporan::perMinggu');
$routes->post('laporan/cetakPdf', 'Laporan::cetakPdf');

$routes->setAutoRoute(true);