<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('login', 'Login::index');
$routes->get('register', 'Login::register');
$routes->post('auth/register', 'Login::processRegister');
$routes->post('auth/log', 'Login::log');


$routes->group('', ['filter' => 'auth'], function ($routes) {
  $routes->get('front/dashboard', 'Login::dashboard');
  $routes->get('logout', 'Login::logout');
  $routes->get('/chat', 'Chat::index');
  $routes->get('/server', 'Server::index');

  $routes->get('getAllUsers', 'Chat::getAllUsers');
  $routes->get('getUserById/(:num)', 'Chat::getUserById/$1');
 });