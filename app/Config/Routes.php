<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/petugas', 'Admin::index');
$routes->get('/gambar/(:num)', 'Buku::gambar/$1');
$routes->get('/peminjaman', 'User::peminjaman');
$routes->get('/petugas/peminjaman', 'Admin::peminjaman');

// Auth Get
$routes->get('/login', 'Auth::login');
$routes->get('/registrasi', 'Auth::registrasi');
$routes->get('/logout', 'Auth::logout');

// Petugas User Get
$routes->get('/petugas/user', 'Admin::user');
$routes->get('/petugas/user/edit/(:num)', 'Admin::editUser/$1');
$routes->get('/petugas/user/delete/(:num)', 'Admin::deleteUser/$1');
$routes->get('/petugas/user/tambah', 'Admin::tambahUser');

// Petugas Buku Get
$routes->get('/petugas/buku', 'Buku::index');
$routes->get('/petugas/buku/edit/(:num)', 'Buku::edit/$1');
$routes->get('/petugas/buku/delete/(:num)', 'Buku::delete/$1');
$routes->get('/petugas/buku/tambah', 'Buku::tambah');
$routes->get('/petugas/buku/gambar/(:num)', 'Buku::gambar/$1');

// User Buku Get
$routes->get('/buku', 'User::buku');
$routes->get('/buku/pinjam/(:num)', 'User::pinjam/$1');

// Auth Post
$routes->post('/login', 'Auth::signin');
$routes->post('/register', 'Auth::register');

// Petugas User Post
$routes->post('/petugas/user/update/(:num)', 'Admin::updateUser/$1');
$routes->post('/petugas/user/tambah', 'Admin::createUser');

// Petugas Buku Post
$routes->post('/petugas/buku/update/(:num)', 'Buku::update/$1');
$routes->post('/petugas/buku/tambah', 'Buku::create');

$routes->post('/petugas/peminjaman/kembali/(:num)', 'Admin::kembali/$1');

// User Post
$routes->post('/buku/pinjam/(:num)', 'User::pinjams/$1');