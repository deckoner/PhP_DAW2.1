<?php 
    include("cabecera.php");
    $tipos_validos = ["image/jpeg","image/jpg", "image/png"];

    // Si no esta logueado lo mandamos a que se logue
    if (!isset($_SESSION['USERNAME']) and !isset($_GET['idItem'])) {
        header("Location: Index.php");
        exit;
    }

    // Inicializamos los avisos de error
    $errorSTR = "";
    $errorImagen = "";

    // Comprobamos si se va a subir una imagen
    if (!isset($_POST['subirImagen'])) {
    } elseif (!is_uploaded_file($_FILES['fich']['tmp_name'])) {
        $errorImagen = 'No se ha podido subir el archivo';
    } elseif (!in_array($_FILES['fich']['type'], $tipos_validos)) {
        $errorImagen = 'La imagen debe ser jpeg, jpg o png';
    } else {
        $nombreArchivo = $_FILES['fich']['name'];

        // Verificar si el archivo ya existe en la carpeta de imágenes
        if (file_exists($rutaImagen . $nombreArchivo)) {
            $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
            $baseName = pathinfo($nombreArchivo, PATHINFO_FILENAME);
            $contador = 1;

            // Generar un nuevo nombre único
            while (file_exists($rutaImagen . $nombreArchivo)) {
                $nombreArchivo = $baseName . '_' . $contador . '.' . $extension;
                $contador++;
            }
        }

        // Mover el archivo a la carpeta de imágenes con el nuevo nombre
        if (move_uploaded_file($_FILES['fich']['tmp_name'], $rutaImagen . $nombreArchivo)) {
            if (!insertarImagen($db, urldecode($_GET['idItem']), $nombreArchivo)) {
                $errorImagen = 'No se ha podido subir el archivo';
            }
        } else {
            $errorImagen = 'No se ha podido subir el archivo';
        }
    }

    // Comprobamos si se tiene que borrar la imagen
    if (isset($_GET['borrar'])) {
        $imagenBorrar = optenerImageneItem($db, urldecode($_GET['borrar']));

        if ($imagenBorrar and file_exists($rutaImagen.$imagenBorrar->imagen)) {
            if (!unlink($rutaImagen.$imagenBorrar->imagen) & !eliminarImagen($db, urldecode($_GET['borrar']))) {
                $errorSTR = "Hubo un problema al intentar eliminar la imagen";
            }
        }
    }

    // Recuperamso el item de la base de datos
    $item = obtenerDatosItem($db, urldecode($_GET['idItem']));

    if(isset($_POST["bajarPrecio"])) {
        $precioNuevo = $item->precioPartida - $_POST['precio'];

        if ($precioNuevo < 1) {
            $errorSTR = 'No puedes bajar el precio base a menos de 1€';
        } else {
            if (!modificarPrecio($db, $precioNuevo, urldecode($_GET['idItem']))) {
                $errorSTR = "Ha ocurrido un error y no se ha podido actualizar el precio";
            } else {
                // volvemos a optener el objeto
                $item = obtenerDatosItem($db, urldecode($_GET['idItem']));
            }
        }
    }

    if (isset($_POST['subirPrecio'])) {
        $precioNuevo = $item->precioPartida + $_POST['precio'];

        if (!modificarPrecio($db, $precioNuevo, urldecode($_GET['idItem']))) {
            $errorSTR = "Ha ocurrido un error y no se ha podido actualizar el precio";
        } else {
            // volvemos a optener el objeto
            $item = obtenerDatosItem($db, urldecode($_GET['idItem']));
        }
    }

    if (isset($_POST['posponerUnaH'])) {
        $fechaOriginal = $item->fechafin;
        $formato = "Y-m-d H:i:s";

        // Crea un objeto DateTime a partir de la fecha original
        $dateTime = DateTime::createFromFormat($formato, $fechaOriginal);

        // Suma una hora
        $dateTime->add(new DateInterval('PT1H'));

        // Formatea la nueva fecha y hora
        $nuevaFecha = $dateTime->format($formato);

        if (!modificarFecha($db, $nuevaFecha, urldecode($_GET['idItem']))) {
            $errorSTR = "Ha ocurrido un error al actualizar la fecha";
        } else {
            // volvemos a optener el objeto
            $item = obtenerDatosItem($db, urldecode($_GET['idItem']));
        }
    }

    if (isset($_POST['posponerUnD'])) {
        $fechaOriginal = $item->fechafin;
        $formato = "Y-m-d H:i:s";

        // Crea un objeto DateTime a partir de la fecha original
        $dateTime = DateTime::createFromFormat($formato, $fechaOriginal);

        // Suma un día
        $dateTime->add(new DateInterval('P1D'));

        // Formatea la nueva fecha y hora
        $nuevaFecha = $dateTime->format($formato);

        if (!modificarFecha($db, $nuevaFecha, urldecode($_GET['idItem']))) {
            $errorSTR = "Ha ocurrido un error al actualizar la fecha";
        } else {
            // volvemos a optener el objeto
            $item = obtenerDatosItem($db, urldecode($_GET['idItem']));
        }
    }

    // Fecha fin de puja
    $timestamp = strtotime($item->fechafin);
    $fechaFinPuja = date("j/M/Y g.iA", $timestamp);
