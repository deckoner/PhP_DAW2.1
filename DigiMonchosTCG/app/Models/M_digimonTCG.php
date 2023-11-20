<?php

namespace App\Models;

use CodeIgniter\Model;

class M_digimonTCG extends Model
{
    protected $db;

    public function __construct()
    {
        $this->db = db_connect(); // Se conecta a la base de datos por defecto
        helper("util");
    }

    // !Comprobaciones
    public function comprobarNombreUser($nombre)
    {
        $query = $this->db->table('usuarios')
            ->where('usuario', $nombre)
            ->get();

        // Comprobamos si el nombre de usuario está libre
        if ($query->getNumRows() > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function comprobarLogin($nombre, $contra)
    {
        $query = $this->db->table('usuarios')
            ->select('id, usuario, rol, contrasena')
            ->where('usuario', $nombre)
            ->get();

        // Comprobamos si ha dado algun resultado
        if ($query->getNumRows() > 0) {
            $user = $query->getRowObject();
            if (comprobarContra($contra, $user->contrasena)) {
                return $user;
            }
        }

        // Devolvemos Null ya sea por que no ahi user o no coincide user y contra
        return null;
    }

    // !Insertar datos
    public function insertarUsuario($nombre, $contra, $email)
    {
        $data = [
            'usuario' => $nombre,
            'contrasena' => $contra,
            'email' => $email,
            'rol' => 'USER'
        ];

        $this->db->table('usuarios')->insert($data);

        return $this->db->insertID();
    }

    public function insertarDeck($nombre, $idUser)
    {
        $data = [
            'idUser' => $idUser,
            'nombre' => $nombre,
            'fechaCreacion' => date('Y-m-d')
        ];

        $this->db->table('decks')->insert($data);

        return $this->db->insertID();
    }

    public function insertarCardDeck($idCarta, $idDeck)
    {
        $data = [
            'idCarta' => $idCarta,
            'idDeck' => $idDeck,
        ];

        $this->db->table('cartasdedecks')->insert($data);
    }

    public function insertarCarta($numero_carta, $nombre, $tipo_carta_id, $rareza_id, $color_uno_id, $color_dos_id, $url_imagen, $coste, $etapa_id, $atributo_id, $tipo_uno_id, $tipo_dos_id, $coste_digievolucion_uno, $coste_digievolucion_dos, $efecto, $digievolucion_efecto, $efecto_seguridad, $bt_id)
    {
        $data = [
            'numero_carta' => $numero_carta,
            'nombre' => $nombre,
            'tipo_carta_id' => $tipo_carta_id,
            'rareza_id' => $rareza_id,
            'color_uno_id' => $color_uno_id,
            'color_dos_id' => $color_dos_id,
            'url_imagen' => $url_imagen,
            'coste' => $coste,
            'etapa_id' => $etapa_id,
            'atributo_id' => $atributo_id,
            'tipo_uno_id' => $tipo_uno_id,
            'tipo_dos_id' => $tipo_dos_id,
            'coste_digievolucion_uno' => $coste_digievolucion_uno,
            'coste_digievolucion_dos' => $coste_digievolucion_dos,
            'efecto' => $efecto,
            'digievolucion_efecto' => $digievolucion_efecto,
            'efecto_seguridad' => $efecto_seguridad,
            'bt_id' => $bt_id,
        ];

        $this->db->table('cartas')->insert($data);
    }

    public function insertarNombreTablak($nombre, $nombreTabla)
    {
        $data = [
            'nombre' => $nombre,
        ];

        $this->db->table($nombreTabla)->insert($data);
    }

    // !Pedir datos
    public function obtenerCarta($btNumber)
    {
        $query = $this->db->query("SELECT c.numero_carta, c.url_imagen, c.coste, c.efecto, c.digievolucion_efecto, c.efecto_seguridad, 
                c.coste_digievolucion_uno AS digiEvoUno, c.coste_digievolucion_dos AS digiEvoDos, 
                c.nombre AS nombre_carta, 
                    (SELECT nombre FROM atributos WHERE id = c.atributo_id) AS atributo,
                    (SELECT nombre FROM colores WHERE id = c.color_uno_id) AS color_uno,
                    (SELECT nombre FROM colores WHERE id = c.color_dos_id) AS color_dos,
                    (SELECT nombre FROM etapas WHERE id = c.etapa_id) AS etapa,
                    (SELECT nombre FROM rarezas WHERE id = c.rareza_id) AS rareza,
                    (SELECT nombre FROM tipos WHERE id = c.tipo_uno_id) AS tipo,
                    (SELECT nombre FROM tiposcarta WHERE id = c.tipo_carta_id) AS tipo_carta,
                    (SELECT nombre FROM bts WHERE id = c.bt_id) AS bt_nombre,
                    (SELECT abreviatura FROM bts WHERE id = c.bt_id) AS bt_abreviatura
            FROM cartas c
            WHERE c.numero_carta = '$btNumber';");

        return $query->getRowObject();
    }

    public function obtenerCartaDeckBuild($btNumber)
    {
        $query = $this->db->query("SELECT c.numero_carta, c.url_imagen,
                    (SELECT nombre FROM tiposcarta WHERE id = c.tipo_carta_id) AS tipo_carta
            FROM cartas c
            WHERE c.numero_carta = '$btNumber';");

        return $query->getRowObject();
    }

    public function obtenerTodasLasCartas()
    {
        $query = $this->db->query('SELECT c.numero_carta, c.nombre, c.url_imagen,
            (SELECT nombre FROM colores WHERE id = c.color_uno_id) AS color_uno,
            (SELECT nombre FROM colores WHERE id = c.color_dos_id) AS color_dos
            FROM cartas c');

        return $query->getResultObject();
    }

    public function buscarCarta($idColor, $idColorDos, $idTipoCarta, $idAtributo, $idBT, $coste, $nombre)
    {
        $builder = $this->db->table('cartas c')
            ->select('c.numero_carta, c.nombre, c.url_imagen,
                                (SELECT nombre FROM colores WHERE id = c.color_uno_id) AS color_uno,
                                (SELECT nombre FROM colores WHERE id = c.color_dos_id) AS color_dos');

        // Condiciones de búsqueda para color_uno_id
        if (!is_null($idColor) && $idColor !== '') {
            $builder->where('c.color_uno_id', $idColor);
        }

        // Condiciones de búsqueda para color_dos_id
        if (!is_null($idColorDos) && $idColorDos !== '') {
            $builder->where('c.color_dos_id', $idColorDos);
        }

        // Condiciones de búsqueda para tipo_carta_id
        if (!is_null($idTipoCarta) && $idTipoCarta !== '') {
            $builder->where('c.tipo_carta_id', $idTipoCarta);
        }

        // Condiciones de búsqueda para atributo_id
        if (!is_null($idAtributo) && $idAtributo !== '') {
            $builder->where('c.atributo_id', $idAtributo);
        }

        // Condiciones de búsqueda para bt_id
        if (!is_null($idBT) && $idBT !== '') {
            $builder->where('c.bt_id', $idBT);
        }

        // Condiciones de búsqueda para coste
        if (!is_null($coste) && $coste !== '') {
            $builder->where('c.coste', $coste);
        }

        // Condiciones de búsqueda para nombre
        if (!is_null($nombre) && $nombre !== '') {
            $builder->like('c.nombre', $nombre);
        }

        $query = $builder->get();

        return $query->getResultObject();
    }

    public function optenerNombres($tablaNombre)
    {
        $query = $this->db->table($tablaNombre)
            ->select('id, nombre')
            ->get();

        return $query->getResultArray();
    }

    public function optenerDecks($userID)
    {
        $query = $this->db->table("decks")
            ->select('id, nombre, fechaCreacion, idUser')
            ->where('idUser', $userID)
            ->get();

        return $query->getResultObject();
    }

    public function optenerDecksComunidad()
    {
        $query = $this->db->table("decks")
            ->select('decks.id, decks.nombre, decks.fechaCreacion, usuarios.usuario as autor')
            ->join('usuarios', 'decks.idUser = usuarios.id')
            ->get();

        return $query->getResultObject();
    }

    public function optenerDeck($idDeck)
    {
        $query = $this->db->table("decks")
            ->select('id, idUser, nombre, fechaCreacion')
            ->where('id ', $idDeck)
            ->get();

        return $query->getRowObject();
    }

    public function optenerCartasDeck($idDeck)
    {
        $query = $this->db->query("SELECT cartas.numero_carta, cartas.nombre, cartas.url_imagen
            FROM cartasdedecks as cd
            INNER JOIN cartas ON cd.idCarta = cartas.numero_carta
            WHERE cd.idDeck = $idDeck;");

        return $query->getResultObject();
    }

    public function optenerBTsAbrev()
    {
        $query = $this->db->table("bts")
            ->select('id, abreviatura')
            ->get();

        return $query->getResultArray();
    }

    public function obtenerValorMaximo($tablaNombre, $campo)
    {
        $this->db->table($tablaNombre);
        $query = $this->db->query("SELECT MAX($campo) AS maxCoste FROM $tablaNombre ;");

        return $query->getRowObject();
    }

    public function optenerNombreUser($idUser)
    {
        $query = $this->db->table("usuarios")
            ->select('usuario')
            ->where('id ', $idUser)
            ->get();

        return $query->getRowObject();
    }

    // !Eliminar datos
    public function eliminarCartasDeDeck($idDeck)
    {
        $this->db->table('cartasdedecks')
            ->where('idDeck', $idDeck)
            ->delete();
    }

    public function eliminarDeck($idDeck)
    {
        $this->db->table('decks')
            ->where('id', $idDeck)
            ->delete();
    }
}
