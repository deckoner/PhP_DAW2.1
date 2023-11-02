<?php 
    $temperaturas = [25.5, 27.8, 24.2, 28.1, 26.0, 22.3, 30.5, 31.2, 23.7, 29.4, 27.0, 26.8, 32.0, 25.9, 23.5, 27.7, 28.4, 26.6, 29.2, 25.1];

    // Mostrar el array de temperaturas
    echo "Temperaturas del mes: " . implode(", ", $temperaturas) . "<br>";

    // Calcular la media de las temperaturas (sin bucle)
    $media = array_sum($temperaturas) / count($temperaturas);
    echo "Media (redondeada): " . round($media, 2) . "<br>";
    echo "Media (truncada): " . intval($media) . "<br>";

    // Ordenar el array de temperaturas en orden ascendente
    sort($temperaturas);
    echo "5 temperaturas más bajas: " . implode(", ", array_slice($temperaturas, 0, 5)) . "<br>";

    // Ordenar el array de temperaturas en orden descendente
    rsort($temperaturas);
    echo "5 temperaturas más altas: " . implode(", ", array_slice($temperaturas, 0, 5)) . "<br>";
?>