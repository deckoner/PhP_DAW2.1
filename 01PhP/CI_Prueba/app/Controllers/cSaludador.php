<?php

namespace App\Controllers;
use App\Models\MSaludador;


class cSaludador extends BaseController
{
    public function index()
    {
        echo "<h1>Holiwis amiguitos</h1>";
    }

    public function adios($nVeces=1) {
        while ($nVeces > 0) {
            echo "<h1>Decir Dios adios</h1>";
            $nVeces--;
        }
    }

    public function saludarTabla() {
        echo view("Vcabecera");
        echo view("Vcuerpo");
        echo view("Vpie");
    }

    public function saludarIdioma($idioma) {
        $modeloSaludador = new MSaludador;
        $arr = $modeloSaludador->saludoSegunIdioma($idioma);

        echo view("Vcabecera");

        $datos['arraySaludos'] = $arr;
        echo view("Vsaludar", $datos);
        echo view("Vpie");
    }

    public function listarPlatos() {
        
    }
}
