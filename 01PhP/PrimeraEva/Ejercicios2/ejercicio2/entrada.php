<?php 
    if (isset($_POST['submit'])) {
        $ruta = "users/".$_POST["user"];

        // Comprobamos si la carpeta existe, si no existe creamos una
        if (!file_exists($ruta)) {
            // Creamos la carpeta
            mkdir($ruta, 0777, true);

        } else {
            // Obtenemos la lista de archivos en el directorio
            $archivos = glob($ruta . '/*');
            
            // Iteramos sobre la lista y eliminamos cada archivo
            foreach ($archivos as $archivo) {
                if (is_file($archivo)) {
                    unlink($archivo);
                }
            }
        }

        // Redirige a pag1.php
        header("Location: pag1.php?user=".$_POST["user"]);
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2: Entrada</title>
</head>
<body>
    <main>
        <div>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <input type="text" name="user">
                <br>
                <input type="submit" name="submit" value="ENTRAR">
            </form>
        </div>
    </main>
</body>
</html>