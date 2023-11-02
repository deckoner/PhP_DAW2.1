<?php 
include "libmenu.php";
$tipoPlato = $_GET['tipo'];
$platos = damePlatos($tipoPlato);

if (isset($_POST['tipoPlato'])) {
    // Iniciamos sesion para agregar platos
    session_start();

    // Comprobamos si ya ahi datos
    if (isset($_SESSION['platos'])) {

    } else {
        $platosDefenitivos = array($tipoPlato => $_POST['nombrePlato']);
        $_SESSION['platos'] = $platosDefenitivos;

        header('location:pedido.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
    <title>Pedido plato</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <h2><?php echo strtoupper($tipoPlato) ?></h2>
        <select name="nombrePlato">
            <?php 
                foreach ($platos as $nombre => $precio) {
                    echo '<option value="'.$nombre.'">'.ucfirst($nombre).': '.$precio.'€</option>';
                }
            ?>
        </select>
        <input type="submit" value="ELEGIR <?php echo strtoupper($tipoPlato) ?>" name="tipoPlato">
    </form>
</body>
</html>