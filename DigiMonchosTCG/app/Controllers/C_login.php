<?php

namespace App\Controllers;

use App\Models\M_digimonTCG;

class C_login extends BaseController {
    protected $modelo;

    public function __construct() {
        $this->modelo = new M_digimonTCG();
    }

    public function index() {

        if ($this->session->get('usuario')) {
            $datos['tituloPagina'] = "Inicio";

            echo view('elementos/cabecera', $datos);
            echo view('inicio');
            echo view('elementos/pie');
        } else {
            $this->login();
        }
    }

    public function login() {
        echo view('login');
    }

    public function logearse() {

    }

    public function registro() {
        $datos['user'] = "";
        $datos['email'] = "";

        echo view('registro', $datos);
    }

    public function registrarse() {
        $user = $this->request->getPost('usuario');
        $contra = $this->request->getPost('contra');
        $email = $this->request->getPost('email');


        if ($this->modelo->comprobarNombreUser($user)) {
            $contraCifrada = password_hash($contra, PASSWORD_DEFAULT);
            $this->modelo->insertarUsuario($user, $contraCifrada, $email);

        } else {
            $datos['user'] = $user;
            $datos['email'] = $email;
    
            echo view('registro', $datos);
        }
    }
}
