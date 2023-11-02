<?php


    function partidos($fich){        
        $partidos=[];
        $f=fopen($fich,'r');
        while (!feof($f)){
            $partidos[]=fgets($f);
        }
        fclose($f);
        //print_r($partidos);
        return $partidos;
    }

    function guardarRtdo($fich,$equipos,$rtdo){
        $partidos=[];
        $f=fopen($fich,'r');
        while (!feof($f)){
            $linea=trim(fgets($f));
            if ($linea==trim($equipos)){
                $linea.=";".$rtdo;
            }                
            $partidos[]=trim($linea);
        }
        fclose($f);

        $f=fopen($fich,"w");
        for ($i=0; $i<count($partidos);$i++){
            fputs($f,$partidos[$i]);
            if ($i<count($partidos)-1)
                fputs($f,"\n");
        }
           
        fclose($f);
    }







    



    if (isset($_GET['submit'])){
        $equipos=$_GET['equipos'];
        $rtdo=$_GET['rtdo'];
        guardarRtdo("ficheros/partidos.txt",$equipos,$rtdo);
        echo "Guardado";
    }


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table>
    <?php

        $arrP=partidos("ficheros/partidos.txt");
        foreach($arrP as $linea)  //linea tiene formato "CElta;RS"
        {
            $eLocal=explode(";",$linea)[0]; 
            $eVisitante=explode(";",$linea)[1]; 
            $desh="";
            if (count(explode(";",$linea))>2)
            {
                $desh="disabled";
            }
            

            echo "<form method='get' action='". $_SERVER['PHP_SELF']."'>";
            echo "<tr>";
            echo "<input type='hidden' name='equipos' value='".$linea."'/>";
            echo "<td>$eLocal</td>";
            echo "<td>$eVisitante</td>";
            echo "<td>";
            echo "<select name='rtdo' >";
                echo "<option value='1'>1</option>";
                echo "<option value='2'>2</option>";
                echo "<option value='X'>X</option>";
            echo "</select>";
            echo "</td>";
            echo "<td><input type='submit' " .$desh." name='submit' value='GUARDAR' /></td>";
            echo "</tr>";
            echo "</form>";
        }
    ?>
    </table>
</body>
</html>