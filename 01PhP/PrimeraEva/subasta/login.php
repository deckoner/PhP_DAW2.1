<?php
    include("cabecera.php");

    $errorTexto = "";
    
    if (isset($_POST['loging'])) {
        $user = login($db, $_POST['user'], $_POST['contra']);

        // comprobamos que no haya devolvido un false la funcion anterior
        if ($user) {
            // Comprobamos que la cuenta este activa
            if ($user->activo == 1) {
                // Guardamos tanto el user como la id en la sesion
                $_SESSION['USERNAME'] = $user->username;
                $_SESSION['USERID'] = $user->id;

                // * Devolvemos al user de donde vino
                header("Location: " . $_SESSION['ACTUALPAGE']);
                exit;
            } else {
                $errorTexto = "Esta cuenta no esta verificada. Te hemos enviado un email";
            }
        } else {
            // Informamos al usuario que alguno de los dos campos es incorrecto
            $errorTexto = "Login incorrecto. Intentalo de nuevo!";
        }
    }
?>


<p style="text-align: left; font-size: 1.2em;"><?php echo $errorTexto ?></p>
<h1 style="text-align: left;">Login</h1>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']  ?>">
    <table >
        <tr>
            <td>
                <label for="user">Usuario</label>
            </td>
            <td>
                <input type="text" name="user">
            </td>
        </tr>
        <tr>
            <td>
                <label for="contra">Contraseña</label>
            </td>
            <td>
                <input type="password" name="contra">
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" name="loging" value="Login!">
            </td>
        </tr>
    </table>
</form>
<p>No tienes una cuenta? <a href="registro.php">Registrate!</a></p>

<?php 

    include("pie.php");

?>