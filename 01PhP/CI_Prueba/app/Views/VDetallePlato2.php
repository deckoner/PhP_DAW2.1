<?php
$sesion = session();
$plato = $sesion->get('platoSelecionado');
$platoIngredientes = $sesion->get('platoIngredientes');

// manera alternativa de acceder a elemento de sesion
// $sesion->platoSelecionado->nombre

$nombre = $plato->nombre;
echo "<h1>$plato->nombre</h1>";
echo "<p>Precio del palto: $plato->precio €</p>";

echo "<table border='1'>";
    foreach ($platoIngredientes as $ingredientes) {
        echo "<tr>
                <td>$ingredientes->nombre</td>
                <td>$ingredientes->cantidad</td>
            </tr>";
    }
echo "</table>";