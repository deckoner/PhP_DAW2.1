<?php 
    const Libros = ["hamlet", "Una noche de verano", "Romeo y julieta"];

    function grabarOpinion($nomFich) {
        $f = fopen($nomFich, 'a');

        $opinion = $_POST['nombre']."\t".$_POST['opinion'];

        foreach($_POST['libro'] as $libro) {
            $opinion.=$libro.",";
        }

        fputs($f,$opinion);
    }


    $errNombre = "";
    $errOpinion = "";

    $valNombre = "";
    $valOpinion = "";

    if (isset($_POST['enviar'])) {

        if (empty($_POST['nombre'])) {
            $errNombre = "Rellenar nombre";
        } else {
            $valNombre = $_POST['nombre'];
        }

        if (empty($_POST['opinion'])) {
            $errOpinion = "Rellenar opinion";
        } else {
            $valOpinion = $_POST['opinion'];
        }

        if(!$errNombre && !$errOpinion) {
            grabarOpinion("ficheros/reco.txt");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
        <table>
            <tr>
                <td>
                    <label>Nombre</label>
                </td>
                <td>
                    <input type="text" name="nombre" value="<?php echo $valNombre?>">
                </td>
                <td>
                    <?php 
                        echo $errNombre;
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Opinion</label>
                </td>
                <td>
                    <textarea name="opinion"><?php echo $valOpinion?></textarea>
                </td>
                <td>
                    <?php 
                        echo $errOpinion;
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Marca los ibros que has leido</label>
                </td>
                <td>
                    <?php 
                        foreach(Libros as $libro) {
                            echo '<input type="checkbox" name="libro[]" value='.$libro.'" /> '.$libro.'<br>';
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Recomendarias losl ibros ?</label>
                </td>
                <td>
                    <input type="radio" name="recom" value="si"> si
                    <input type="radio" name="recom" value="no"> no
                </td>
            </tr>
        </table>

        <input type="submit" name="enviar" value="PROCESAR">
    </form>
</body>
</html>