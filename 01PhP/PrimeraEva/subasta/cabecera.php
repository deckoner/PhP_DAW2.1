<?php
    require_once "config.php";
    require_once "modelo.php";
    require_once "utilidades.php";

    session_start();
    $db = conexion($nombreBD, $usuario, $contrasena, $host);

?>

<html>

<head>
    <title><?php echo $config_forumsname; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="stylesheet.css" type="text/css" />
</head>

<body>
    <div id="header">
        <h1>SUBASTAS CIUDAD JARDIN</h1>
    </div>
    <div id="menu">
        <a href="index.php">Home</a>
        <?php
        if (isset($_SESSION['USERNAME'])) {
            echo "<a href='logout.php'>Logout</a>";
            if ($_SESSION['USERNAME'] == "admin" and $_SESSION['USERID'] == $adminID) {
                echo "\n<a href='vencidas.php'>Subastas vencidas</a>\n";
                echo "<a href='publi.php'>Publicitar subastas</a>";
            }
        } else {
            echo "<a href='login.php'>Login</a>";
        }
        ?>
        <a href="nuevoitem.php">Nuevo item</a>
    </div>
    <div id="container">
        <div id="bar">
            <?php require("bar.php"); ?>
        </div>
        <div id="main">