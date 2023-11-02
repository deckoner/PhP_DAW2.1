<?php 
    // Eliminamos todas las sesiones
    session_start();
    session_unset();

    // Le dirijimos hasta el index
    header("Location: index.php");
    exit;
?>