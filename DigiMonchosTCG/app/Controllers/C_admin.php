<?php

namespace App\Controllers;

use App\Models\M_digimonTCG;

class C_admin extends BaseController {
    protected $modelo;

    public function __construct() {
        $this->modelo = new M_digimonTCG();        
        helper('util');
    }

    public function panel() {
        $datos['tituloPagina'] = "Admin";
        $datos['rol'] = $this->session->get('usuarioRol');

        $datos['atributosLista'] = $this->modelo->optenerNombres("atributos");
        $datos['coloresLista'] = $this->modelo->optenerNombres("colores");
        $datos['etapasLista'] = $this->modelo->optenerNombres("etapas");
        $datos['rarezasLista'] = $this->modelo->optenerNombres("rarezas");
        $datos['tiposLista'] = $this->modelo->optenerNombres("tipos");
        $datos['tiposCartaLista'] = $this->modelo->optenerNombres("tiposcarta");

        echo view('elementos/Vcabecera', $datos);
        echo view('admin/panel');
        echo view('elementos/Vpie');
    }

    public function insertarDato() {
        $valor = $this->request->getPost('valor');
        $tabla = $this->request->getPost('nombreTabla');
        $datos['tituloPagina'] = "Admin";
        $datos['rol'] = $this->session->get('usuarioRol');
        $datos['aviso'] = "Se ha insertado el nuevo elemento";

        $this->modelo->insertarNombreTablak($valor, $tabla);

        echo view('elementos/Vcabecera', $datos);
        echo view('admin/panel', $datos);
        echo view('elementos/Vpie');
    }
}