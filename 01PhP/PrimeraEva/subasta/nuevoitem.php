<?php 
    include("cabecera.php");

    // * Guardamos la pagina actual
    $_SESSION['ACTUALPAGE'] = "nuevoitem.php";

    // Si no esta logueado lo mandamos a que se logue
    if (!isset($_SESSION['USERNAME'])) {
        header("Location: login.php");
        exit;
    }

    // Inicializamos la variable de error
    $errorDatos = "";

    // Calculamos cual seria la fecha para dentro de 20 dias
    $fecha_actual = date("Y-m-d");
    $fecha_calculada = date("d-m-Y", strtotime($fecha_actual."+ 20 days"));

    // Comprobamos si se ha hecho una consulta
    if (isset($_POST['objetoNuevo'])) {
        $errores = false;

        if (empty($_POST['nombreArticulo'])) {
            $errorDatos = "El articulo tiene que tener un nombre<br>";
            $errores = true;
        }

        if (empty($_POST["descripcion"])) {
            $errorDatos .= "El articulo tiene que tener una descripcion<br>";
            $errores = true;
        }

        // * Montamos la fecha con los datos
        $fechaArticulo = $_POST["fechaAnio"]."-".$_POST["fechaMes"]."-".$_POST["fechaDia"];

        if ($fechaArticulo == $fecha_actual) {
            $errorDatos .= "El articulo tiene que tener una fecha de fin minimo de un dia mas al actual<br>";
            $errores = true;
        } else {
            // * Le añadimos la hora
            $fechaArticulo .= " ".$_POST["fechaHora"].":".$_POST["fechaMinutos"].":00";
        }

        if (empty($_POST["precio"])) {
            $errorDatos .= "El articulo tiene que tener un precio<br>";
            $errores = true;
        }

        if (!$errores) {
            // * Insertamos el Item y guardamos su ID
            $idItem = insertarItem($db, $_POST['nombreArticulo'], $_POST["descripcion"], $fechaArticulo, $_POST["precio"], $_POST["categoria"], $_SESSION["USERID"]);
            
            if ($idItem == 0) {
                $errorDatos = "Ah ocurrido un error al subir el item a la pagina";
            } else{
                header("Location: editaritem.php?idItem=".$idItem);
                exit;
            }
        }
    }
?>

<h1>Añade nuevo item</h1>
<p style="color: red;"><?php echo $errorDatos ?></p>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <table>
        <tr>
            <td>Categoria</td>
            <td>
                <select name="categoria">
                    <?php 
                        $listaCategorias = categorías($db);

                        foreach($listaCategorias as $categoria){
                            echo "<option value=$categoria->id</option>$categoria->categoria</option>";
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>nombre</td>
            <td>
                <input type="text" name="nombreArticulo">
            </td>
        </tr>
        <tr>
            <td>Descripcion</td>
            <td>
                <textarea name="descripcion"></textarea>
            </td>
        </tr>
        <tr>
            <td>Fecha fin para pujas</td>
            <td>
                <table>
                    <tr>
                        <td>Dia</td>
                        <td>Mes</td>
                        <td>Año</td>
                        <td>Hora</td>
                        <td>Minutos</td>
                    </tr>
                    <tr>
                        <td>
                            <select name="fechaDia">
                                <?php 
                                    for ($i = 1; $i <= 31; $i++) {
                                        if ($i == date("d", strtotime($fecha_calculada))) {
                                            echo "<option selected=true value=$i>$i</option>";
                                        } else {
                                            echo "<option value=$i>$i</option>";
                                        }
                                    }  
                                ?>
                            </select>
                        </td>
                        <td>
                            <select name="fechaMes">
                                <?php 
                                    for ($i = 1; $i <= 12; $i++) {
                                        if ($i == date("m", strtotime($fecha_calculada))) {
                                            echo "<option selected=true value=$i>$i</option>";
                                        } else {
                                            echo "<option value=$i>$i</option>";
                                        }
                                    }  
                                ?>
                            </select>
                        </td>
                        <td>
                            <select name="fechaAnio">
                                <?php 
                                    $anio_actual = date("Y");

                                    for ($i = $anio_actual; $i <= $anio_actual+5; $i++) {
                                        if ($i == date("Y", strtotime($fecha_calculada))) {
                                            echo "<option selected=true value=$i>$i</option>";
                                        } else {
                                            echo "<option value=$i>$i</option>";
                                        }
                                    }  
                                ?>
                            </select>
                        </td>
                        <td>
                            <select name="fechaHora">
                                <?php 
                                    for ($i = 1; $i <= 23; $i++) {
                                        echo "<option value=$i>$i</option>";
                                    }  
                                ?>
                            </select>
                        </td>
                        <td>
                            <select name="fechaMinutos">
                                <?php 
                                    for ($i = 1; $i <= 59; $i++) {
                                        echo "<option value=$i>$i</option>";
                                    }  
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>precio</td>
            <td>
                <input type="number" name="precio">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" name="objetoNuevo" value="Enviar!" style="width: 100%;">
            </td>
        </tr>
    </table>
</form>

<?php 
    include("pie.php");
?>