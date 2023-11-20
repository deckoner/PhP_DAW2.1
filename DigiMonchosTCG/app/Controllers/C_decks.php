<?php

namespace App\Controllers;

use App\Models\M_digimonTCG;

class C_decks extends BaseController {
    protected $modelo;

    public function __construct() {
        $this->modelo = new M_digimonTCG();        
        helper('util');
    }

    public function crearDeck($numero_carta = null, $eliminar = null) {
        // Si existe un numero de carta lo intentaremos meter a la listaDeck
        if (!is_null($numero_carta)) {
            // Si no existe la variable de listaCartasDeck la creamos
            if (!$this->session->has("listaCartasDeck")) {
                $listaCartasDeck = array();

            } else {
                $listaCartasDeck = $this->session->get("listaCartasDeck");
            }
            
            // Comprobamos si ahi que eliminar o añadir la carta
            if ($eliminar == "true") {
                $key = array_search($numero_carta, $listaCartasDeck);
                if ($key !== false) {
                    unset($listaCartasDeck[$key]);
                }

                // Reindexamos el array
                $listaCartasDeck = array_values($listaCartasDeck);

                // Actualizamos la lista sin la carta
                $this->session->set("listaCartasDeck", $listaCartasDeck);
                

                // Creamos la lista de cartas que se van a pasar a la vista
                $listaCartasDeckView = array();

                // Recuperaremos la informacion de las cartas en la base de datos
                foreach ($listaCartasDeck as $c) {
                    $listaCartasDeckView[] = $this->modelo->obtenerCartaDeckBuild($c);
                }

                // Guardamos la lista de cartas a mostrar en la view
                $datos["listaCartasDeck"] = $listaCartasDeckView;
            } else {
                // Si el numero supera a 55 avisaremos al usuario con un error
                if (count($listaCartasDeck)+1 <= 55) {
                    //Añadimos la carta y actualizamos la sesion
                    $listaCartasDeck[] = $numero_carta;
                    $this->session->set("listaCartasDeck", $listaCartasDeck);

                    // Creamos la lista de cartas que se van a pasar a la vista
                    $listaCartasDeckView = array();

                    // Recuperaremos la informacion de las cartas en la base de datos
                    foreach ($listaCartasDeck as $c) {
                        $listaCartasDeckView[] = $this->modelo->obtenerCartaDeckBuild($c);
                    }

                    $datos["listaCartasDeck"] = $listaCartasDeckView;
                } else {
                    // Hacemos una lista con las cartas actuales
                    foreach ($listaCartasDeck as $c) {
                        $listaCartasDeckView[] = $this->modelo->obtenerCartaDeckBuild($c);
                    }

                    $datos["listaCartasDeck"] = $listaCartasDeckView;
                    $datos["errorDeck"] = "El numero de cartas no puede ser mayor a 55 cartas";
                }
            }
        }

        // Hacemos una lista con los costes de la carta dependiendo del maximo coste
        $costes = $this->modelo->obtenerValorMaximo("cartas", "coste");
        $costesLista = array();
        $costesLista[null] = "Ninguno";

        for ($i = 1; $i <= $costes->maxCoste; $i++) {
            $costesLista[$i] = $i;
        }

        // Elementos del filtro
        $colorUno = $this->request->getPost('colorUno');
        $colorDos = $this->request->getPost('colorDos');
        $tipoCarta = $this->request->getPost('tipoCarta');
        $atributo = $this->request->getPost('Atributo');
        $bt = $this->request->getPost('bt');
        $coste = $this->request->getPost('coste');
        $nombre = $this->request->getPost('nombreCarta');
    
        $datos['tituloPagina'] = "Deck Builder";
        $datos['cartas'] = $this->modelo->buscarCarta($colorUno, $colorDos, $tipoCarta, 
                                                        $atributo, $bt, $coste, $nombre);
        $datos['coloresLista'] = $this->modelo->optenerNombres("colores");
        $datos['tiposCartaLista'] = $this->modelo->optenerNombres("tiposcarta");
        $datos['atributosLista'] = $this->modelo->optenerNombres("atributos");
        $datos['btsLista'] = $this->modelo->optenerBTsAbrev();
        $datos['costesLista'] = $costesLista;
        $datos['rol'] = $this->session->get('usuarioRol');

        echo view('elementos/Vcabecera', $datos);
        echo view('decks/VdeckBuild', $datos);
        echo view('elementos/Vpie');
    }

