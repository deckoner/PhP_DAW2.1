<?php
$tipos_validos = ["image/gif", "image/jpeg", "image/jpg", "image/png"];

if (isset($_GET['img']) && (!isset($_GET['ver']))) {
    unlink("img/" . $_GET['img']);
}


if (isset($_POST['submit'])) {

    // $_FILES['fich']['tmp_name']  ->archivo temporal subido al servidor
    //$_FILES['fich']['name'] --> nombre del archivo en el cliente
    // $_FILES['fich']['type']-->Tipo de archivo: "image/gif"
    //$_FILES['fich']['size']  -->Tamaño del archivo en bytes


    if (is_uploaded_file($_FILES['fich']['tmp_name'])) {

        //echo "<p>Archivo en dir.temporal</p>".$_FILES['fich']['tmp_name']);

        if (in_array($_FILES['fich']['type'], $tipos_validos)) {
            $destino = "img/" . basename($_FILES['fich']['name']);
            move_uploaded_file($_FILES['fich']['tmp_name'], $destino);
        } else
            echo "<p>No es una imagen permitida</p>";
    }
}




?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">

        <label>Elige imagen</label>
        <input type="file" name="fich">
        <input type="submit" name="submit" value="SUBIR IMAGEN">

    </form>

    <hr />
    <table>
        <?php
        $arr = scandir("img");
        foreach ($arr as $imagen) {
            $ruta = "img/" . $imagen;
            $tipo = mime_content_type($ruta);
            if (in_array($tipo, $tipos_validos)) {
                echo "<tr>";
                echo "<td>$imagen</td>";

                $enlaceB = $_SERVER['PHP_SELF'] . "?img=$imagen";
                $enlaceV = $_SERVER['PHP_SELF'] . "?img=$imagen&ver";
                echo "<td><a href='$enlaceB'>BORRAR</a></td>";
                echo "<td><a href='$enlaceV' >VER</a></td>";
                if (isset($_GET['ver']) && $_GET['img'] == $imagen) {
                    echo "<td><img src='$ruta' width='40'></td>";
                } else {
                    echo "<td></td>";
                }

                echo "</tr>";
            }
        }


        ?>
    </table>

</body>

</html>