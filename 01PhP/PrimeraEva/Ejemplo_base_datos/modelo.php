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

function platos($db) {
    $st = $db->query("SELECT idPlato, nombre, precio, fecha, img FROM platos");
    $st->setFetchMode(PDO::FETCH_OBJ);
    return $st->fetchAll();
}

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

function listaPlatos($db) {
    $st = $db->prepare("SELECT nombre, precio FROM platos");
}

function platoExiste($nombre, $db) {
    $st = $db->prepare("SELECT COUNT(*) FROM platos WHERE nombre = ?");
    $st->bindParam(1, $nombre);
    $st->execute();
    
    $count = $st->fetchColumn();
    
    return $count > 0;
}

function actualizarPrecioPlato($idPlato, $porcentaje, $db) {
    $st = $db->prepare("UPDATE platos SET precio = precio + precio*?/100 WHERE idPlato = ?");
    $st->bindParam(1, $porcentaje);
    $st->bindParam(2, $idPlato);
    $st->execute();
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
