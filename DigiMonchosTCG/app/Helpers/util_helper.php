<?php 
use Config\Services;

function strFechaHoy() {
    $fechaHoy = date('Y-m-d');
    return $fechaHoy;
}

function encriptarContra($texto) {
    $hashedPassword = password_hash($texto, PASSWORD_DEFAULT);

    return $hashedPassword;
}

function comprobarContra($texto, $textoHash) {
    if (password_verify($texto, $textoHash)) {
        return true;
    } else {
        return false;
    }
}