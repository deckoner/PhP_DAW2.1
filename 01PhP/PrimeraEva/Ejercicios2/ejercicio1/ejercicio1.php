<?php 
function cifrarTexto($texto, $desplazamiento) {
    $resultado = '';

    $longitudTexto = strlen($texto);

    for ($i = 0; $i < $longitudTexto; $i++) {
        $caracter = $texto[$i];

        // Convierte el caracter a su valor ASCII y aplica el desplazamiento.
        $ascii = ord($caracter);
        $asciiCifrado = ($ascii - 65 + $desplazamiento) % 26 + 65;

        // Convierte el valor ASCII cifrado de nuevo a caracter y lo agrega al resultado.
        $caracterCifrado = chr($asciiCifrado);
        $resultado .= $caracterCifrado;
    }
    return $resultado;
}

function cifrarTextoConClave($texto, $cadenaClave) {
    // Paso 1: Leer la cadena clave desde el archivo de texto
    $claveFile = fopen($cadenaClave, 'r');
    $clave = fgets($claveFile);
    fclose($claveFile);

    $cadenaCifrada = '';

    // Paso 3: Procesar la cadena de entrada letra por letra
    for ($i = 0; $i < strlen($texto); $i++) {
        $letraCifrada = cifrarLetra($texto[$i], $clave);
        $cadenaCifrada .= $letraCifrada;
    }

    return $cadenaCifrada;
}

function cifrarLetra($letra, $clave) {
    $abecedario = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // Asumiendo un alfabeto en mayúsculas
    $letra = strtoupper($letra); // Convertir a mayúsculas
    $posicion = strpos($abecedario, $letra);

    if ($posicion !== false) {
        // Reemplazar la letra con la correspondiente en la cadena clave
        return $clave[$posicion];
    } else {
        // Mantener caracteres que no estén en el alfabeto intactos
        return $letra;
    }
}
?>

<?php 
    // Variables del formulario
    $textoCampo = "";

    // Variables de la logica
    $desplazamientos = [3, 5, 10];
    $erroresTexto = "";
    $textoCifrado = "";
    $errores = false;

    // Comprobamos si se han pulsado alguno de los dos botones
    if (isset($_POST['cifradoCesar']) or isset($_POST['cifradoSustitucion'])) {
        if (empty($_POST['texto'])) {
            $errores = true;
            $erroresTexto = "<p style='color: red;'>Porfavor introduzca un texto que cifrar</p>";
        } else {
            $textoCampo = $_POST['texto'];
        }

        // comprobamos si el boton pulsado es de cesar o sustitucion
        if (isset($_POST['cifradoCesar'])) {
            if (!isset($_POST['cbCesar'])) {
                $errores = true;
                $erroresTexto .= "<p style='color: red;'>Porfavor selecione un desplazamiento</p>";
            } else {
                $textoCifrado = cifrarTexto(strtoupper($_POST['texto']), $_POST['cbCesar']);
            }
        } else {
            //$direccion = "claves/".$_POST['claveSeleccion'];
            $textoCifrado = cifrarTextoConClave(strtoupper($_POST['texto']), "claves/fichero_clave1.txt");
        }

        if ($errores) {
            echo $erroresTexto;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 Cifrador de cadenas</title>
</head>
<body>
    <main>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']   ?>">
            <table>
                <tr>
                    <td><p>Texto a cifrar</p></td>
                    <td><input type="text" name="texto" value="<?php echo $textoCampo; ?>""></td>
                </tr>
                <tr>
                    <td><p>Desplazamiento</p></td>
                    <td>
                        <?php 
                        for ($i=0; $i < count($desplazamientos); $i++) { 
                            echo "<label><input type='radio' name='cbCesar' value='$desplazamientos[$i]'/>$desplazamientos[$i]</label><br>";
                        }
                        ?>
                    </td>
                    <td><input type="submit" name="cifradoCesar" value="CIFRAR CESAR"></td>
                </tr>
                <tr>
                    <td><p>Fichero de clave</p></td>
                    <td>
                        <select name="claveSeleccion">
                            <?php 
                                $arr = scandir("claves");
                                foreach ($arr as $claves) {
                                    // Sacamos el tipo mime del archivo para comprarlo con el de txt
                                    $ruta = "claves/" . $claves;
                                    $tipo = mime_content_type($ruta);

                                    if ($tipo == "text/plain") {
                                        echo "<option value='$claves'>$claves</option>";
                                    }
                                }
                            ?>
                        </select>
                    </td>
                    <td><input type="submit" name="cifradoSustitucion" value="CIFRAR POR SUSTITUCION"></td>
                </tr>
            </table>
            <?php echo"<h2>$textoCifrado</h2>" ?>
        </form>
    </main>
</body>
</html>