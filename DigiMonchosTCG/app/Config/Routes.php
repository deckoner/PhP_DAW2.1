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
$routes->get('/compo/(:any)', 'CRestaurante::compo/$1');

$routes->post('/anadieQuitaIngrediente', 'CRestaurante::anadeIngrediente');
$routes->get('/grabarNuevosIngredientes', 'CRestaurante::grabarIngredientes');


