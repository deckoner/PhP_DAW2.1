<?php 
function agregarMeGusta($nombreUsuario, $imagenesGustadas) {
    // Utiliza basename para obtener solo el nombre del archivo
    $imagenesGustadas = array_map('basename', $imagenesGustadas);
    
    // Componer la línea de texto a agregar
    $linea = "A $nombreUsuario le gusto: " . implode(', ', $imagenesGustadas);

    // Abre el archivo en modo de escritura, agregando contenido al final
    $archivo = fopen('me_gusta.txt', 'a');

    if ($archivo) {
        // Escribe la línea en el archivo y agrega un salto de línea
        fwrite($archivo, $linea . PHP_EOL);

        // Cierra el archivo
        fclose($archivo);

        return true; // Éxito al escribir la línea
    } else {
        return false; // Fallo al abrir el archivo
    }
}

$user = $_GET['user'];
$userValorar = $_GET['userValorar'];

if (isset($_POST['submit'])) {
    if (isset($_POST["me_gusta"])) {
        // Obtener los valores seleccionados en los checkboxes
        $meGustaValores = $_POST["me_gusta"];

        agregarMeGusta($user, $meGustaValores);
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
    <form action="<?php echo $_SERVER['PHP_SELF']."?user=".$user."&userValorar=".$userValorar ?>" method="POST">
        <?php 
            // Directorio donde se encuentran las imágenes (reemplaza VARIABLE por la variable real)
            $directorio = 'users/'.$_GET['userValorar'];
            // Obtener la lista de archivos en el directorio
            $archivos = glob("$directorio/*");

            if (count($archivos) === 0) {
                echo "<h2>No hay imágenes para valorar</h2>";
            } else {
                // Crear la tabla HTML
                echo '<table>';
                echo '<tr><th>Imagen</th><th>Me gusta</th></tr>';

                foreach ($archivos as $archivo) {
                    // Verificar si el archivo es una imagen (puedes agregar más extensiones si es necesario)
                    if (in_array(pathinfo($archivo, PATHINFO_EXTENSION), array('jpg', 'jpeg', 'png', 'gif'))) {
                        echo '<tr>';
                        echo '<td><img src="' . $archivo . '" width="200"></td>';
                        echo '<td><input type="checkbox" name="me_gusta[]" value="' . $archivo . '"> Me gusta</td>';
                        echo '</tr>';
                    }
                }

                echo '</table>';
                echo '<input type="submit" name="submit" value="GUARDAR">';
            }
        ?>
    </form>
</body>
</html>