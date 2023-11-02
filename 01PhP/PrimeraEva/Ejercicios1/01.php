<?php
    // Ejercicio 1.1, mostrar fecha
    $date = date("jS F Y, l");
    echo $date."<br>";

    // Ejercicio 1.2, Dias para finalizar el año
    $today = new DateTime();
    $endOfYear = new DateTime(date("Y-12-31"));
    $daysLeft = $endOfYear->diff($today)->format("%a");
    echo "Quedan $daysLeft días para finalizar el año.<br>";


    // Ejercicio 1.3, Montar cadena con array
    $words = array("Esta", "es", "una", "cadena", "de", "ejemplo.");
    $sentence = implode(" ", $words);
    echo $sentence."<br>";

    // Ejercicio 1.4, cambiar ñ por gn
    $textoConEnes = "Año con eñes";
    $textoSinEnes = str_replace("ñ", "gn", $textoConEnes);
    echo $textoSinEnes."<br>";

    // Ejercicio 1.5, funcion de numero aleatorios
    function generarNumerosAleatorios($n, $limite1, $limite2) {
        $numeros = array();
        for ($i = 0; $i < $n; $i++) {
            $numeros[] = rand($limite1, $limite2);
        }
        return $numeros;
    }
    
    $n = 5;
    $limite1 = 1;
    $limite2 = 15;
    $resultado = generarNumerosAleatorios($n, $limite1, $limite2);
    
    echo "Números aleatorios generados: " . implode(", ", $resultado)."<br>";

    // Ejercicio 1.6, 
    function cifrarCadena($cadena) {
        $cadenaCifrada = '';
        $longitudCadena = strlen($cadena);
        $arrayCifrado = [
            "A" => "20",
            "H" => "9R",
            "M" => "abcd"
        ];
    
        for ($i = 0; $i < $longitudCadena; $i++) {
            $caracter = $cadena[$i];
    
            // Verificar si el caracter existe en el array de cifrado
            if (array_key_exists($caracter, $arrayCifrado)) {
                $cadenaCifrada .= $arrayCifrado[$caracter];
            } else {
                $cadenaCifrada .= $caracter;
            }
        }
    
        return $cadenaCifrada;
    }
    
    $cadenaOriginal = "HOLA AMO";
    $cadenaCifrada = cifrarCadena($cadenaOriginal);
    
    echo "Cadena Original: " . $cadenaOriginal . "<br>";
    echo "Cadena Cifrada: " . $cadenaCifrada;

?>
