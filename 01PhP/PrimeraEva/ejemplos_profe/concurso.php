<?php
    const PREGS=[
        ["Capital de Euskadi","Gasteiz"],
        ["Autor de El Hereje","Delibes"],
        ["Rio que pasa por Paris","Sena"],
        ["Capital de Ucrania","Kiev"]
    ];

    $aciertos=0;
    $indice=0;
    if (isset($_GET['ind']))
        $indice=$_GET['ind'];

    $retroAcierto="";

    if (isset($_POST['submit']))
    {
            $aciertos=$_POST['aciertos'];

            if ($_POST['resp']==PREGS[$indice][1]){
                $retroAcierto="Correcto";
                $aciertos++;
            }
            else
                $retroAcierto="Error. La rpta es ".PREGS[$indice][1];

            $indice++;
    
    
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
    <p><label><?php echo $retroAcierto ?></label></p>
    <p><label><?php echo $aciertos . "/" . count(PREGS) . " aciertos." ?></label></p>
<?php 
if ($indice<count(PREGS)) 
{
?>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']."?ind=$indice" ?>">
        <label><?php echo PREGS[$indice][0]  ?></label>
        <input type="text" name="resp" />
        <input type="hidden" name="aciertos" value="<?php echo $aciertos  ?>">
        <input type="submit" name="submit" value="SIGUIENTE"/>
    </form>
    
<?php
}
else
    echo "<p>Fin del test</p>";
?>

</body>
</html>