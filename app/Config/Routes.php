<?php

use CodeIgniter\Router\RouteCollection;
$routes->setAutoRoute(true);
/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('login');
$routes->setTranslateURIDashes(true);
$routes->set404Override();
/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */
// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::login');
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/proses_login', 'Auth::proses_login');
$routes->get('auth/logout', 'Auth::logout');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/proses_register', 'Auth::proses_register');
$routes->get('dashboard', 'Dashboard::index');
$routes->get('category', 'Category::index');
$routes->get('category/create', 'Category::create');
$routes->post('category/store', 'Category::store');
$routes->get('category/edit/(:any)', 'Category::edit/$1');
$routes->post('category/update/(:any)', 'Category::update/$1');
$routes->get('category/delete/(:any)', 'Category::delete/$1');
$routes->get('product', 'Product::index');
$routes->get('product/create', 'Product::create');
$routes->post('product/store', 'Product::store');
$routes->get('product/edit/(:any)', 'Product::edit/$1');
$routes->post('product/update/(:any)', 'Product::update/$1');
$routes->get('product/delete/(:any)', 'Product::delete/$1');
$routes->get('hasilproduksi', 'HasilProduksi::index');
$routes->get('hasilproduksi/create', 'HasilProduksi::create');
$routes->post('hasilproduksi/store', 'HasilProduksi::store');
$routes->get('hasilproduksi/edit/(:any)', 'HasilProduksi::edit/$1');
$routes->post('hasilproduksi/update/(:any)', 'HasilProduksi::update/$1');
$routes->get('hasilproduksi/delete/(:any)', 'HasilProduksi::delete/$1');
$routes->get('supplier', 'Supplier::index');
$routes->get('supplier/create', 'Supplier::create');
$routes->post('supplier/store', 'Supplier::store');
$routes->get('supplier/edit/(:any)', 'Supplier::edit/$1');
$routes->post('supplier/update/(:any)', 'Supplier::update/$1');
$routes->get('supplier/delete/(:any)', 'Supplier::delete/$1');
$routes->get('bahanbakumasuk', 'BahanBakuMasuk::index');
$routes->get('bahanbakumasuk/create', 'BahanBakuMasuk::create');
$routes->post('bahanbakumasuk/store', 'BahanBakuMasuk::store');
$routes->get('bahanbakumasuk/edit/(:any)', 'BahanBakuMasuk::edit/$1');
$routes->post('bahanbakumasuk/update/(:any)', 'BahanBakuMasuk::update/$1');
$routes->get('bahanbakumasuk/delete/(:any)', 'BahanBakuMasuk::delete/$1');
$routes->get('bahankeluar', 'bahankeluar::index');
$routes->get('bahankeluar/create', 'bahankeluar::create');
$routes->post('bahankeluar/store', 'bahankeluar::store');
$routes->get('bahankeluar/edit/(:any)', 'bahankeluar::edit/$1');
$routes->post('bahankeluar/update/(:any)', 'bahankeluar::update/$1');
$routes->get('bahankeluar/delete/(:any)', 'bahankeluar::delete/$1');
$routes->get('listpo', 'ListPo::index');
$routes->get('listpo/create', 'ListPo::create');
$routes->post('listpo/store', 'ListPo::store');
$routes->get('listpo/edit/(:any)', 'ListPo::edit/$1');
$routes->post('listpo/update/(:any)', 'ListPo::update/$1');
$routes->get('listpo/delete/(:any)', 'ListPo::delete/$1');
$routes->get('laporan', 'Laporan::index');
$routes->get('laporan/bahan', 'Laporan::laporanBahan');
$routes->get('laporan/produk', 'Laporan::laporanProduk');
$routes->get('penjualan', 'Penjualan::index');
$routes->get('penjualan/create', 'Penjualan::create');
$routes->post('penjualan/store', 'Penjualan::store');
$routes->get('penjualan/edit/(:any)', 'Penjualan::edit/$1');
$routes->post('penjualan/update/(:any)', 'Penjualan::update/$1');
$routes->get('penjualan/delete/(:any)', 'Penjualan::delete/$1');

