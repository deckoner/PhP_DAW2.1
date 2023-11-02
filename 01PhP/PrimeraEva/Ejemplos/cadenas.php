<?php 
    $numero = 1;
    $cadena1 = "Hola soy la cadena numero $numero <br>";
    $cadena2 = `Soy la cadena dos con las comillas simples`;

    echo $cadena1;
    echo $cadena2;

    $cad = "hola que tal";
    $aguja = "hola";

    if (strpos($cad,$aguja)) {
        echo "<p>No encontrado</p>";
    } else {
        echo "<p>Encontrado</p>";
    }
?>