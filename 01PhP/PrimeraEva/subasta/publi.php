<?php
    include("utilidades.php");
    include("cabecera.php");
    $listaItems = obtenerItemsPublicar($db);

    // Verificar si se enviaron nuevos anunciantes
    if (isset($_POST['anunciante'])) {
        // * Comprobamos si existe la cookie
        if (isset($_COOKIE['anunciantes'])) {
            // Si existe recuperamos el JSON 
            $anunciantesJSON = $_COOKIE['anunciantes'];
            $anunciantes = json_decode($anunciantesJSON, true);
        } else {
            // Inicializar el array de anunciantes si no ahi cookies
            $anunciantes = array();
        }
        $nombre = $_POST['anuncio'];
        $tipo = $_POST['tipoAnunciante'];
        $itemID = $_POST['itemID'];
        $itemDescripcion = $_POST['itemDescripcion'];
        
        // Agregar el nuevo anunciante al array
        $anunciantes[] = array('nombre' => $nombre, 'tipo' => $tipo, 'id' => 
                                $itemID, 'descripcion' => $itemDescripcion);
        
        // Codificar el array de anunciantes como JSON y guardar en una cookie
        $anunciantesJSON = json_encode($anunciantes);
        setcookie('anunciantes', $anunciantesJSON, time() + 3600); // La cookie expira en una hora
    }

    // Verificar si hay anunciantes almacenados en la cookie 'anunciantes'
    if (isset($_COOKIE['anunciantes']) and isset($_GET['enviar'])) {
        // Recuperamos el array con los objetos
        $anunciantesJSON = $_COOKIE['anunciantes'];
        $anunciantes = json_decode($anunciantesJSON, true);

        foreach ($anunciantes as $anunciante) {
            if ($anunciante['tipo'] == "web") {
                escribirEnArchivoPublicidad($anunciante['descripcion'], $anunciante['nombre']);
            } else {
                enviarEmailPubli($anunciante['nombre'], $emailFrom, $anunciante['id']);
            }
        }

        // Destruir la cookie
        unset($_COOKIE['anunciantes']);
        setcookie('anunciantes', '', time() - 3600, '/');
    }
?>

<h1>Subastas a punto de vencer</h1>
<table>
    <tr>
        <th>ITEM</th>
        <th>VENCE EN</th>
        <th>ANUNCIANTE</th>
        <th colspan="2">TIPO</th>
    </tr>
    <?php 
    
        foreach ($listaItems as $item) {
            echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'"><tr>
                <td>'.$item->nombre.'</td>';
            echo '<td>'.convertirFecha($item->fechafin).'</td>';
            echo "<td><input type=texto name=anuncio></td>
                <td>
                    <input type=hidden id=itemID name=itemID value=$item->id hidden>";
            echo    '<input type=hidden id=itemDescripcion name=itemDescripcion value="'.$item->descripcion.'" hidden>';
            echo    "<input type=radio id=email name=tipoAnunciante value=email>
                    <label for=email>Email</label>
                    <input type=radio id=web name=tipoAnunciante value=web>
                    <label for=web>Web</label>
                </td>";
            echo '<td><input type=submit name=anunciante value=Añadir style="padding: 0.4em;"></td>
            </tr></form>';
        }
    ?>
</table>

<?php 
    if (isset($_POST['anunciante'])) {
        echo '<a href="publi.php?enviar">ENVIAR ANUNCIOS</a>';
    }
?>

<?php 
    include("pie.php");
?>