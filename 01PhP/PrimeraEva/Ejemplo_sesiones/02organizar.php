<?php
session_start();

function lo_lleva_otro($lleva){
    $cont=0;
    foreach ($_SESSION['apuntados'] as $apuntado)
        if ($apuntado->lleva==$lleva)
            $cont++;
    if ($cont>1)
        return true;
    return false;

}

function cambiar_lleva($nombre,$lleva){
    $ind=array_search($nombre,array_column($_SESSION['apuntados'],'nombre'));
    $_SESSION['apuntados'][$ind]->lleva=$lleva;
}

if (!isset($_SESSION['apuntados']))
{
    header("location:02cena.php");
    exit();
}

if (isset($_POST['cambiar'])){
    echo $_POST['nombre'];
    echo $_POST['lleva'];
    cambiar_lleva($_POST['nombre'],$_POST['lleva']);
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


<table>
<?php
    foreach ($apuntados as $apuntado){
        echo "<form action='".$_SERVER['PHP_SELF']."' method='post'>";
        echo "<tr>";
        echo "<td><label>$apuntado->nombre</label></td>";
        echo "<td><label>$apuntado->asistentes</label></td>";
        echo "<input type='hidden' name='nombre' value='$apuntado->nombre'>";

        if (lo_lleva_otro(($apuntado->lleva)))
        {
            echo "<td><input type='text' name='lleva' value='$apuntado->lleva'></td>";
            echo "<td><input type='submit' name='cambiar' value='CAMBIAR'></td>";
        }
        else
        {
            echo "<td><input type='text' name='lleva' value='$apuntado->lleva' disabled></td>";
            echo "<td><input type='submit' name='cambiar' value='CAMBIAR' disabled></td>";
        }
        echo "</tr>";
        echo "</form>";
    }
?>
</table>
</body>
</html>