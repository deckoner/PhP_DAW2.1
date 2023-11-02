<?php
//require_once('Invitado.php');

session_start();

const TOPE_COMENSALES=10;


function total(){
    $total=0;
    foreach ($_SESSION['apuntados'] as $apuntado)
        $total+=$apuntado->asistentes;
    return $total;
}






if (!isset($_SESSION['apuntados']))
    $_SESSION['apuntados']=array();


if (isset($_POST['submit'])){
   /* $nuevo=new Invitado($_POST['nombre'],
                        $_POST['asistentes'] ,
                        $_POST['lleva']);

*/
    $nuevo=(object) [ "nombre"=>$_POST['nombre'],
            "asistentes"=>$_POST['asistentes'],
            "lleva"=>$_POST['lleva']
            ];

            
    $_SESSION['apuntados'][]=$nuevo;  
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
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']  ?>">
        <tr>
            <td><label>Nombre</label></td>
            <td><input type="text" name="nombre" /></td>
        </tr>
        <tr>
            <td><label>Nº personas</label></td>
            <td><input type="number" name="asistentes" value="1" /></td>
        </tr>
        <tr>
            <td><label>Lleva</label></td>
            <td><input type="text" name="lleva" /></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="APUNTAR">
            </td>
        </tr>
           
    </form>
</table>

   
<ol>
<?php
    foreach ($apuntados as $apuntado){
        echo "<li>";
        echo $apuntado->nombre .",";
        echo $apuntado->asistentes ." personas,";
        echo $apuntado->lleva;
        echo "</li>";        
    }
?>
</ol>



<?php
    if (total() >=TOPE_COMENSALES)
        echo "<a href='02organizar.php'>ORGANIZAR CENA</a>";


?>

   
</body>
</html>