<?php
    $amigos = array();
    $amigos[0] = "Juan";
    $amigos[] = "David";
    $amigos[2] = "Eder";
    $amigos[] = "Mikel";

    echo"<p>Amiguis</p>";
    for ($i=0; $i < count($amigos); $i++) { 
        echo "<li>".$amigos[$i]."</li>";
    }

    echo "<p>Dias de la semana</p>";
    $dias = ["Lunes", "Martes", "Miercoles"];
    $dias[3] = "jueves";

    if (in_array("viernes", $dias))
        echo "<p>Esta el viernes</p>";
    else
        echo "<p>No esta el viernes</p>";

    echo "<p>Posicion del jueves: ". array_search("jueves", $dias)."</p>";    

    echo "<p>Array ordenado</p>";
    sort($dias);
    print_r($dias);

    $ventas = array(
        "AMT" => 200,
        "Pedro" => 100,
        "Juanco" => 300
    );

    $ventas["Paquito"] = 100;

    $ventasMedias = 0;
    $cont = 0;
    foreach ($ventas as $nombre => $cantidad) {
        $ventasMedias += $cantidad;
        $cont++;
    }

    echo "<p>Medias: ".$ventasMedias/$cont."</p>"
?>