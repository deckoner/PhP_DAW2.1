<?php 
function listarUsersCB() {
    $arr = scandir("users");

    // Elimina las entradas "." y ".." de la lista y lo recorremos
    $arr = array_diff($arr, array('.', '..'));
    foreach ($arr as $nombre) {
        if ($nombre != $_GET['user']) {
            if (is_dir("users/" . $nombre)) {
                echo "<option value='$nombre'>$nombre</option>";
            }
        }
    }
}
?>

<?php
$tipos_validos = ["image/gif", "image/jpeg", "image/jpg", "image/png"];
$user = $_GET['user'];

if (isset($_POST['submitIMG'])) {
    if (is_uploaded_file($_FILES['fich']['tmp_name'])) {
        if (in_array($_FILES['fich']['type'], $tipos_validos)) {
            $destino = "users/" . $user . "/" . basename($_FILES['fich']['name']);
            move_uploaded_file($_FILES['fich']['tmp_name'], $destino);
        } else
            echo "<p>No es una imagen permitida</p>";
    }
}

if (isset($_POST['submitValorar'])) {
    
    header("Location: eval_imag.php?user=".$user."&userValorar=".$_POST['userValorar']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio2: pag1</title>
</head>
<body>
    <h1>SUBIR IMAGENES</h1>
    <section>
        <form action="<?php echo $_SERVER['PHP_SELF'] . "?user=" . $user ?>" method="POST" enctype="multipart/form-data">
            <label>Elige imagen</label>
            <input type="file" name="fich">
            <input type="submit" name="submitIMG" value="SUBIR IMAGEN">
        </form>
    </section>

    <section>
        <form action="<?php echo $_SERVER['PHP_SELF'] . "?user=" . $user ?>" method="POST">
            <?php 
                // Comprobamos si ahi carpetas en el directorio
                $directorio = scandir("users");
                $directorio = array_diff($directorio, array('.', '..', $user));

                if (empty($directorio)) {
                    echo "<h3>No ahi usuarios para valorar sus imagenes</h3>";
                } else {
            ?>
                <label>Imagenes de <select name="userValorar"><?php listarUsersCB() ?></select></label>
                <input type="submit" name="submitValorar" value="LISTAR">
            <?php
                }
            ?>
        </form>
    </section>
</body>
</html>