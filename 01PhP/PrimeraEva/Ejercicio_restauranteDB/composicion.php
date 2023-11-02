<?php 
    require_once "modelo.php";
    $db = conexion("restaurante", "root", "");
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
                <td>$plato->fecha</td>
                <td><a href='?idPlato=$plato->idPlato'>Indicar composicion</a></td>
                </tr>";

                if(isset($_REQUEST['idPlato']) && $_REQUEST['idPlato'] == $plato->idPlato) {
                    $comp = composicion($db, $plato->idPlato);

                    if (count($comp)>0) {
                        echo '<tr><td colspan="4">';
                        echo "<table>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                </tr>";
                        foreach ($comp as $c) {
                            echo "<tr>";
                            echo "<td>$c->nombre_ingrediente</td>";
                            echo "<td>$c->cantidad</td>";
                            echo '<td><input type="submit" action = "'.self().'?quitarIngrediente='.$c->idIngrediente.'" value="ELIMINAR INGREDIENTE"></td>';
                            echo '</tr>';
                        }
                        echo '</table>';
                    }
                    echo '</td></tr>';
                }
        }
    ?>
        </tr>
    </table>
</body>
</html>