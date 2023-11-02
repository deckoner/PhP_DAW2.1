<?php 
    if(isset($_POST['enviar'])) {
        echo "Nombre: ".$_POST['nombre'];
        echo "<br> Opinion: ".$_POST['opinion'];

        if(isset($_POST['libro'])) {
            
        }

    } else{
        header("location:libros.php");
        exit;
    }

?>