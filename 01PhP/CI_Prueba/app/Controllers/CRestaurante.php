<?php

namespace App\Controllers;

use App\Models\MRestaurante;

class CRestaurante extends BaseController
{

    protected $modelo;

    public function __construct() {
        $this->modelo = new MRestaurante();
    }

    public function index() {
        $arr = $this->modelo->platosCaros();
        $n = $this->modelo->platosSinPedir();
        $nDos = $this->modelo->platosPedidos();

        echo view("Vcabecera");

        $datos['arrayPlatos'] = $arr;
        $datos['nPlatosNoPedidos'] = $n;
        $datos['nPlatosPedidos'] = $nDos;
        echo view("VPlatosCaros", $datos);
        echo view("Vpie");
    }

    public function platos() {
        echo view("Vcabecera");

        $datos['platos'] = $this->modelo->platosConNumeroPedidos();

        echo view("VListaPlatos", $datos);
        echo view("VFormPlato");
        echo view("Vpie");
        
    }

    public function anadirPlato() { // *Submit de nuevo plato
        if ($this->request->getPost('aniadePlato')) {
            $nombre = $this->request->getPost('nombre');
            $precio = $this->request->getPost('precio');
            $fecha = $this->request->getPost('fecha');

            $this->modelo->insertarPlato($nombre, $precio, $fecha);
        }

        $this->platos();
    }

    public function verDetalle($idPlato) {
        $datos['platoDetalle'] = $this->modelo->plato($idPlato);
        $datos['platoIngredientes'] = $this->modelo->ingredientesPlato($idPlato);

        echo view("Vcabecera");
        echo view("VDetallePlato", $datos);
        echo view("Vpie");
    }
}
