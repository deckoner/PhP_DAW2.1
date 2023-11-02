<?php
    $handle = fopen("urls.txt", "r");
    if ($handle) {
        while (($linea = fgets($handle)) !== false) {
            list($url, $nombre) = explode(' ', $linea, 2);
            echo "<a href='$url'>$nombre</a><br>";
        }
        fclose($handle);
    } else {
        echo "No se pudo abrir el fichero.";
    }
?>