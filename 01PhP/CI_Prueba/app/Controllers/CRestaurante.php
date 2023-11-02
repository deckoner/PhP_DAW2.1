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
        $datos['platos'] = $this->modelo->platosConNumeroPedidos();

        echo view("Vcabecera");
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

    public function compo($idPlato) {
        $this->session->set('platoSelecionado', $this->modelo->plato($idPlato));
        $this->session->set('nuevosIgredientes', []);
        $this->session->set('platoIngredientes', $this->modelo->ingredientesPlato($idPlato));
        $this->session->set('platoNoIngredientes', $this->modelo->ingredientesNoPlato($idPlato));

        $datoPlato['platos'] = $this->modelo->platosConNumeroPedidos();

        echo view("Vcabecera");
        echo view("VListaPlatos", $datoPlato);
        echo view("VDetallePlato2");
        echo view("VQuitaPonIngredientes");
        echo view("Vpie");
    }

    public function anadeIngrediente() {
        if ($this->request->getPost('submitAnadirIngrediente')) {
            $idIgrediente = $this->request->getPost('ingrediente'); 

            if (in_array($idIgrediente, $this->session->get('nuevosIgredientes'))) {
                $arr = $this->session->get('nuevosIgredientes');
                $arr[] = $idIgrediente;
                $this->session->set('nuevosIgredientes', $arr);
            }

        }

        if ($this->request->getPost('submitQuitarIngrediente')) {
            $idIgrediente = $this->request->getPost('ingrediente'); 

            if (in_array($idIgrediente, $this->session->get('nuevosIgredientes'))) {
                $arr = $this->session->get('nuevosIgredientes');

                $idArr = array_search($idIgrediente, $arr);
                unset($arr[$idArr]);

                $this->session->set('nuevosIgredientes', $arr);
            }

        }

        echo view("Vcabecera");
        echo view("VDetallePlato2");
        echo view("VQuitaPonIngredientes");
        echo view("Vpie");
    }

    public function grabarIngredientes() {
        $idPlato = $this->session->get('platoSelecionado');
        $nuevoIngrediente = $this->session->get('nuevosIgredientes');

        foreach($nuevoIngrediente as $idingrediente) {
            $this->modelo->insertarIngredientePlato($idPlato, $idingrediente);
        }
    }
}