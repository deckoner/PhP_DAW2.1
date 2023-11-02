<?php

namespace App\Controllers;

class Home extends BaseController {
    public function index() {
        $datos['tituloPagina'] = "Inicio";

        echo view('cabecera', $datos);
        echo view('prueba');
        echo view('pie');
    }
}
