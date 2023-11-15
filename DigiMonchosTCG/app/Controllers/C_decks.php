<?php

namespace App\Controllers;

use App\Models\M_digimonTCG;

class C_decks extends BaseController {
    protected $modelo;

    public function __construct() {
        $this->modelo = new M_digimonTCG();        
        helper('util');
    }

    public function crearDeck($numero_carta = null) {
        // Si existe un numero de carta lo intentaremos meter a la listaDeck
        if (!is_null($numero_carta)) {
            // Si no existe la variable de listaCartasDeck la creamos
            if (!$this->session->has("listaCartasDeck")) {
                $listaCartasDeck = array();

            } else {
                $listaCartasDeck = $this->session->get("listaCartasDeck");
            }

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
                $datos["errorDeck"] = "El numero de cartas no puede ser mayor a 55 cartas";
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
    
        $datos['tituloPagina'] = "Coleccion";
        $datos['cartas'] = $this->modelo->buscarCarta($colorUno, $colorDos, $tipoCarta, 
                                                        $atributo, $bt, $coste, $nombre);
        $datos['coloresLista'] = $this->modelo->optenerNombres("colores");
        $datos['tiposCartaLista'] = $this->modelo->optenerNombres("tiposcarta");
        $datos['atributosLista'] = $this->modelo->optenerNombres("atributos");
        $datos['btsLista'] = $this->modelo->optenerBTsAbrev();
        $datos['costesLista'] = $costesLista;

        echo view('elementos/Vcabecera', $datos);
        echo view('decks/VdeckBuild', $datos);
        echo view('elementos/Vpie');
    }

    public function inicioDecks() {
        $datos["listaDecks"] = $this->modelo->optenerDecks($this->session->get("usuarioID"));

        $datos['tituloPagina'] = "Decks";
        $datos['user'] = $this->session->get('usuario');

        echo view('elementos/Vcabecera', $datos);
        echo view('decks/VinicioDecks', $datos);
        echo view('elementos/Vpie');
    }
}