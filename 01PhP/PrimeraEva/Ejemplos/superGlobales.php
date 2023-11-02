<?php 
    function diasCalidos($tem,$tempMiCalido) {
        $cont = 0;
        foreach($tem as $temDia) {
            if($temDia <= $tempMiCalido) {
                $cont++;
            }
        }

        return $cont;
    }
    echo $_SERVER("SERVER_ADOR");
    echo "<br>";

    echo $_SERVER("REMOTE_ADOR");
    echo "<br>";


    echo "<br>";

?>