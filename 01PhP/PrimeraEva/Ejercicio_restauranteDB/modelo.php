<?php

function conexion($nombreDB, $user, $contra) {
    try {
        $db = new PDO("mysql:host=localhost;dbname=$nombreDB", $user, $contra);
        return $db;
    } catch (PDOException $e) {
        echo $e;
        return false;
    }
}

// !Funciones de listar u optener valor
function platos($db) {
    $st = $db->query("SELECT idPlato, nombre, precio, fecha, img FROM platos");
    $st->setFetchMode(PDO::FETCH_OBJ);
    return $st->fetchAll();
}

function obtenerPlato($db, $idPlato) {
    $consulta = $db->prepare("SELECT idPlato, nombre, precio, fecha, img FROM platos WHERE idPlato = ?");
    $consulta->bindParam(1, $idPlato, PDO::PARAM_INT);
    $consulta->setFetchMode(PDO::FETCH_OBJ);
    $consulta->execute();
    return $consulta->fetch();
}

function obtenerNombrePlato($db, $idPlato) {
    $st = $db->prepare("SELECT nombre FROM platos WHERE idPlato = ?");
    $st->execute([$idPlato]);

    // Obtiene directamente el valor de la columna "nombre"
    $nombrePlato = $st->fetchColumn();

    return $nombrePlato;
}

function logear($db, $user, $pass) {
    try {
        $st = $db->prepare("SELECT * FROM clientes WHERE login = ?");
        $st->execute([$user]);
    
        $cliente = $st->fetch();
    
        if (!$cliente ) {
            return false;
        }
    
        $has = $cliente['pass'];
        if (password_verify($pass, $has)) {
            return $cliente;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo $e;
    }
}

function composicion($db, $idPlato) {
    $st = $db->prepare("SELECT ingredientes.nombre AS nombre_ingrediente, composicion.cantidad, ingredientes.idIngrediente
                       FROM composicion
                       INNER JOIN ingredientes ON composicion.idIngrediente = ingredientes.idIngrediente
                       WHERE composicion.idPlato = ?");
    $st->execute([$idPlato]);

    // Obtener todos los resultados como un array de objetos stdClass
    $resultados = $st->fetchAll(PDO::FETCH_OBJ);

    return $resultados;
}

// !Funciones de comprobaciones
function platoExiste($nombre, $db) {
    $st = $db->prepare("SELECT COUNT(*) FROM platos WHERE nombre = ?");
    $st->bindParam(1, $nombre);
    $st->execute();
    
    $count = $st->fetchColumn();
    
    return $count > 0;
}

// !Funciones de agregar
function insertarPlato($nombre, $precio, $fecha, $img, $db) {
    if (!platoExiste($nombre, $db)) {
        $st = $db->prepare("INSERT INTO platos (nombre, precio, fecha, img) VALUES (?, ?, ?, ?)");
        $st->bindParam(1, $nombre);
        $st->bindParam(2, $precio);
        $st->bindParam(3, $fecha);
        $st->bindParam(4, $img);
        $st->execute();
    }
}

function registrar($db, $dni, $nombre, $login, $pass) {
    // Verificar si ya existe un registro con el mismo DNI y login
    $sqlTest = $db->prepare("SELECT COUNT(*) FROM clientes WHERE dni=? OR login=?");
    $sqlTest->execute([$dni, $login]);

    $cuantos = $sqlTest->fetchColumn();

    if ($cuantos > 0) {
        return false;
    }

    // Insertar el nuevo registro
    $sqlInsert = $db->prepare("INSERT INTO clientes (dni, login, nombre, pass) VALUES (?, ?, ?, ?)");
    $sqlInsert->execute([$dni, $login, $nombre, password_hash($pass, PASSWORD_DEFAULT, [15])]);

    return true;
}

function realizarPedido($db, $dni, $idPlatos) {
    try {
        // Iniciar una transacción
        $db->beginTransaction();

        // Insertar el pedido con el número de DNI y la fecha actual
        $insertarPedido = $db->prepare("INSERT INTO pedidos (dni, idPlato, fecha) VALUES (?, ?, CURDATE())");
        
        foreach ($idPlatos as $idPlato) {
            // Insertar un registro para cada plato en el pedido
            $insertarPedido->execute([$dni, $idPlato]);
        }

        // Confirmar la transacción
        $db->commit();

        return true; // Éxito
    } catch (PDOException $e) {
        // Si ocurre un error, deshacer la transacción
        $db->rollback();
        return false; // Error
    }
}

// !Funciones de actualizar
function actualizarPrecioPlato($idPlato, $porcentaje, $db) {
    $st = $db->prepare("UPDATE platos SET precio = precio + precio*?/100 WHERE idPlato = ?");
    $st->bindParam(1, $porcentaje);
    $st->bindParam(2, $idPlato);
    $st->execute();
}

function guardarImagenCliente($db, $imagen, $dni) {
    $img = addslashes(file_get_contents($imagen));

    $sqlActualizar = $db->prepare("UPDATE clientes SET img=? WHERE dni=?");
    $sqlActualizar->execute([$img, $dni]);

    return true;
}

function self() {
    return htmlentities($_SERVER['PHP_SELF']);
}
?>
