<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/saludar', 'cSaludador::saludarTabla');
$routes->get('/platos', 'CRestaurante::platos');
$routes->post('/aniadePlato', 'CRestaurante::anadirPlato');
$routes->get('/verdetalle/(:any)', 'CRestaurante::verDetalle/$1');



