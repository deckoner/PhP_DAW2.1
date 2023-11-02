<?php 
    require_once "modelo.php";

    if (isset($_POST['registrar'])) {
        $db = conexion("restaurante", "root", "");
        $registro = registrar($db, $_POST['dni'], $_POST['nombre'], $_POST['login'], $_POST['pass']);

        if ($registro) {
            if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
                $ok = guardarImagenCliente($db, $_FILES['imagen']['tmp_name'], $_POST['dni']);

                if ($ok) {
                    echo "<p>Se ha registrado con imagen</p>";
                } else {
                    echo "<p>No se ha registrado</p>";
                }
            } else {
                echo "<p>Se ha registrado sin imagen</p>";
            }
        } else {
            echo "<p>No se ha registrado</p>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
    <title>Registro</title>
</head>
<body>
    <form enctype="multipart/form-data" method="POST" action="<?php echo self() ?>">
        DNI <input type="text" name="dni">
        Nombre <input type="text" name="nombre">
        Login <input type="text" name="login">
        Contraseña <input type="password" name="pass">
        imagen <input type="file" name="imagen">
        <input type="submit" name="registrar" value="Registrar">
    </form>
</body>
</html>