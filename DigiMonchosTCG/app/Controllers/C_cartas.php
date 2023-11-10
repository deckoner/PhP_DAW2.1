<?php

namespace App\Controllers;

use App\Models\M_digimonTCG;

class C_cartas extends BaseController {
    protected $modelo;

    public function __construct() {
        $this->modelo = new M_digimonTCG();        
        helper('util');
    }

    public function coleccion() {
        // Hacemos una lista con los costes de la carta dependiendo del maximo coste
        $costes = $this->modelo->obtenerValorMaximo("cartas", "coste");
        $costesLista = array();
        $costesLista[null] = "Ninguno";

        for ($i = 1; $i <= $costes->maxCoste; $i++) {
            $costesLista[$i] = $i;
        }

        $datos['tituloPagina'] = "Coleccion";
        $datos['cartas'] = $this->modelo->obtenerTodasLasCartas();
        $datos['coloresLista'] = $this->modelo->optenerNombres("colores");
        $datos['tiposCartaLista'] = $this->modelo->optenerNombres("tiposcarta");
        $datos['atributosLista'] = $this->modelo->optenerNombres("atributos");
        $datos['btsLista'] = $this->modelo->optenerBTsAbrev();
        $datos['costesLista'] = $costesLista;

        echo view('elementos/Vcabecera', $datos);
        echo view('cartas/Vcoleccion', $datos);
        echo view('elementos/Vpie');
    }   

    public function coleccionBusqueda() {


    }

    public function cartaInformacion($btNumber) {
        $carta = $this->modelo->obtenerCarta($btNumber);

        // Comprobamos si la carta existe para el titulo
        if (is_null($carta)) {
            $datos['tituloPagina'] = "No encontrada";
        } else {
            $datos['tituloPagina'] = $carta->numero_carta;
        }
        
        $datos['carta'] = $carta;

        echo view('elementos/Vcabecera', $datos);
        echo view('cartas/VcartaInformacion', $datos);
        echo view('elementos/Vpie');
    }
}