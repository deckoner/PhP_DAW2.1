<?php 
$valorLogin = "";
if (isset($_COOKIE['login'])) {
    $valorLogin = $_COOKIE['login'];
}

const PASS = "dw2";

if (isset($_POST['logear'])) {
    if ($_POST['contra'] == PASS) {
        setcookie("login", $_POST['login']). time()+180;
        header('location:02cena.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']  ?>">
        <table>
            <tr>
                <td colspan><p><?php echo $valorLogin ?></p></td>
            </tr>
            <tr>
                <td><label>Usuario</label></td>
                <td><input type="text" name="login"></td>
            </tr>
            <tr>
                <td><label>Contraseña</label></td>
                <td><input type="password" name="contra"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="logear"></td>
            </tr>
        </table>
    </form>
</body>
</html>