<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'C_login::index');

$routes->get('/login', 'C_login::login');
$routes->post('/login/logearse','C_login::logearse');
$routes->get('/logout','C_login::logout');

$routes->get('/registro', 'C_login::registro');
$routes->post('/registro/registrarse', 'C_login::registrarse');

$routes->get('/coleccion', 'C_cartas::coleccion');
$routes->post('/coleccion', 'C_cartas::coleccionBusqueda');
$routes->get('/coleccion/carta/(:any)', 'C_cartas::cartaInformacion/$1');

$routes->get('/decks', 'C_decks::inicioDecks');
$routes->get('/decks/crearDeck', 'C_decks::crearDeck');
$routes->get('/decks/crearDeck/(:any)', 'C_decks::crearDeck/\$1');