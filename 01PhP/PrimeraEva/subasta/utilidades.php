<?php 

    function generarCadena($numero) {
        $caracteresPermitidos = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $cadenaAleatoria = substr(str_shuffle($caracteresPermitidos), 0, $numero);

        return $cadenaAleatoria;
    }

    function enviarEmail($emailDestino, $email, $cadena) {

        $mensaje = '<!DOCTYPE html>
                <html lang="en" xmlns="https://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
                    <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width,initial-scale=1">
                        <meta name="x-apple-disable-message-reformatting">
                        <title></title>    
                        </head>
                        <body>
                            <h1>Subastas DEWS</h1><br>
                            <p>Para poder verificar su cuenta por favor haga click en el siguiente enlace:</p><br>
                            <a href="http://localhost/01PhP/subasta/verificacion.php?cadena='.urlencode($cadena).'&email='.urlencode($emailDestino).'">Verificar cuenta</a>
                        </body>
                    </html>';

                    
        mail($emailDestino, "Verificación de cuenta", $mensaje, "From:".$email);      
    }

    function convertirFecha($fecha) {
        $ahora = new DateTime(); // Fecha y hora actual
        $fechaObj = new DateTime($fecha); // Fecha y hora proporcionada

        // Diferencia entre las fechas
        $diferencia = $ahora->diff($fechaObj);

        // Crear un array para almacenar las partes de la diferencia
        $partes = array();

        // Agregar meses si es mayor que 0
        if ($diferencia->m > 0) {
            $partes[] = $diferencia->m . " Mes" . ($diferencia->m > 1 ? "es" : "");
        }

        // Agregar días si es mayor que 0
        if ($diferencia->d > 0) {
            $partes[] = $diferencia->d . " Día" . ($diferencia->d > 1 ? "s" : "");
        }

        // Agregar horas si es mayor que 0
        if ($diferencia->h > 0) {
            $partes[] = $diferencia->h . " Hora" . ($diferencia->h > 1 ? "s" : "");
        }

        // Combinar las partes en una cadena
        $resultado = implode(" ", $partes);

        return $resultado;
    }

    function enviarEmailPubli($emailDestino, $email, $itemID) {

        $headers = 'From: '.$email.' '."\r\n".
                    'Content-type: text/html; charset=utf-8';

        $mensaje = '
            <h1>Subastas DEWS</h1><br>
            <p>Mira este asombroso articulo, puede ser tuyo!!!</p><br>
            <a href="http://localhost/01PhP/subasta/itemdetalles.php?idItem='.urlencode($itemID).'">Objeto impresionante en venta</a>';

                    
        mail($emailDestino, "Objeto impresionante", $mensaje, $headers);
    }

    function escribirEnArchivoPublicidad($descripcion, $web) {
        // Obtener la fecha actual en el formato "dia-mes-año"
        $fecha = date('d-m-Y');
    
        // Nombre del archivo
        $nombreArchivo = "publicidad/publicidadWeb_" . $fecha . ".txt";
    
        // Intentar abrir el archivo en modo escritura (o crearlo si no existe)
        $archivo = fopen($nombreArchivo, 'a');
    
        if ($archivo) {
            // Escribir la descripción en el archivo
            fwrite($archivo, $web . "-" . $descripcion . PHP_EOL);
    
            // Cerrar el archivo
            fclose($archivo);
        }
    }
?>