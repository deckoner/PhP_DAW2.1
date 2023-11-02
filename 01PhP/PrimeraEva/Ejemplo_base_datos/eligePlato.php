<?php 
session_start();

$user = $_SESSION['user'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
    <title>Elegir platos</title>
</head>
<body>
    <h1>Bienvenido/a <?php echo $user->nombre?></h1>
    <h3>Elije tus platos</h3>

    <tabla>
        <tr>
            <th>Plato</th>
            <th>nombre</th>
            <th>precio</th>
            <th></th>
        </tr>
        <?php 
            
        ?>
    </tabla>
</body>
</html>