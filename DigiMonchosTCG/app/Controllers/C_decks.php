<?php

namespace App\Controllers;

use App\Models\M_digimonTCG;

class C_decks extends BaseController {
    protected $modelo;

    public function __construct() {
        $this->modelo = new M_digimonTCG();        
        helper('util');
    }

    public function decks() {
        $datos['tituloPagina'] = "Coleccion";

        echo view('elementos/Vcabecera', $datos);
        echo view('carta', $datos);
        echo view('elementos/Vpie');
    }
}