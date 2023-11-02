<?php 
    require_once "modelo.php";
    session_start();

    $user = $_SESSION['user'];
    $db = conexion("restaurante", "root", "");
    $platos = platos($db);

    if (!isset($_SESSION['platos'])) {
        $_SESSION['platos'] = [];
    }

    if (isset($_GET['idPlato'])) {
        // Recuperamos el array
        $platosActuales = $_SESSION['platos'];
        $platosActuales[] = $_GET['idPlato'];
    
        // Asignamos el valor actualizado a la sesión
        $_SESSION['platos'] = $platosActuales;
    }

    if (isset($_GET['pedidoGuardar'])) {
        $platosActuales = $_SESSION['platos'];
        if (realizarPedido($db, $user->dni, $platosActuales)) {
            echo "<h3>Pedido realizado con exito</h3>";
            $_SESSION['platos'] = [];
        } else {
            echo "<h3>No se ha podido realizar su pedido</h3>";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
    <title>Elegir platos</title>
</head>
<body>
    <h1>Bienvenido/a <?php echo $user->nombre?></h1>
    <h3>Elije tus platos</h3>

    <table>
        <tr>
            <th>nombre</th>
            <th>precio</th>
            <th></th>
        </tr>
        <?php 
            $platosActuales = $_SESSION['platos'];

            foreach($platos as $p) {
                echo "<tr>";
                echo "<td>{$p->nombre}</td>";
                echo "<td>{$p->precio}€</td>";

                if (in_array($p->idPlato, $platosActuales)) {
                    echo '<td><a style="pointer-events: none; color: gray;">Añadido</a></td>';
                } else {
                    echo '<td><a href="?idPlato='.$p->idPlato.'">Añadir a pedido</a></td>';
                }
                echo "</tr>";
            }
        ?>
    </table>

    <?php 
        $platosActuales = $_SESSION['platos'];
        if(!empty($platosActuales )) {
    ?>
        <h3>Pedido actual</h3>
        <table>
            <tr>
                <th>nombre</th>
                <th>precio</th>
            </tr>
            <?php 
                $precioTotal = 0;
                
                foreach($platosActuales as $p) {
                    $plato = obtenerPlato($db, $p);

                    echo "<tr>";
                    echo "<td>{$plato->nombre}</td>";
                    echo "<td>{$plato->precio}€</td>";
                    echo "</tr>";

                    $precioTotal += $plato->precio;
                }
                echo "<tr></tr>";
                echo '<td colspan="2" style="text-align: right;">Total: '.$precioTotal.'€</td>';
            ?>
        </table>
        <?php 
            echo '<a href="?pedidoGuardar">Guardar Pedido</a>';
        ?>
    <?php 
    }
    ?>
</body>
</html>