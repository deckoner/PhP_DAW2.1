<?php 
// !Conexion al servidor
function conexion($nombreDB, $user, $contra, $host) {
    try {
        $db = new PDO("mysql:host=$host;dbname=$nombreDB", $user, $contra);
        return $db;
    } catch (PDOException $e) {
        echo $e;
        return false;
    }
}

// !Eliminar datos
function eliminarFunciones($db, $idPelicula) {
    // Preparar la consulta SQL para eliminar las imágenes
    $query = "DELETE FROM funciones WHERE funciones.IDPELICULA = :idPelicula";

    // Preparar y ejecutar la declaración
    $statement = $db->prepare($query);
    $statement->bindParam(':idPelicula', $idPelicula, PDO::PARAM_STR);

    $statement->execute();
}

function eliminarPeliculas($db, $idPelicula) {
    // Preparar la consulta SQL para eliminar las imágenes
    $query = "DELETE FROM peliculas WHERE peliculas.IDPELICULA = :idPelicula";

    // Preparar y ejecutar la declaración
    $statement = $db->prepare($query);
    $statement->bindParam(':idPelicula', $idPelicula, PDO::PARAM_STR);

    $statement->execute();
}

// !Recuperar datos
function listarCategorias($db) {
    $st = $db->query("SELECT DISTINCT CATEGORIA FROM peliculas");
    $st->setFetchMode(PDO::FETCH_OBJ);
    return $st->fetchAll();
}

function peliculasPorCategoria($db, $categoria) {
    $st = $db->prepare("SELECT * FROM peliculas WHERE CATEGORIA = :categoria");
    $st->bindParam(':categoria', $categoria, PDO::PARAM_STR);
    $st->execute();

    $resultados = $st->fetchAll(PDO::FETCH_OBJ);
    return $resultados;
}

function listarFuncionesPorPelicula($db, $idPelicula) {
    $st = $db->prepare("SELECT c.imagen as imagen, f.NUM_SALA as numeroSala, f.FECHA_HORA as fecha, f.RECAUDACION as recaudado, (f.VENDIDOS / s.CAPACIDAD * 100) as porcentaje
	    FROM funciones as f, peliculas as p, cines as c, salas as s 
        WHERE f.IDPELICULA = :idPelicula AND f.IDPELICULA = p.IDPELICULA and f.IDCINE = c.IDCINE AND s.NUMERO = f.NUM_SALA");
    $st->bindParam(':idPelicula', $idPelicula, PDO::PARAM_STR);
    $st->execute();

    $resultados = $st->fetchAll(PDO::FETCH_OBJ);
    return $resultados;
}

function nombrePelicula($db, $id) {
    $st = $db->prepare("SELECT * FROM peliculas WHERE IDPELICULA = :id");
    $st->bindParam(':id', $id, PDO::PARAM_STR);
    $st->execute();

    $resultado = $st->fetch(PDO::FETCH_OBJ);
    return $resultado->TITULO;
}

function obtenerFuncionesPelicula($conexion, $idPelicula) {
    // Consulta SQL para obtener las funciones de la película
    $consulta = 'SELECT f.IDFUNCION as id, f.FECHA_HORA as fecha, f.IDCINE, f.NUM_SALA as sala, c.imagen as cine, (s.CAPACIDAD - f.VENDIDOS) as vendidas
	    FROM funciones as f, cines as c, salas as s 
	    WHERE f.IDPELICULA = :idPelicula AND c.IDCINE = f.IDCINE AND s.IDCINE = f.IDCINE AND f.NUM_SALA = s.NUMERO';

    // Preparar la consulta
    $stmt = $conexion->prepare($consulta);

    // Bind de parámetros
    $stmt->bindParam(':idPelicula', $idPelicula, PDO::PARAM_STR);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener los resultados
    $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);

    // Devolver los resultados
    return $resultados;
}

function funcionReserva($db, $idFuncion) {
    $st = $db->prepare("SELECT f.NUM_SALA as sala, p.TITULO as pelicula, c.PRECIO_ENTRADA as precio, c.NOMBRE as nombreCine, f.IDFUNCION as numero, (s.CAPACIDAD - f.VENDIDOS) as vendidas, s.CAPACIDAD as capacidad
	    FROM funciones as f, peliculas as p, cines as c, salas as s
	    WHERE f.IDFUNCION = :idFuncion AND p.IDPELICULA = f.IDPELICULA AND c.IDCINE = f.IDCINE AND s.IDCINE = f.IDCINE");
    $st->bindParam(':idFuncion', $idFuncion, PDO::PARAM_STR);
    $st->execute();

    $resultado = $st->fetch(PDO::FETCH_OBJ);
    return $resultado;
}

function recuperarRecaudacion($db) {
    $st = $db->prepare("SELECT f.IDPELICULA as idPelicula, p.TITULO as nombre, SUM(f.RECAUDACION) AS totalRecaudadoo 
        FROM funciones as f, peliculas as p 
        WHERE f.IDPELICULA = p.IDPELICULA GROUP BY IDPELICULA");
    $st->execute();

    $resultado = $st->fetchAll(PDO::FETCH_OBJ);
    return $resultado;
}

// !Modificar datos

function cobrarEntrada($db, $idFuncion, $recaudacion, $entradasVendidas) {
    // Preparar la consulta SQL para actualizar el campo "activo" del usuario
    $query = "UPDATE funciones 
        SET RECAUDACION = RECAUDACION + :recaudacion, VENDIDOS = VENDIDOS + :entradasVendidas 
        WHERE IDFUNCION = :idFuncion";

    // Preparar la sentencia SQL
    $stmt = $db->prepare($query);

    // Vincular el parámetro
    $stmt->bindParam(':entradasVendidas', $entradasVendidas, PDO::PARAM_INT);
    $stmt->bindParam(':recaudacion', $recaudacion, PDO::PARAM_INT);
    $stmt->bindParam(':idFuncion', $idFuncion, PDO::PARAM_INT);

    // Ejecutar la consulta
    $stmt->execute();
}
?>