<?php 
function guardarArchivoTxt($nombre, $archivo) {
    $directorioDestino = "productos_txt/"; // Directorio donde se guardarán los archivos

    // Verificar que el directorio de destino exista, o crearlo si no existe
    if (!file_exists($directorioDestino)) {
        mkdir($directorioDestino, 0777, true);
    }

    // Combinar el directorio de destino con el nombre del archivo
    $rutaArchivoDestino = $directorioDestino . $nombre . ".txt";

    // Mover el archivo al directorio de destino con el nombre deseado
    if (move_uploaded_file($archivo["tmp_name"], $rutaArchivoDestino)) {
        return "El archivo se ha guardado con éxito como '$nombre.txt'";
    } else {
        return "Error al guardar el archivo.";
    }
}

function agregarProducto($nombreProducto, $precio) {
    // Leemos el contenido actual del archivo productos.txt
    $contenidoActual = file_get_contents("productos.txt");

    // Construimos la nueva línea con el nombre del producto y el precio
    $nuevaLinea = "$nombreProducto;$precio";

    // Agregamos la nueva línea al contenido existente, separada por un salto de línea
    $contenidoActual .= "\n" . $nuevaLinea;

    // Escribimos el contenido actualizado de vuelta al archivo
    file_put_contents("productos.txt", $contenidoActual);
}

if (isset($_GET['totalPedido'])) {
    $totalPedido = $_GET['totalPedido'];
} else {
    $totalPedido = 0;
}

if (isset($_POST['submitAnadir'])) {
    agregarProducto($_POST['nombre'], $_POST['precio']);

    if (isset($_FILES['archivo']) && is_uploaded_file($_FILES['archivo']['tmp_name'])) {
        guardarArchivoTxt($_POST['nombre'], $_FILES['archivo']);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
    <title>Pedido</title>
</head>
<body>
    <h1>Tu Pedido</h1>
    <table>
        <tr>
            <th colspan="4">ELIGE TU PEDIDO</th>
        </tr>
        
        <?php
        // Leer el contenido del archivo de texto
        $contenido = file("productos.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        $productos_txt = scandir("productos_txt");
        $productos_txt = array_diff($productos_txt, array('.', '..'));
        
        foreach ($contenido as $linea) {
            list($nombre, $precio) = explode(";", $linea);
            
            if (isset($_GET[$nombre])) {
                // Un producto ha sido agregado al pedido a través de un enlace
                $totalPedido += floatval(str_replace(',', '.', $precio));
            }
            
            echo "<tr>";
            echo "<td>$nombre</td>";
            echo "<td>$precio €</td>";
            echo '<td><a href="?'."totalPedido=".($totalPedido + (float)str_replace(',', '.', $precio)).'">Agregar al Pedido</a></td>';
            
            if (in_array($nombre.".txt", $productos_txt)) {
                $link = 'productos_txt/'.$nombre.'.txt';
                echo '<td><a href="'.$link.'">Mas informacion del articulo</a></td>';
            }
            
            echo "</tr>";
        }
        ?>
        <tr>
            <td colspan="4">TOTAL: <?php echo $totalPedido ?> €</td>
        </tr>
    </table>
    
    <form action="<?php echo $_SERVER['PHP_SELF'] . "?totalPedido=" . $totalPedido ?>" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td colspan="3">AÑADE ARTICULO</td>
            </tr>
            <tr>
                <td>Nombre:</td>
                <td colspan="2">Precio(€):</td>
            </tr>
            <tr>
                <td><input type="text" name="nombre"></td>
                <td><input type="text" name="precio"></td>
                <td><input type="submit" name="submitAnadir" value="AÑADIR"></td>
            </tr>
            <tr>
                <td colspan="3"><input type="file" name="archivo" accept=".txt"></td>
            </tr>
        </table>
    </form>
</body>
</html>