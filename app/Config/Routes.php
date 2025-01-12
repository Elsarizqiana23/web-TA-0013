<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Auth::login');
$routes->get('/registrasi', 'Auth::registrasi');
$routes->get('/logout', 'Auth::logout');
$routes->get('/petugas', 'Admin::index');

$routes->post('/login', 'Auth::signin');
$routes->post('/register', 'Auth::register');
