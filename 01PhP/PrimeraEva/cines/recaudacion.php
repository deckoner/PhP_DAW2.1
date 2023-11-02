<?php 
    include("cabecera.php");
    //Constante para el umbral de recaudacion
    const n = 1000;

    if(isset($_POST['eliminar'])) {
        echo $_POST['pelicula'];
        eliminarFunciones($db, $_POST['pelicula']);
        eliminarPeliculas($db, $_POST['pelicula']);
    }

    if (isset($_GET['peliculaSlect'])) {
        $selecionada = $_GET['peliculaSlect'];
    } else {
        $selecionada = null;
    }

    $listaPelicula = recuperarRecaudacion($db);
?>

<h1>PELICULAS RECAUDADAS</h1>

<?php 

    if (empty($listaPelicula)) {
        echo "<h2>No ahi peliculas que hayan llegado al umbral</h2>";
    } else {
        foreach ($listaPelicula as $pelicula) {
            echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'">
                <table>
                    <tr>
                        <input type=hidden name="pelicula" value='.$pelicula->idPelicula.'>
                        <td><a href="recaudacion.php?peliculaSlect='.$pelicula->idPelicula.'">'.$pelicula->nombre.'</a></td>
                        <td>'.$pelicula->totalRecaudadoo.'€</td>
                        <td><input type="submit" name="eliminar" value="ELIMINAR"></td>
                    </tr>';

            if (!is_null($selecionada)) {
                if ($selecionada == $pelicula->idPelicula) {
                    $funciones = listarFuncionesPorPelicula($db, $selecionada);

                    echo "<table>
                        <tr>
                            <th>CINE</th>
                            <th>SALA</th>
                            <th>HORA</th>
                            <th>RECAUDADO</th>
                            <th>OCUPACION</th>
                        </tr>";
                    foreach ($funciones as $funcion) {
                        // Convertir la cadena de fecha en un objeto DateTime
                        $fecha = new DateTime($funcion->fecha);
                        $fechaFormateada = $fecha->format('d-M-Y H:i'); // Formatear la fecha

                        echo "<tr>
                            <td><img style='width: 5em;' src='data:image/jpeg;base64," . base64_encode($funcion->imagen) . "' alt='Logo del cine'></td>
                            <td>$funcion->numeroSala</td>
                            <td>$fechaFormateada</td>
                            <td>$funcion->recaudado €</td>";
                        echo '<td>'.number_format($funcion->porcentaje, 2).'%</td>
                        </tr>';
                    }
                    echo "</table>";
                }
            }

            echo '</table></form>';
        }
    }

?>
