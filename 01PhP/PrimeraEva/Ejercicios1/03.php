<?php
$ciudades_espana = array(
    "Madrid",
    "Barcelona",
    "Valencia",
    "Sevilla",
    "Zaragoza",
    "Málaga",
    "Murcia",
    "Palma de Mallorca",
    "Las Palmas de Gran Canaria",
    "Bilbao"
);

// Eliminar duplicados usando la función array_unique
$ciudades = array_unique($ciudades_espana);

// Visualizar la lista numerada sin duplicados
foreach ($ciudades as $key => $ciudad) {
    echo ($key + 1) . ". " . $ciudad . "<br>";
}
?>
