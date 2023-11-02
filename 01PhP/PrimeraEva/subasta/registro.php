<?php 
    include("cabecera.php");
    $errorTexto = "";

    if(isset($_POST['registrate'])) {
        $correcto = true;

        // * Iniciamos el bloque de comprobaciones
        if (empty($_POST['user'])) {
            $errorTexto .= "El nombre de usuario no puede estar vacio<br>";
            $correcto = false;
        } else {
            if (!comprobarUserName($db, $_POST['user'])) {
                $errorTexto .= "Nombre de usuario no disponible<br>";
                $correcto = false;
            }
        }

        if (empty($_POST['nombreCom'])) {
            $errorTexto .= "El nombre no puede estar vacio<br>";
            $correcto = false;
        }

        if (empty($_POST['contra']) && empty($_POST['contraDos'])) {
            $errorTexto .= "Debes establecer las contraseñas<br>";
            $correcto = false;
        } else {
            if ($_POST['contra']!= $_POST['contraDos']) {
                $errorTexto .= "Las contraseñas deben de coincidir<br>";
                $correcto = false;
            }
        }

        if (empty($_POST['email'])) {
            $errorTexto .= "Debes introducir un email<br>";
            $correcto = false;
        }

        if ($correcto == true) {
            // Generamos una cadena aleatoria de 16 caracteres
            $cadena = generarCadena(16);

            insertarUsuario($db, $_POST['user'], 
                            $_POST['nombreCom'], password_hash($_POST['contra'], PASSWORD_BCRYPT), 
                            $_POST['email'], $cadena);

            
            enviarEmail($_POST['email'], $emailFrom, urlencode($cadena));
        }
    }
?>

<p style="text-align: left; font-size: 1.2em;"><?php echo $errorTexto ?></p>
<h1 style="text-align: left;">REGISTRO</h1>
<p>Para registrarte en SUBASTAS DEWS, rellena el siguiente formulario.</p>
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
                <label for="nombreCom">Nombre completo</label>
            </td>
            <td>
                <input type="text" name="nombreCom">
            </td>
        </tr>
        <tr>
            <td>
                <label for="contra">Password</label>
            </td>
            <td>
                <input type="password" name="contra">
            </td>
        </tr>
        <tr>
            <td>
                <label for="contraDos">Password</label>
            </td>
            <td>
                <input type="password" name="contraDos">
            </td>
        </tr>
        <tr>
            <td>
                <label for="email">Email</label>
            </td>
            <td>
                <input type="text" name="email">
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" name="registrate" value="Registrate">
            </td>
        </tr>
    </table>
</form>


<?php 
    include("pie.php");
?>