<?php
namespace App\Models;
use CodeIgniter\Model;

class M_digimonTCG extends Model {
    protected $db;

    public function __construct() {
        $this->db=db_connect(); // Se conecta a la base de datos por defecto
    }

    // !Comprobaciones
    public function comprobarNombreUser($nombre) {
        $consulta = "SELECT usuario FROM usuarios WHERE usuario = $nombre";
        $resultados = $this->db->query($consulta);

        // Comprobamos si el nombre de usuario estal ibre
        if ($resultados->getNumRows() > 0) {
            return false;
        } else {
            return true;
        }
    }

    // !Insertar datos
    public function insertarUsuario($nombre, $contra, $email) {
        $consulta = "INSERT INTO `usuarios` (`usuario`, `contrasena`, `email`, 'rol') 
            VALUES ('$nombre', '$contra', '$email', 'USER') ";

        $this->db->query($consulta);

        return $this->db->insertID();
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
        $consulta = "SELECT idPlato, nombre, precio, fecha FROM platos WHERE idPlato = $idPlato";
        $resultados = $this->db->query($consulta);

        return $resultados->getRowObject();
    }

    public function platoConImagen($idPlato) {
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

    public function ingredientesNoPlato($idPlato) {
        $consulta = "SELECT i.nombre as nombre, i.idIngrediente as idIngrediente
            FROM ingredientes as i 
            WHERE i.idIngrediente NOT IN (
                SELECT c.idIngrediente 
                FROM composicion as c
                WHERE c.idPlato = $idPlato
            )";
        $resultados = $this->db->query($consulta);
    
        return $resultados->getResultObject();
    }

    public function insertarIngredientePlato($idPlato, $idIngrediente) {
        $consulta = "INSERT INTO composicion(idPlato, idIngrediente) VALUE ($idPlato, $idIngrediente)";
        $resultados = $this->db->query($consulta);
    
        return $resultados->getResultObject();
    }
}