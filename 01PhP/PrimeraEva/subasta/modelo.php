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

// !Insertar datos

function insertarUsuario($db, $username, $nombre, $password, $email, $cadenaverificacion) {
    // Preparar la consulta SQL para insertar un nuevo usuario
    $query = "INSERT INTO usuarios (username, nombre, password, email, cadenaverificacion, activo, falso) 
                VALUES (:username, :nombre, :password, :email, :cadenaverificacion, 0, 0)";

    // Preparar la sentencia SQL
    $stmt = $db->prepare($query);

    // Vincular parámetros
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':cadenaverificacion', $cadenaverificacion, PDO::PARAM_STR);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        return true; // La inserción se realizó con éxito
    } else {
        return false; // Hubo un error en la inserción
    }
}

function insertarImagen($db, $idItem, $nombreIMG) {
    // Preparar la consulta SQL para insertar un nuevo usuario
    $query = "INSERT INTO imagenes (id_item, imagen) 
                VALUES (:id_item, :imagen)";

    // Preparar la sentencia SQL
    $stmt = $db->prepare($query);

    // Vincular parámetros
    $stmt->bindParam(':id_item', $idItem, PDO::PARAM_INT);
    $stmt->bindParam(':imagen', $nombreIMG, PDO::PARAM_STR);


    // Ejecutar la consulta
    if ($stmt->execute()) {
        return true; // La inserción se realizó con éxito
    } else {
        return false; // Hubo un error en la inserción
    }
}

function insertarPuja($db, $idItem, $idUser, $cantidad) {
    // Preparar la consulta SQL para insertar un nuevo usuario
    $query = "INSERT INTO pujas (id_item, id_user, cantidad, fecha) 
                VALUES (:id_item, :id_user, :cantidad, :fecha)";

    $fecha_actual = date("Y-m-d");

    // Preparar la sentencia SQL
    $stmt = $db->prepare($query);

    // Vincular parámetros
    $stmt->bindParam(':id_item', $idItem, PDO::PARAM_STR);
    $stmt->bindParam(':id_user', $idUser, PDO::PARAM_STR);
    $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_STR);
    $stmt->bindParam(':fecha', $fecha_actual, PDO::PARAM_STR);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        return true; // La inserción se realizó con éxito
    } else {
        return false; // Hubo un error en la inserción
    }
}

function insertarItem($db, $nombre, $descripcion, $fecha, $precio, $idCat, $idUser) {
    // Preparar la consulta SQL para insertar un nuevo usuario
    $query = "INSERT INTO item (id_cat, id_user, nombre, preciopartida, descripcion, fechafin) 
                VALUES (:id_cat, :id_user, :nombre, :preciopartida, :descripcion, :fechafin)";

    // Preparar la sentencia SQL
    $stmt = $db->prepare($query);

    echo $fecha;

    // Vincular parámetros
    $stmt->bindParam(':id_cat', $idCat, PDO::PARAM_STR);
    $stmt->bindParam(':id_user', $idUser, PDO::PARAM_STR);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':preciopartida', $precio, PDO::PARAM_STR);
    $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
    $stmt->bindParam(':fechafin', $fecha);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        return $db->lastInsertId(); // La inserción se realizó con éxito
    } else {
        return 0; // Hubo un error en la inserción
    }
}

