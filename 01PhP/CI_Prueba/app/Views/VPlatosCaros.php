<?php 

/* Platos: lista de objetos de los platos caros del restaurante */

echo "<table>";
    echo "<tr><th>Plato</th><th>Precio</th></tr>";
    foreach ($arrayPlatos as $platos) {
        echo "<tr>
            <td>$platos->nombre</td>
            <td>$platos->precio</td>
        </tr>";
    }
echo "</table>";

echo "<h1>Platos que nunca se han pedido: $nPlatosNoPedidos</h1>";

echo "<h1>Platos que se han pedido: $nPlatosNoPedidos</h1>";

?>