<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'C_login::index');

$routes->get('/login', 'C_login::login');
$routes->post('/login/logearse','C_login::logearse');

$routes->get('/registro', 'C_login::registro');
$routes->post('/registro/registrarse', 'C_login::registrarse');