// !Modificar datos
function activarUser($db, $cadena, $email) {
    // Preparar la consulta SQL para actualizar el campo "activo" del usuario
    $query = "UPDATE usuarios SET activo = 1 
                WHERE cadenaverificacion = :cadenaverificacion AND email = :email";

    // Preparar la sentencia SQL
    $stmt = $db->prepare($query);

    // Vincular el parámetro
    $stmt->bindParam(':cadenaverificacion', $cadena);
    $stmt->bindParam(':email', $email);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

function modificarPrecio($db, $precio, $idItem) {
    // Preparar la consulta SQL para actualizar el campo "activo" del usuario
    $query = "UPDATE item SET preciopartida = :precio WHERE id = :idItem";

    // Preparar la sentencia SQL
    $stmt = $db->prepare($query);

    // Vincular el parámetro
    $stmt->bindParam(':precio', $precio);
    $stmt->bindParam(':idItem', $idItem);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

function modificarFecha($db, $fecha, $idItem) {
    // Preparar la consulta SQL para actualizar el campo "activo" del usuario
    $query = "UPDATE item SET fechafin = :fecha WHERE id = :idItem";

    // Preparar la sentencia SQL
    $stmt = $db->prepare($query);

    // Vincular el parámetro
    $stmt->bindParam(':fecha', $fecha);
    $stmt->bindParam(':idItem', $idItem);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

function eliminarImagen($db, $idImagen) {
    // Preparar la consulta SQL para eliminar la imagen
    $consulta = "DELETE FROM imagenes WHERE id = :idImagen";

    // Preparar la sentencia SQL
    $stmt = $db->prepare($consulta);

    // Vincular el parámetro
    $stmt->bindParam(':idImagen', $idImagen, PDO::PARAM_INT);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        return true; // Éxito al eliminar la imagen
    } else {
        return false; // Error al eliminar la imagen
    }
}

function eliminarImagenesPorItem($db, $id_item) {
    // Preparar la consulta SQL para eliminar las imágenes
    $query = "DELETE FROM imagenes WHERE id_item = :id_item";

    // Preparar y ejecutar la declaración
    $statement = $db->prepare($query);
    $statement->bindParam(':id_item', $id_item, PDO::PARAM_INT);

    $statement->execute();
}

function eliminarPujasPorItem($db, $id_item) {
    // Preparar la consulta SQL para eliminar las imágenes
    $query = "DELETE FROM pujas WHERE id_item = :id_item";

    // Preparar y ejecutar la declaración
    $statement = $db->prepare($query);
    $statement->bindParam(':id_item', $id_item, PDO::PARAM_INT);

    $statement->execute();
}

function eliminarItem($db, $id_item) {
    // Preparar la consulta SQL para eliminar las imágenes
    $query = "DELETE FROM item WHERE id = :id_item";

    // Preparar y ejecutar la declaración
    $statement = $db->prepare($query);
    $statement->bindParam(':id_item', $id_item, PDO::PARAM_INT);

    $statement->execute();
}

// !Recuperar dato y listas
function categorías($db) {
    $st = $db->query("SELECT id, categoria FROM categorias");
    $st->setFetchMode(PDO::FETCH_OBJ);
    return $st->fetchAll();
}

function itemPorCategoria($db, $id) {
    $fechaActual = date('Y-m-d H:i:s');

    $st = $db->prepare("SELECT * FROM item WHERE id_cat = :id AND fechafin > :fechaActual");
    $st->bindParam(':id', $id, PDO::PARAM_INT);
    $st->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
    $st->execute();

    $resultados = $st->fetchAll(PDO::FETCH_OBJ);
    return $resultados;
}

function listarItems($db) {
    $fechaActual = date('Y-m-d H:i:s');

    $sql = "SELECT * FROM item WHERE fechafin > :fechaActual";
    
    $st = $db->prepare($sql);
    $st->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
    $st->execute();
    
    $st->setFetchMode(PDO::FETCH_OBJ);
    return $st->fetchAll();
}

function login($db, $user, $contra) {
    // Sanitiza y escapa las entradas para prevenir inyección de SQL
    $user = $db->quote($user);

    // Consulta SQL para buscar al usuario en la base de datos
    $query = "SELECT id, username, activo, password FROM usuarios WHERE username = $user";
    
    // Ejecutar la consulta
    $result = $db->query($query);

    if ($result && $result->rowCount() > 0) {
        // El usuario existe, recupera sus datos
        $usuario = $result->fetch(PDO::FETCH_OBJ);

        // Verificar la contraseña
        if (password_verify($contra, $usuario->password)) {
            // Las credenciales son correctas
            return $usuario;
        }
    }

    // El usuario no existe o las credenciales son incorrectas
    return false;
}

function obtenerDatosItem($db, $idItem) {
    $consulta = "
        SELECT 
            imagenes.imagen AS imagen,
            item.nombre AS nombre,
            IFNULL(pujas_info.pujas, 0) as pujas,
            COALESCE(pujas_info.precio, item.preciopartida) AS precio,
            item.fechafin AS fechafin,
            item.id_user AS id_user,
            item.id AS id_item,
            item.descripcion as descripcion,
            item.preciopartida as precioPartida
        FROM item
        LEFT JOIN imagenes ON item.id = imagenes.id_item
        LEFT JOIN (
            SELECT 
                id_item,
                COUNT(id) as pujas,
                MAX(cantidad) as precio
            FROM pujas
            GROUP BY id_item
        ) as pujas_info ON item.id = pujas_info.id_item
        WHERE item.id = ?
        ORDER BY precio DESC
        LIMIT 1";
        
    $stmt = $db->prepare($consulta);
    $stmt->execute([$idItem]);

    $resultado = $stmt->fetch(PDO::FETCH_OBJ);
    return $resultado;
}

function optenerImagenesItem($db, $idItem) {
    $consulta = "SELECT imagen, id FROM `imagenes` WHERE id_item = ?; ";

    $stmt = $db->prepare($consulta);
    $stmt->execute([$idItem]);

    $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);

    // Si no se encontraron imágenes, devolver null
    if (empty($resultado)) {
        return null;
    }

    return $resultado;
}

function optenerImageneItem($db, $id) {
    $consulta = "SELECT imagen, id FROM `imagenes` WHERE id = ?; ";

    $stmt = $db->prepare($consulta);
    $stmt->execute([$id]);

    $resultado = $stmt->fetch(PDO::FETCH_OBJ);

    // Si no se encontraron imágenes, devolver null
    if (empty($resultado)) {
        return null;
    }

    return $resultado;
}

function historialPujasItem($db, $idItem) {
    $consulta = "SELECT usuarios.nombre, pujas.cantidad FROM `pujas`, `usuarios` 
                WHERE pujas.id_item = ? AND usuarios.id = pujas.id_user ORDER BY pujas.cantidad DESC";

    $stmt = $db->prepare($consulta);
    $stmt->execute([$idItem]);

    $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);

    // Si no se encontraron pujas, devolver null
    if (empty($resultado)) {
        return null;
    }

    return $resultado;
}

