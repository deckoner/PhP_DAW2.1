<?php 
session_start();

if (isset($_SESSION['sesionUser'])) {
    $nombre = $_SESSION['sesionUser'][0];
} else {
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
    <title>Pedido</title>
</head>
<body>
    <h1>Bienvenido <?php echo $nombre?></h1>
    <?php 
        $platos = $_SESSION['platos'];

        echo $platos;
        foreach($platos as $p) {
            echo $p;
        }
    ?>
    <a href="pedidoplato.php?tipo=primero">Primero</a><br>
    <a href="pedidoplato.php?tipo=segundo">Segundo</a><br>
    <a href="pedidoplato.php?tipo=postre">Postre</a><br>
    <a href="pedidoplato.php?tipo=bebida">Bebida</a>
</body>
</html>