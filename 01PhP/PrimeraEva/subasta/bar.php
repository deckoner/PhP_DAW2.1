<?php
    $catresult = categorías($db);

    echo "<h1>Categorias</h1>";
    echo "<ul>";
    echo "<li><a href='index.php'>Ver todas</a></li>";

    foreach($catresult as $catrow) {
        echo "<li><a href='index.php?id="
        . $catrow->id . "'>" . $catrow->categoria. "</a></li>";
    }

    echo "</ul>";
?>