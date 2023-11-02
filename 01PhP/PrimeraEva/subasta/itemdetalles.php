<?php 
    include("cabecera.php");
    $errorPuja = "";

    // * Guardamos la pagina actual
    $_SESSION['ACTUALPAGE'] = "itemdetalles.php";

    // comprovamos si existe para conseguir el item
    if (isset($_GET['idItem'])) {
        $item = obtenerDatosItem($db, urldecode($_GET['idItem']));
    }

    // * Comprobamos si se ha echo una puja
    if (isset($_POST["pujaActiva"])) {

        // Comprobamos si la cantidad no esta vacia
        if (!is_null($_POST["pujaPropuesta"])) {

            // Comprobamos que la cantidad no sea menor al precio inicial
            if ($_POST["pujaPropuesta"] <= $item->precio) {
                $errorPuja = "No puedes pujar por un valor inferior al actual";

            } else {

                // Comprobamos el numero de pujas de hoy hecho por el usuario a este item
                if (optenerNPujasDiarias($db, urldecode($_GET['idItem']), $_SESSION['USERID']) >= 3) {
                    $errorPuja = "Limite de tres pujas por dia";
                } else {

                    // Si en el envio de informacion al servidor ahi algun error le avisamos
                    if (!insertarPuja($db, urldecode($_GET['idItem']), $_SESSION['USERID'], $_POST['pujaPropuesta'])) {
                        $errorPuja = "Ha ocurrido un error al subir la pujas"; 
                        $item = obtenerDatosItem($db, urldecode($_GET['idItem']));
                    }
                }
            }
        }
    }

    if (isset($_GET['idItem'])) {
        // * Formateamos el precio del item
        $precioFormateado = number_format($item->precio, 0, ',', '.').$monedaLocalSimbolo;

        echo "<h1>$item->nombre</h1>";
        echo "<p>Numero de pujas: $item->pujas - 
                Precio actual: $precioFormateado - 
                Fecha fin para pujar: $item->fechafin</p>";
        
        // * Comprobamos si ahi alguna imagen
        $imagenes = optenerImagenesItem($db, urldecode($_GET['idItem']));
        if (!is_null($imagenes)) {

            foreach ($imagenes as $imagen) {
                echo '<img style="width: 10em; margin-right: 1em;" loading="lazy" 
                        src="'.$rutaImagen.$imagen->imagen.'">';
            }

        } else {
            echo "<h2>No ahi imagenes del objeto</h2>";
        }
        
        echo"<p>$item->descripcion</p>
            <h1>Puja por este item</h1>";
        
        // * Comprobamos si el usuario esta logueado
        if (isset($_SESSION['USERNAME'])) {
            echo "<p>Añade tu puja en el cuadro inferior</p>";

            echo '<form method="post" action ="'.$_SERVER['PHP_SELF'].'?idItem='.urlencode($_GET['idItem']).'">
                <table>
                    <tr>
                        <td><input type="number" name="pujaPropuesta"></td>
                        <td>
                            <input type="submit" name="pujaActiva" value="¡Puja!">
                            <p style="color: red;">'.$errorPuja.'</p>
                        </td>
                    </tr>
                </table></form>';

            echo "<h1>historial de la puja</h1>";

            // * Comprobamos que tenga pujas
            $historialP = historialPujasItem($db, urldecode($_GET['idItem']));
            if (!is_null($historialP)) {
                echo "<ul>";

                    foreach ($historialP as $user) {
                        $cantidad = number_format($user->cantidad, 0, ',', '.').$monedaLocalSimbolo;
                        echo "<li><strong>$user->nombre</strong> - $cantidad</li>";
                    }

                echo "</ul>";
            } else {
                echo "<h2>Nadie ha pujado aun por este objeto</h2>";
            }

        } else {
            // * Si no esta logueado le diremos al user que se logue junto con el link de login.php
            echo 'Para pujar, debes autentificarte. <a href="login.php">aqui</a>';
        }
    } else {
        // Si no ahi idItem lo enviamos al index
        header("Location: index.php");
        exit;
    }

    include("pie.php");
?>