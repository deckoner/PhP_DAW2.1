<?php 
    include("cabecera.php");

    if (isset($_GET['cadena']) and isset($_GET['email'])) {
        if (comprobarUserCadena($db, urldecode($_GET['cadena']), urldecode($_GET['email']))) {
            if (activarUser($db, urldecode($_GET['cadena']), urldecode($_GET['email']))) {
                echo "<h1>Se ha verificado tu cuenta. puede entrar pulsando log in</h1>";
            } else {
                echo "<h1>No se puede verificar dicha cuenta</h1>";
            }
        } else {
            echo "<h1>No se encontro ninguna cuenta a verificar</h1>";
        }
    };

    include("pie.php");
?>