    public function crearDeckPost($numero_carta = null, $eliminar = null) {
        // Si existe un numero de carta lo intentaremos meter a la listaDeck
        if (!is_null($numero_carta)) {
            // Si no existe la variable de listaCartasDeck la creamos
            if (!$this->session->has("listaCartasDeck")) {
                $listaCartasDeck = array();

            } else {
                $listaCartasDeck = $this->session->get("listaCartasDeck");
            }
            
            // Comprobamos si ahi que eliminar o añadir la carta
            if ($eliminar == "true") {
                $key = array_search($numero_carta, $listaCartasDeck);
                if ($key !== false) {
                    unset($listaCartasDeck[$key]);
                }

                // Reindexamos el array
                $listaCartasDeck = array_values($listaCartasDeck);

                // Actualizamos la lista sin la carta
                $this->session->set("listaCartasDeck", $listaCartasDeck);
                

                // Creamos la lista de cartas que se van a pasar a la vista
                $listaCartasDeckView = array();

                // Recuperaremos la informacion de las cartas en la base de datos
                foreach ($listaCartasDeck as $c) {
                    $listaCartasDeckView[] = $this->modelo->obtenerCartaDeckBuild($c);
                }

                // Guardamos la lista de cartas a mostrar en la view
                $datos["listaCartasDeck"] = $listaCartasDeckView;
            } else {
                // Si el numero supera a 55 avisaremos al usuario con un error
                if (count($listaCartasDeck)+1 <= 55) {
                    //Añadimos la carta y actualizamos la sesion
                    $listaCartasDeck[] = $numero_carta;
                    $this->session->set("listaCartasDeck", $listaCartasDeck);

                    // Creamos la lista de cartas que se van a pasar a la vista
                    $listaCartasDeckView = array();

                    // Recuperaremos la informacion de las cartas en la base de datos
                    foreach ($listaCartasDeck as $c) {
                        $listaCartasDeckView[] = $this->modelo->obtenerCartaDeckBuild($c);
                    }

                    $datos["listaCartasDeck"] = $listaCartasDeckView;
                } else {
                    // Hacemos una lista con las cartas actuales
                    foreach ($listaCartasDeck as $c) {
                        $listaCartasDeckView[] = $this->modelo->obtenerCartaDeckBuild($c);
                    }

                    $datos["listaCartasDeck"] = $listaCartasDeckView;
                    $datos["errorDeck"] = "El numero de cartas no puede ser mayor a 55 cartas";
                }
            }
        }

        // Hacemos una lista con los costes de la carta dependiendo del maximo coste
        $costes = $this->modelo->obtenerValorMaximo("cartas", "coste");
        $costesLista = array();
        $costesLista[null] = "Ninguno";

        for ($i = 1; $i <= $costes->maxCoste; $i++) {
            $costesLista[$i] = $i;
        }

        // Elementos del filtro
        $colorUno = $this->request->getPost('colorUno');
        $colorDos = $this->request->getPost('colorDos');
        $tipoCarta = $this->request->getPost('tipoCarta');
        $atributo = $this->request->getPost('Atributo');
        $bt = $this->request->getPost('bt');
        $coste = $this->request->getPost('coste');
        $nombre = $this->request->getPost('nombreCarta');
    
        $datos['tituloPagina'] = "Deck Builder";
        $datos['cartas'] = $this->modelo->buscarCarta($colorUno, $colorDos, $tipoCarta, 
                                                        $atributo, $bt, $coste, $nombre);
        $datos['coloresLista'] = $this->modelo->optenerNombres("colores");
        $datos['tiposCartaLista'] = $this->modelo->optenerNombres("tiposcarta");
        $datos['atributosLista'] = $this->modelo->optenerNombres("atributos");
        $datos['btsLista'] = $this->modelo->optenerBTsAbrev();
        $datos['costesLista'] = $costesLista;
        $datos['rol'] = $this->session->get('usuarioRol');

        echo view('elementos/Vcabecera', $datos);
        echo view('decks/VdeckBuild', $datos);
        echo view('elementos/Vpie');
    }

    public function inicioDecks() {
        $datos["listaDecks"] = $this->modelo->optenerDecks($this->session->get("usuarioID"));

        $datos['tituloPagina'] = "Decks";
        $datos['user'] = $this->session->get('usuario');
        $datos['rol'] = $this->session->get('usuarioRol');

        echo view('elementos/Vcabecera', $datos);
        echo view('decks/VinicioDecks', $datos);
        echo view('elementos/Vpie');
    }

    public function guardarDeck() {
        $datos['tituloPagina'] = "Deck Builder";
        $datos['rol'] = $this->session->get('usuarioRol');
        
        echo view('elementos/Vcabecera', $datos);
        echo view('decks/VdeckGuardar');
        echo view('elementos/Vpie');
    }

    public function guardarDeckPasoDos() {
        $nameDeck = $this->request->getPost("nombreDeck");
        echo $nameDeck."<br>".$this->session->get("usuarioID");

        if (is_string($nameDeck) && strlen($nameDeck) >= 5) {

            $listaCartasDeck = $this->session->get("listaCartasDeck");

            $idDeck = $this->modelo->insertarDeck($nameDeck, $this->session->get("usuarioID"));

            if ($idDeck > 0) {
                foreach ($listaCartasDeck as $card) {
                    $this->modelo->insertarCardDeck($card, $idDeck);
                }

                // eliminamos las variables de sesion
                $this->session->remove('nombreDeck');
                $this->session->remove('listaCartasDeck');

                $this->inicioDecks();
            }
        } else {
            $datos['tituloPagina'] = "Deck Builder";
        
            echo view('elementos/Vcabecera', $datos);
            echo view('decks/VdeckGuardar');
            echo view('elementos/Vpie');
        }
    }

    public function verDeck($idDeck) {
        $datos['deck'] = $this->modelo->optenerDeck($idDeck);
        $datos['cartasDeck'] = $this->modelo->optenerCartasDeck($idDeck);
        $datos['tituloPagina'] = "Deck: ".$datos['deck']->nombre;
        $datos['idUser'] = $this->session->get('usuarioID');
        $datos['userAuthor'] = $this->modelo->optenerNombreUser($datos['deck']->idUser)->usuario;
        $datos['rol'] = $this->session->get('usuarioRol');

        echo view('elementos/Vcabecera', $datos);
        echo view('decks/Vdeck', $datos);
        echo view('elementos/Vpie');
    }

    public function eliminarDeck($idDeck) {
        // Eliminamos primero las cartas y luego el deck
        $this->modelo->eliminarCartasDeDeck($idDeck);
        $this->modelo->eliminarDeck($idDeck);

        $this->inicioDecks();
    }
}