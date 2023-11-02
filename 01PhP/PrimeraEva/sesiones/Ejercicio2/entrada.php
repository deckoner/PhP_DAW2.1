<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
    <title>Entrada</title>
</head>
<body>
    <p style="color: red;"><?php 
        if (isset($_GET['mensaje'])) {
            echo $_GET['mensaje'];
        }
    ?></p>
    <form action="<?php echo 'autenticacion.php' ?>" method="POST">
        <label>Usuario</label>
        <input type="text" name="user">

        <label>Contraseña</label>
        <input type="password" name="contra">

        <input type="submit" value="login" name="login">
    </form>

    <form action="<?php echo 'autenticacion.php' ?>" method="POST">
        <input type="submit" value="invitado" name="invitado">
    </form>
</body>
</html>