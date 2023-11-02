<?php 
    require_once "modelo.php";

    if (isset($_POST['enviar'])) {

        $contenido = $_POST['mensaje'];



        if (mail($_POST['destino'], "Mensaje dep rueba", $contenido, "From: trolopia@algo.com")) {
            echo "enviado";

        } else {
            echo "No enviado";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="<?PHP self() ?>">
        mensaje <input type="text" name="mensaje">
        para <input type="text" name="destino">
        <input type="submit" name="enviar" value="Enviar email">
    </form>
</body>
</html>