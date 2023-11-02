<?php
    // Funciones
    function factorial($num){
        for ($cont=0, $fact=1; $cont<=$num; $cont++) { 
            $fact+=$cont;
        }
        return $fact;

    }

    function tablasfact($lim1, $lim2){
        echo "<table>";
        echo "<tr><td colspan=2>TABLA DE FACTORIALES</td></tr>";

        for ($num=$lim1; $num<=$lim2; $num++) { 
            echo "<tr>";
            echo "<td>$num</td>";
            echo "<td>".factorial($num)."</td>";
            echo "</tr>";
        }
    }


    $titulo = "Pruebas de imprimir php";
    $texto = "Hola soy un texto y el numero de la variable num es: ";
    $num = 5;

    $num1 = 0;
    $bollean = false;

    echo "<h1>$titulo</h1>";
    echo "<p>$texto . $num</p>";

    // Mismo valor
    echo "<p>Mismo valor</p>";
    if ($num1 = $bollean)
        echo "<p>son iguales</p>";
    else
        echo "<p>No lo son</p>";
    
    //Mismo valor y tipo de dato
    echo "<p>Mismo valor mismo tipo</p>";
    if ($num1 === $bollean)
        echo "<p>son iguales</p>";
    else
        echo "<p>No lo son</p>";

    echo "<p>Funcion de tabla de factoriales</p>";
    echo tablasfact(3, 10);
?>