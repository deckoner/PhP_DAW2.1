<?php 
    include("cabecera.php");

    // Controlamos si le han dado al boton de volver
    if (isset($_POST["submit"])) {
        //Destruimos la sesion
        unset($_SESSION["comprarEntradas"]);

        // lo mandamos de vuelta al index
        header("Location: index.php");
        exit;
    }

    // Comprobamos si ahi sesion, si no la ahi le enviamos de vuelta al index
    if (isset($_SESSION["comprarEntradas"])) {
        //Re cuperamos el array asociativo
        $comprarEntradas = $_SESSION["comprarEntradas"];
        $comprarEntradasLimpio = $_SESSION["comprarEntradas"];
    } else {
        header("Location: index.php" );
        exit;
    }
?>

<h1>SU RESERVA</h1>
<?php 
    foreach ($comprarEntradas as $key => $nEntradas) {
        $funcion = funcionReserva($db, $key);

        if (($funcion->vendidas + $nEntradas) >= $funcion->capacidad) {
            echo 'Funcion '.$funcion->numero.' ('.$funcion->nombreCine.' sala '.$funcion->sala.', '.$funcion->pelicula.') IMPOSIBLE RESERVAR X entradas';
        } else {
            $totalEntradas = $funcion->precio * $nEntradas;
            echo 'Funcion '.$funcion->numero.' ('.$funcion->nombreCine.' sala '.$funcion->sala.', '.$funcion->pelicula.') ENTRADAS RESERVADAS: '.$nEntradas.'  '.$nEntradas.' entradas x '.$funcion->precio.' € = '.$totalEntradas.'€';

            // Cambiamos los valores en la base de datos
            cobrarEntrada($db, $key, $totalEntradas, $nEntradas);
        }
    }
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <input type="submit" name="volver" value="VOLVER">
</form>