<?php
    require_once "modelo.php";
    session_start();

    if (isset($_POST['logear'])) {
        $db = conexion("restaurante", "root", "");

        $user = logear($db, $_POST['login'], $_POST['pass']);

        if (!$user) {
            echo "<p>Error al logearse: usuario o contraseña incorrecta</p>";
        } else {
            $_SESSION['user'] = (object)$user;

            header('location:eligePlato.php');
            exit;

            // TODO Anotacion de recuperar imagen
            // $img = stripslashes($user['img']);
            // echo '<img src="data:image/png;base64,' . base64_encode($img).'"/>';
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
    <title>Login</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <p>Usuario</p>
        <input type="text" name="login">

        <p>Password</p>
        <input type="password" name="pass">

        <input type="submit" name="logear" value="ENTRAR">
    </form>
    <p>No tienes una cuenta aún papanatas? <a href="registro.php">Regístrate aquí</a></p>
</body>
</html>