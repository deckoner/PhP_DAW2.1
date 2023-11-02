<?php 
function mostrarImagenesEnTabla($imagenes) {
    $columnCount = 0;
    $columnMax = 3;
    
    // Elimina imágenes duplicadas
    $imagenes = array_unique($imagenes);

    echo '<table>';

    foreach ($imagenes as $imagen) {
        if ($columnCount == $columnMax) {
            echo '</tr><tr>';
            $columnCount = 0;
        }

        // Contenido de la celda
        echo '<td>';
        echo '<a href="' . $imagen . '" target="_blank">';
        echo '<img src="' . $imagen . '" alt="Imagen" width="200px">';
        echo '</a>';
        echo '</td>';

        $columnCount++;
    }

    if ($columnCount > 0) {
        echo '</tr>';
    }
    echo '</table>';
}

$rutasImagenes = array(
    'img/1.jpg',
    'img/2.jpg',
    'img/3.jpg',
    'img/4.jpg',
    'img/5.jpg',
    'img/5.jpg',
);

mostrarImagenesEnTabla($rutasImagenes);
?>