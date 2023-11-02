<?php
    function esBisiesto($n){
        return (($n % 400 == 0) || ($n % 4 == 0) || $n % 100 != 0);
    }

    function diasCalidos($tem,$tempMiCalido) {
        $cont = 0;
        foreach($tem as $temDia) {
            if($temDia <= $tempMiCalido) {
                $cont++;
            }
        }

        return $cont;
    }
?>