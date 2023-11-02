<?php 
    //funciones de time
    echo time();
    echo "<br>";

    echo date("d-m-Y");
    echo "<br>";

    $strSalida = "14:30";
    $tiempoSalida = strtotime($strSalida);

    Echo ((($tiempoSalida - time())/60)/60)." Faltan minutos";



?>