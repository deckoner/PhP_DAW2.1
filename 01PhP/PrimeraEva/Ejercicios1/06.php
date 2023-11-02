<?php
function crearTablaHoraria($dias, $horaInicio, $horaFin, $intervalo) {
    // Crear un arreglo de horas en función del intervalo
    $horas = [];
    $horaActual = strtotime($horaInicio);
    $horaFin = strtotime($horaFin);

    while ($horaActual <= $horaFin) {
        $horas[] = date("H:i", $horaActual);
        $horaActual += $intervalo * 60; // Convertir minutos en segundos
    }

    // Crear la tabla HTML
    echo '<table border="1">';
    echo '<tr>';
    echo '<th></th>';
    
    foreach ($dias as $dia) {
        echo '<th style="padding: 3px;">' . $dia . '</th>';
    }
    
    echo '</tr>';

    foreach ($horas as $indice => $hora) {
        echo '<tr' . ($indice % 2 != 0 ? ' style="background-color: #cacaca;"' : '') . '>';
        echo '<td>' . $hora . '</td>';
        
        foreach ($dias as $dia) {
            echo '<td></td>';
        }
        
        echo '</tr>';
    }

    echo '</table>';
}

// Ejemplo de uso
$diasSemana = ["Lun", "Mar", "Mie", "Jue", "Vie", "Sab", "Dom"];
$horaInicio = "8:00";
$horaFin = "15:00";
$intervalo = 60;

crearTablaHoraria($diasSemana, $horaInicio, $horaFin, $intervalo);

?>