?>

<h1><?php echo $item->nombre ?></h1>
<p style="color: red;"><?php echo $errorSTR ?></p>
<table>
    <tr>
        <td>Precio de salida: <?php echo number_format($item->precioPartida, 0, ',', '.').$monedaLocalSimbolo; ?></td>
        <td>
            <?php 
                if (!existePuja($db, urldecode($_GET['idItem']))) {
                    echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'?idItem='.urldecode($_GET['idItem']).'">';
                        echo '<input type="text" name="precio">';
                        echo '<input type="submit" name="bajarPrecio" value="BAJAR" style:"margin-left: 1em; margin-right: 1em;">';
                        echo '<input type="submit" name="subirPrecio" value="SUBIR" style:"margin-left: 1em; margin-right: 1em;">';
                    echo '</form>';
                }
            ?>
        </td>
    </tr>
    <tr>
        <td>Fecha fin para pujar: <?php echo $fechaFinPuja ?></td>
        <td>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'].'?idItem='.urldecode($_GET['idItem']) ?>">
                <?php 
                    echo '<input type="submit" name="posponerUnaH" value="POSPONER 1 HORA">';
                    echo '<input type="submit" name="posponerUnD" value="POSPONER 1 DIA">';
                ?>
            </form>
        </td>
    </tr>
</table>
<h1>Imagenes Actuales</h1>
<?php 
    if (!is_null($item->imagen)) {
        $listaImagenes = optenerImagenesItem($db, urldecode($_GET['idItem']));

        echo "<table>";
        foreach ($listaImagenes as $imagenMostrar) {
            echo '<tr>
                    <td><img src="'.$rutaImagen.$imagenMostrar->imagen.'" style="width: 10em;"></td>
                    <td><a href="editaritem.php?idItem='.urldecode($_GET['idItem']).'&borrar='.urldecode($imagenMostrar->id).'">[BORRAR]</a></td>
                </tr>';
        }
        echo "</table>";
    } else {
        echo "<p>No hay imagenes</p>";
    }
?>

<form action="<?php echo $_SERVER['PHP_SELF']."?idItem=".urldecode($_GET['idItem']) ?>" enctype="multipart/form-data" method="POST">
    <table>
        <tr>
            <td>Imagen a subir</td>
            <td><input type="file" name="fich"></td>
        </tr>
        <tr>
            <td><input type="submit" value="Subir" name="subirImagen"></td>
            <td><?php echo $errorImagen; ?></td>
        </tr>
    </table>
</form>

<?php 
    include("pie.php");
?>