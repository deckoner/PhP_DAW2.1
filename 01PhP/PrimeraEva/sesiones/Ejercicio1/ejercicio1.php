<?php
function contieneSoloLetrasYEspacios($str) {
    // Utilizamos una expresión regular para verificar si la cadena contiene solo letras y espacios
    return preg_match('/^[a-zA-Z\s]+$/', $str) === 1;
}


session_start();
$error = "";

// Comprobamos si la cookie existe y obtenemos su valor
if (isset($_SESSION['nombresIntroducidos'])) {
    $nombresIntroducidos = $_SESSION['nombresIntroducidos'];
} else {
    $nombresIntroducidos = array();
}

// Comprobación para el nombre
if (isset($_GET['nombre'])) {
    $nombre = $_GET['nombre'];
} else {
    $nombre = "";
}

// Evento del botón borrar
if (isset($_POST['submitBorrar'])) {
    if (isset($_POST['nombre'])) {
        $nombre = "";
    }
}

// Evento del botón añadir
if (isset($_POST['submitAnadir'])) {
    if (isset($_POST['nombre'])) {
        // Comprobamos si el nombre esta en el formato correcto
        if (contieneSoloLetrasYEspacios($_POST['nombre'])) {
            $nombre = $_POST['nombre'];
            $nombresIntroducidos[] = $nombre;
            $_SESSION['nombresIntroducidos'] = $nombresIntroducidos;
        } else {
            $error = "Porfavor introduzca un nombre valido";
        }
    }
}

if (isset($_GET['aniquilacion'])) {
    if ($_GET['aniquilacion'] == "si") {
        unset($_SESSION['nombresIntroducidos']);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
    <title>Ejercicio1</title>
</head>
<body>
    <p stylesheet="color: red;"></p><?php echo $error ?></p>
    <form action="<?php echo $_SERVER['PHP_SELF'].'?nombre='.$nombre ?>" method="POST">
        <label>Escribe algún nombre:</label>
        <input type="text" name="nombre" value="<?php echo $nombre ?>">

        <input type="submit" name="submitAnadir" value="Añadir">
        <input type="submit" name="submitBorrar" value="Borrar">
    </form>
    <br>
    <?php 
    if (empty($nombresIntroducidos)) {
        echo '<p>Todavía no se han introducido nombres</p>';
    } else {
        echo "<ul>";
        foreach ($nombresIntroducidos as $nombre) {
            echo "<li>".$nombre."</li>";
        }
        echo "</ul>";
        echo '<a href="'.$_SERVER['PHP_SELF'].'?aniquilacion=si">Cerrar sesion (se perderan los datos almacenados)</a>';
    }
    ?>
</body>
</html>