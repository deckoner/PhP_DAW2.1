<?php
session_start();

if (isset($_GET['destruir']))
{
    session_destroy();
    session_start();
}



//$_SESSION['apuntados']: array con los apuntados a la cena

if (!isset($_SESSION['apuntados']))
    $_SESSION['apuntados']=[];

//Aqui siempre existe el array de sesión con los apuntados

if (isset($_POST['submit'])){
    if (!in_array($_POST['nombre'],$_SESSION['apuntados']))
        $_SESSION['apuntados'][]=$_POST['nombre'];
}


$apuntados=$_SESSION['apuntados'];

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']  ?>">
        Nombre: <input type="text" name="nombre" />
        <input type="submit" name="submit" value="APUNTAR">
    </form>

    <?php
        $lnk_destroy=$_SERVER['PHP_SELF']."?destruir";
        echo "<a href='$lnk_destroy'>REINICIAR</a> ";
    ?>
    <ol>
    <?php
        foreach ($apuntados as $apuntado){
            echo "<li>$apuntado</li>";
        }
    ?>
    </ol>

    <p><a href='01fin.php'>FORMALIZAR CENA</a>
</body>
</html>