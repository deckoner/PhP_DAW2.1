<?php
    const LIBROS=["Hamlet","Otelo","Romeo y Julieta","El mercader"];


    function grabarOpinionShak($nomFich){
            $f=fopen($nomFich,"a");

            $opinion=$_POST['nombre']."\t".$_POST['opinion'];

            $opinion.="Libros leidos:";

            foreach ($_POST['leidos'] as $libro){
                $opinion.=$libro.",";
            }

            $opinion.=($_POST['recom']=='SI')?",lo recomienda":"NO lo recomienda";
            $opinion.="\n";
            
            fputs($f,$opinion);
            fclose($f);
    }


?>


<?php

    $errNombre="";
    $errOpinion="";
    $errLeidos="";
    $errRecom="";

    $valNombre="";
    $valOpinion="";

    $arrLeidos=array();

    $radSI="";
    $radNO="";


    if (isset($_POST['submit'])){

        //Examinar nombre
        if (empty($_POST['nombre']))
            $errNombre="Rellenar nombre!";
        else
            $valNombre=$_POST['nombre'];

        //OPINION
        if (empty($_POST['opinion']))
            $errOpinion="Rellena tu opinion!";
        else
            $valOpinion=$_POST['opinion'];


        //LIBROS
        if (!isset($_POST['leidos']))
            $errLeidos="Marca libros leidos!";
        else
            $arrLeidos=$_POST['leidos'];

        //RECOM
        if (!isset($_POST['recom']))
            $errRecom="Marca si o no!";
        else
        {
            $radSI=($_POST['recom']=='SI')?"checked":"";
            $radNO=($_POST['recom']=='NO')?"checked":"";
        }

        if (!$errNombre && !$errOpinion && !$errLeidos && !$errRecom){
            grabarOpinionShak("ficheros/op_shakpre.txt");
            echo "<h2>OPINION GUARDADA</h2>";
        }


    }



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libros</title>
</head>
<body>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']   ?>">
    <table>
        <tr>
            <td><label>Nombre</label></td>
            <td><input type="text" name="nombre" value="<?php echo $valNombre ?>" /></td>
            <td><?php echo $errNombre  ?></td>
        </tr>
        <tr>
            <td><label>Opinión</label></td>
            <td><textarea name="opinion" cols="30" rows="10"
                    value="<?php echo $valOpinion ?>" > 
                    <?php echo $valOpinion ?> 
                </textarea>
            </td>
            <td><?php echo $errOpinion  ?></td>
        </tr>
        <tr>
            <td><label>Marca libros leidos</label></td>
            <td>
                <?php
                    foreach (LIBROS as $libro)
                    {                        
                         $marcado="";    
                         if (in_array($libro,$arrLeidos))
                            $marcado=" checked";                    
                         echo "<input type='checkbox' name='leidos[]' value='$libro' $marcado/> $libro <br/>";
                        
                    }
                ?>
            </td>
            <td><?php echo $errLeidos  ?></td>             
            
        </tr>
        <tr>
            <td><label>Recomiendas Shakespeare?</label></td>
            <td>
                <input type="radio" name="recom" value="SI" <?php echo $radSI ?>  > SI
                <input type="radio" name="recom" value="NO" <?php echo $radNO ?>    > NO
            </td>
            <td><?php echo $errRecom  ?></td>
        </tr>
        <tr>
            <td colspan="3">
                <input type="submit" name="submit" value="PROCESAR"/>
            </td>
        </tr>



    </table>
    </form>


    
</body>
</html>