<?php 
require_once "modelo.php";

$db = conexion("restaurante", "root", "");

if (!$db) {
    echo "ERROR";
}

if (isset($_POST['insertar'])) {
    if (is_uploaded_file($_FILES['img']['tmp_name'])) {
        move_uploaded_file($_FILES['img']['tmp_name'], "img/".$_FILES['img']['name']);

        insertarPlato($_POST['nombre'], $_POST['precio'],
        $_POST['fecha'], $_FILES['img']['name'], $db);
    } else {
        insertarPlato($_POST['nombre'], $_POST['precio'],
        $_POST['fecha'], null, $db);
    }
}

if (isset($_GET['subir'])) {
    actualizarPrecioPlato($_GET['idplato'], 5, $db);
}

$arrPlatos = platos($db);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Fecha</th>
        </tr>
        <tr>
    <?php 
        foreach ($arrPlatos as $plato) {
            $enlace = self() . "?idplato=$plato->idPlato&subir";
            echo "<tr>
                <td>$plato->nombre</td>
                <td>$plato->precio</td>
                <td>$plato->fecha</td>";
                if ($plato->img == null) {
                    echo "<td>Sin imagen</td>";
                } else {
                    echo "<td><img src = 'img/$plato->img'></td>";
                }
                echo "<td><a href='$enlace'>Subir precio un 5%</a></td>
            </tr>";
        }
    ?>
        </tr>
    </table>
    
    <form action="<?php echo self() ?>" method="POST" enctype="multipart/form-data">
    <table>
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Fecha</th>
        </tr>
        <tr>
            <td><input type="text" name="nombre"></td>
            <td><input type="number" name="precio" step="-1"></td>
            <td><input type="date" name="fecha"></td>
            <td><input type="file" name="img"></td>
            <td><input type="submit" name="insertar" value="INSERTAR"></td>
        </tr>
    </form>
</body>
</html>