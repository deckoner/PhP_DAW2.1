<?php 

    echo "<table>";
        echo"<tr><th>NUM</th><th>RAIZ</th></tr>";
        for ($i = 1; $i < 11; $i++) {
            echo "<tr><td>$i</td><td>".sqrt($i)."</td></tr>";
        }
    echo "</table>";

?>