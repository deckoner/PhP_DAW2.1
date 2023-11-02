<?php

session_start();

const MIN_COMENSALES=5;

if(!isset($_SESSION['apuntados'])){
    header("location:01cena.php");
    exit();
}

if (count($_SESSION['apuntados'])<MIN_COMENSALES){
    header("location:01cena.php");
    exit();
}

echo "Se hace cena";
print_r($_SESSION['apuntados']);



?>