<?php 
    include("cabecera.php");

    if (isset($_POST['borrar'])) {
        // Verifica si se ha marcado al menos un elemento para borrar
        if (isset($_POST['items']) && is_array($_POST['items'])) {
            foreach ($_POST['items'] as $selectedItemId) {
                eliminarImagenesPorItem($db, $selectedItemId);
                eliminarPujasPorItem($db, $selectedItemId);
                eliminarItem($db, $selectedItemId);
            }
        } else {
            echo "No se ha seleccionado ningún elemento para borrar.";
        }
    }

    $listaItems = obtenerItemsVencidos($db);
    $idItemDescripcion = 0;

    // Comprobamos si hay id para la descripcion del item
    if (isset($_GET['idDescripcion'])) {
        $idItemDescripcion = $_GET['idDescripcion'];
    }
    
?>

<h1>Subastas vencidas</h1>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <table>
        <tr>
            <th colspan="2">ITEM</th>
            <th>PRECIO FINAL</th>
            <th>GANADOR</th>
        </tr>
        <?php 
        
            foreach ($listaItems as $item) {
                echo "<tr>
                    <td><input type=checkbox name=items[] value=$item->item_id /></td>
                    <td><a href=vencidas.php?idDescripcion=$item->item_id>$item->item_nombre</a>";

                    if ($idItemDescripcion == $item->item_id) {
                        echo "<p>Descripcion: $item->item_descripcion</p>";
                    }

                    echo "</td>
                    <td>PRECIO FINAL: $item->precio_final $monedaLocalSimbolo</td>
                    <td>Ganador: $item->ganador</td>
                </tr>";
            }
        
        ?>
        <tr>
            <td colspan=4>
                <input type="submit" name="borrar" value="BORRAR" style="width: 100%;">
            </td>
        </tr>
    </table>
</form>

<?php 
    include("pie.php");
?>