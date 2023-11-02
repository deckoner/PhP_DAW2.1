<?php 
include "libmenu.php";

if (isset($_POST['login'])) {
    $user = $_POST['user'];
    $contra = $_POST['contra'];

    // Comprobamos si el usuario ah puesto algun usuario y contraseña
    if (!empty($user) or !empty($contra))  {
        if (autentica($user, $contra) == 1) {
            // Iniciamos sesion
            session_start();
            
            // Optenemos el descuento
            $descuento = dameDcto($user);

            // Guardamos los datos en la sesion
            $sesionUser = [$user, $descuento];
            $_SESSION['sesionUser'] = $sesionUser;

            // Le redirigimos a la ventana
            header('location:pedido.php');
            exit();
        } else {
            // Si el usuario y contraseña no estan o no coincide mandamos un mensaje de error
            header('location:entrada.php?mensaje=Usuario o contraseña incorrectos');
            exit();
        }
    } else {
        // Si no ha escrito nada se lo indicamos
        header('location:entrada.php?mensaje=No has intradoucido usuario o contraseña');
        exit();
    }
}

if (isset($_POST['invitado'])) {
    header("location:pedido.php");
    exit();
}
?>