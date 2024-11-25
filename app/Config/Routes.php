<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/produk', 'Produk::index');
$routes->post('/produk/simpan', 'Produk::simpan_produk');
$routes->get('/produk/tampil', 'Produk::tampil_produk');
$routes->delete('/produk/hapus/(:num)', 'Produk::hapus_produk/$1');
$routes->get('/produk/detail/(:num)', 'Produk::detail/$1'); // Ubah ke 'detail'
$routes->post('/produk/updateProduk', 'Produk::updateProduk'); // Ubah ke 'update'

// Routes untuk pelanggan

$routes->get('/pelanggan', 'Pelanggan::index');
$routes->post('/pelanggan/simpan', 'Pelanggan::simpan_pelanggan');
$routes->get('/pelanggan/tampil', 'Pelanggan::tampil_pelanggan');
$routes->delete('/pelanggan/hapus/(:num)', 'Pelanggan::hapus_pelanggan/$1');
$routes->get('/pelanggan/detail/(:num)', 'Pelanggan::detail/$1'); // Ubah ke 'detail'
$routes->post('/pelanggan/updatePelanggan', 'Pelanggan::updatePelanggan'); // Ubah ke 'update'

