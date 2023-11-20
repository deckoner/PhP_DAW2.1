<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>public/favicon.ico">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/style.css">
    <title>La Posada Del Tamer: <?php echo $tituloPagina ?></title>
</head>
<body>
    <header>
        <h1 class="titulo"><a href="<?php echo base_url();?>">The Tamer Tavern</a></h1>
        <nav>
            <a href="<?php echo base_url();?>">Inicio</a>
            <a href="<?php echo base_url();?>coleccion">Coleccion</a>
            <a href="<?php echo base_url();?>decks">Decks</a>
            <a href="<?php echo base_url();?>comunidad">Decks de la comunidad</a>
            <?php 
                if ($rol === "ADMIN") {
                    echo anchor(base_url()."admin", "Zona Admin");
                }
            ?>
            <a href="<?php echo base_url()?>logout">logout</a>
        </nav>
    </header>