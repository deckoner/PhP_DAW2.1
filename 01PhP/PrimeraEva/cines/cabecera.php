<?php
    require_once "config.php";
    require_once "modelo.php";

    session_start();
    $db = conexion($nombreBD, $usuario, $contrasena, $host);

?>