<?php

namespace App\Controllers;

use App\Models\M_digimonTCG;

class C_comunidad extends BaseController {
    protected $modelo;

    public function __construct() {
        $this->modelo = new M_digimonTCG();        
        helper('util');
    }

    public function inicio() {
        $datos['tituloPagina'] = "Admin";
        $datos['rol'] = $this->session->get('usuarioRol');
        $datos['listaDecks'] = $this->modelo->optenerDecksComunidad();

        echo view('elementos/Vcabecera', $datos);
        echo view('comunidad/decksComunidad', $datos);
        echo view('elementos/Vpie');
    }
}