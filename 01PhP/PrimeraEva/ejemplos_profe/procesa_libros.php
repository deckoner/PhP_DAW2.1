

<?php

    if (isset($_POST['submit'])){
        echo "<br/>Nombre:".$_GET['nombre'];
        echo "<br/>Opinión:".$_GET['opinion'];
        echo "<br/>Libros leidos:";
        if (isset($_GET['leidos'])){
            foreach($_GET['leidos'] as $libro)
                echo "$libro ";
        }
        else
            echo "Ningun libro leido";
        if (isset($_GET['recom']))
            echo "Recomendado:".$_GET['recom'];
        else
            echo "Ningún radio seleccionado";
    }
    else{
        header("location:libros.php");
        exit();
    }
?>