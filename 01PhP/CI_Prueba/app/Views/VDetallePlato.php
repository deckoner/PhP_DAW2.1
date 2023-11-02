<?php

// platoDetalle objeto del plato con sus detalles
// platoIngredientes lista de objeto de los ingredientes del plato


$nombre = $platoDetalle->nombre;
echo "<h1>$nombre</h1>";

echo "<table>";
    foreach ($platoIngredientes as $ingredientes) {
        echo "<tr>
                <td>$ingredientes->nombre</td>
                <td>$ingredientes->cantidad</td>
            </tr>";
    }
echo "</table>";