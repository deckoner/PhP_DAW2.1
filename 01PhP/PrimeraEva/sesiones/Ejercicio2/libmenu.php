<?php
// Función para autenticar al usuario
function autentica($usuario, $password) {
    $usuarios = file("src/socio.txt", FILE_IGNORE_NEW_LINES);
    foreach ($usuarios as $linea) {
        list($nombre, $contrasena, $descuento) = explode(" ", $linea);
        if ($nombre === $usuario && $contrasena === $password) {
            return 1; // Usuario autenticado
        }
    }
    return 0; // Usuario no encontrado o contraseña incorrecta
}

// Función para obtener el descuento de un usuario
function dameDcto($usuario) {
    $usuarios = file("src/socio.txt", FILE_IGNORE_NEW_LINES);
    foreach ($usuarios as $linea) {
        list($nombre, $contrasena, $descuento) = explode(" ", $linea);
        if ($nombre === $usuario) {
            return floatval($descuento);
        }
    }
    return 0; // Usuario no encontrado
}

// Función para obtener platos por tipo
function damePlatos($tipo) {
    $platos = file("src/platos.txt", FILE_IGNORE_NEW_LINES);
    $platosPorTipo = array();

    foreach ($platos as $linea) {
        list($nombre, $platoTipo, $precio) = explode(" ", $linea);
        if ($platoTipo === $tipo) {
            $platosPorTipo[$nombre] = floatval($precio);
        }
    }

    return $platosPorTipo;
}

// Función para obtener el precio de un plato
function damePrecio($nombrePlato) {
    $platos = file("src/platos.txt", FILE_IGNORE_NEW_LINES);
    foreach ($platos as $linea) {
        list($nombre, $platoTipo, $precio) = explode(" ", $linea);
        if ($nombre === $nombrePlato) {
            return floatval($precio);
        }
    }
    return 0; // Plato no encontrado
}
?>
