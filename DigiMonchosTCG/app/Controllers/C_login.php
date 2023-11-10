<?php

namespace App\Controllers;

use App\Models\M_digimonTCG;

class C_login extends BaseController {
    protected $modelo;

    public function __construct() {
        $this->modelo = new M_digimonTCG();        
        helper('util');
    }

    public function index() {
        if (!empty($this->session->get('usuario'))) {
            $datos['tituloPagina'] = "Inicio";

            echo view('elementos/Vcabecera', $datos);
            echo view('Vinicio');
            echo view('elementos/Vpie');
        } else {
            $this->login();
        }
    }

    public function login() {
        echo view('Vlogin');
    }

    public function logearse() {
        $user = $this->request->getPost('usuario');
        $contra = strval($this->request->getPost('contra'));

        $user = $this->modelo->comprobarLogin($user, $contra);

        if (!is_null($user)) {
            // Guardamos su informacion en la sesion
            $this->session->set('usuarioID', $user->id);
            $this->session->set('usuario', $user->usuario);
            $this->session->set('usuarioRol', $user->rol);

            // Y lo enviamos al index
            $this->index();
        } else {
            $datos['erroresTexto'] = "Usuario o contraseña incorrecta, intentelo de nuevo";
            echo view('Vlogin', $datos);
        }
    }

    public function registro() {
        $datos['user'] = "";
        $datos['email'] = "";

        $datos['erroresTexto'] = "";

        echo view('Vregistro', $datos);
    }

    public function registrarse() {
        $user = $this->request->getPost('usuario');
        $contra = strval($this->request->getPost('contra'));
        $email = $this->request->getPost('email');
        $erroresTexto = "";
        $exito = true;

        // Comprobamos que ningun campo este vacio
        if (!empty($user) and !empty($contra) and !empty($email)) {
            // Comprobamos que el nombre de usuario este disponible
            if (!$this->modelo->comprobarNombreUser($user)) {
                $erroresTexto = "Nombre de usuario ya existente";
                $exito = false;
            }

            // Comprobamso que sea un email valido
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $erroresTexto .= "Email no valido<br>";
                $exito = false;
            }

            // Comprobamos que la contraseña sea de minimo 6 caracteres
            if (!(strlen($contra) >= 6)) {
                $erroresTexto .= "Contraseña muy corta<br>";
                $exito = false;
            }

        } else {
            $erroresTexto = "No puede dejar ningun campo en blanco";
            $exito = false;
        }

        // comprobamos exito
        if ($exito) {
            // Ciframos la contraseña y creamos un nuevo user
            $contraCifrada = encriptarContra($contra);
            $this->modelo->insertarUsuario($user, $contraCifrada, $email);

            echo view('Vlogin');
        } else {
            // Volvemos a la pagina registro con los errores del registro
            $datos['user'] = $user;
            $datos['email'] = $email;
            $datos['erroresTexto'] = $erroresTexto;
    
            echo view('Vregistro', $datos);
        }
    }

    public function logout() {
        $this->session->destroy();
        return redirect('/');
    }
}
