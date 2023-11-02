<?php
namespace App\Models;
use CodeIgniter\Model;

class MRestaurante extends Model {
    protected $db;

    public function __construct() {
        $this->db=db_connect(); // Se conecta a la base de datos por defecto
    }

    public function platosCaros() {

        $consulta = "SELECT * FROM platos WHERE (SELECT avg(precio) from platos)";
        $resultados = $this->db->query($consulta);

        return $resultados->getResultObject();
    }


    public function platosSinPedir() {

        $consulta = "SELECT count(*) as numero FROM platos 
            WHERE idplato not in (SELECT DISTINCT idplato from pedidos)";
        $resultados = $this->db->query($consulta);

        return $resultados->getRowArray()['numero'];
    }

    public function platosPedidos() {

        $consulta = "SELECT count(*) as numero FROM platos 
            WHERE idplato in (SELECT DISTINCT idplato from pedidos)";
        $resultados = $this->db->query($consulta);

        return $resultados->getRowArray()['numero'];
    }

    public function listaPlatos() {

        $consulta = "SELECT idplato, nombre, precio, count(*) FROM platos, pedidos WHERE platos.idplato = pedidos.idplato";
        $resultados = $this->db->query($consulta);

        return $resultados->getResultObject();
    }

    public function platosConNumeroPedidos() {
        $consulta = "select idPlato, nombre, precio, (select count(*) from pedidos where pedidos.idPlato = platos.idPlato) as repetidos 
            from platos";

        $resultados = $this->db->query($consulta);
        return $resultados->getResultObject();
    }

    public function insertarPlato($nombre, $precio, $fecha) {
        $consulta = "INSERT INTO `platos` (`nombre`, `precio`, `fecha`) 
                    VALUES ('$nombre', '$precio', '$fecha') ";

        $this->db->query($consulta);

        return $this->db->insertID();
    }

    public function plato($idPlato) {
        $consulta = "SELECT * FROM platos WHERE idPlato = $idPlato";
        $resultados = $this->db->query($consulta);

        return $resultados->getRowObject();
    }

    public function ingredientesPlato($idPlato) {
        $consulta = "SELECT c.idPlato, i.nombre as nombre, c.cantidad as cantidad
            FROM composicion as c, ingredientes as i 
            WHERE c.idPlato = $idPlato AND c.idIngrediente = i.idIngrediente";
        $resultados = $this->db->query($consulta);

        return $resultados->getResultObject();
    }
}