function optenerNPujasDiarias($db, $id_item, $id_user,) {
    $consulta = "SELECT COUNT(*) AS num_bids FROM pujas WHERE id_item = ? AND id_user = ? AND fecha = ?";

    $fecha_actual = date("Y-m-d");

    $stmt = $db->prepare($consulta);
    $stmt->execute([$id_item, $id_user, $fecha_actual]);

    $resultado = $stmt->fetch();

    $num_pujas = intval($resultado[0]);

    return $num_pujas;
}

function existePuja($db, $idItem) {
    $consulta = "SELECT * FROM `pujas` WHERE id_item = $idItem; ";

    // Ejecutar la consulta
    $result = $db->query($consulta);

    // Devolvemos true si esta disponible
    if ($result && $result->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

function obtenerItemsVencidos($db) {
    // Obtener la fecha y hora actual en PHP
    $fechaActual = date('Y-m-d H:i:s');

    $query = "SELECT
                i.id AS item_id,
                i.nombre AS item_nombre,
                i.descripcion AS item_descripcion,
                CASE
                    WHEN i.fechafin < :fechaActual THEN COALESCE(MAX(p.cantidad), i.preciopartida)
                    ELSE i.preciopartida
                END AS precio_final,
                CASE
                    WHEN i.fechafin < :fechaActual THEN COALESCE(u.nombre, 'Sin pujas')
                END AS ganador
              FROM
                item i
              LEFT JOIN pujas p ON i.id = p.id_item
              LEFT JOIN usuarios u ON p.id_user = u.id
              WHERE i.fechafin < :fechaActual
              GROUP BY
                i.id, i.nombre, i.preciopartida, u.nombre";
    
    $statement = $db->prepare($query);
    $statement->bindParam(':fechaActual', $fechaActual, PDO::PARAM_STR);
    $statement->execute();
    
    return $statement->fetchAll(PDO::FETCH_OBJ);
}

function obtenerItemsPublicar($db) {
    $query = "SELECT item.id, item.nombre, item.descripcion, item.fechafin, item.preciopartida,
                (SELECT MAX(pujas.cantidad) FROM pujas WHERE pujas.id_item  = item.id) as cantidad
              FROM item
              WHERE (SELECT MAX(pujas.cantidad) FROM pujas WHERE pujas.id_item  = item.id) IS NULL
                 OR (SELECT MAX(pujas.cantidad) FROM pujas WHERE pujas.id_item  = item.id) <= 1.1 * item.preciopartida";

    $statement = $db->prepare($query);
    $statement->execute();
    
    return $statement->fetchAll(PDO::FETCH_OBJ);
}


// !Comprobaciones
function comprobarUserName($db, $username) {
    // Sanitiza y escapa las entradas para prevenir inyección de SQL
    $username = $db->quote($username);

    // Consulta SQL para buscar al usuario en la base de datos
    $query = "SELECT username FROM usuarios WHERE username = $username";
    
    // Ejecutar la consulta
    $result = $db->query($query);

    // Devolvemos true si esta disponible
    if ($result && $result->rowCount() > 0) {
        return false;
    } else {
        return true;
    }
}

function comprobarUserCadena($db, $cadena, $email) {
    // Consulta SQL con marcadores de posición
    $query = "SELECT cadenaverificacion, email FROM usuarios 
              WHERE cadenaverificacion = :cadena AND email = :email";
     
    // Preparar la consulta
    $stmt = $db->prepare($query);

    // Vincular los valores a los marcadores de posición
    $stmt->bindParam(':cadena', $cadena, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);

    // Ejecutar la consulta
    $stmt->execute();

    // Devolver true si se encontraron resultados
    return $stmt->rowCount() > 0;  
}

?>