<?php 
    // Extraemos el nombre de los colores
    $coloresNombres = array();

    foreach ($coloresLista as $color) {
        $coloresNombres[$color['id']] = $color['nombre'];
    }

    // Extraemos el nombre de los tipos
    $tiposCartaNombres = array();

    foreach ($tiposCartaLista as $tipo) {
        $tiposCartaNombres[$tipo['id']] = $tipo['nombre'];
    }

    // Extraemos el nombre de los atributos
    $atributosNombres = array();

    foreach ($atributosLista as $atributo) {
        $atributosNombres[$atributo['id']] = $atributo['nombre'];
    }

    // Extraemos el nombre de los Etapas
    $etapasNombres = array();

    foreach ($etapasLista as $etapa) {
        $etapasNombres[$etapa['id']] = $etapa['nombre'];
    }

    // Extraemos el nombre de los Rarezas
    $rarezasNombres = array();

    foreach ($rarezasLista as $rareza) {
        $rarezasNombres[$rareza['id']] = $rareza['nombre'];
    }

    // Extraemos el nombre de los Tipos
    $tiposNombres = array();

    foreach ($tiposLista as $tipo) {
        $tiposNombres[$tipo['id']] = $tipo['nombre'];
    }

    // Extraemos el nombre de los Tipos carta
    $tiposCardNombres = array();

    foreach ($tiposCartaLista as $tipoCard) {
        $tiposCardNombres[$tipoCard['id']] = $tipoCard['nombre'];
    }
?>

<main>
    <?php 
        if (isset($aviso)) {
            echo "<section>
                <p>$aviso</p>
            </section>";
        }
    ?>
    <section>
        <h2>Introducir nuevo Atributo</h2>
        <?php 
            echo form_open(site_url().'admin');

            echo form_hidden('nombreTabla', 'atributos');

            echo form_dropdown("colorUno", $atributosNombres, 1);

            echo form_label("Atributo");
            echo form_input("valor");

            echo form_submit("tabla", "Subir Atributo");

            echo form_close();
        ?>
    </section>

    <section>
        <h2>Introducir nuevo Color</h2>
        <?php 
            echo form_open(site_url().'admin');

            echo form_hidden('nombreTabla', 'colores');

            echo form_dropdown("colorUno", $coloresNombres, 1);

            echo form_label("Color");
            echo form_input("valor");

            echo form_submit("tabla", "Subir Color");

            echo form_close();
        ?>
    </section>

    <section>
        <h2>Introducir nuevo Etapas</h2>
        <?php 
            echo form_open(site_url().'admin');

            echo form_hidden('nombreTabla', 'etapas');

            echo form_dropdown("colorUno", $etapasNombres, 1);

            echo form_label("Etapa");
            echo form_input("valor");

            echo form_submit("tabla", "Subir Etapa");

            echo form_close();
        ?>
    </section>

    <section>
        <h2>Introducir nuevo Rareza</h2>
        <?php 
            echo form_open(site_url().'admin');

            echo form_hidden('nombreTabla', 'rarezas');

            echo form_dropdown("colorUno", $rarezasNombres, 1);

            echo form_label("Rareza");
            echo form_input("valor");

            echo form_submit("tabla", "Subir Rareza");

            echo form_close();
        ?>
    </section>

    <section>
        <h2>Introducir nuevo Tipo</h2>
        <?php 
            echo form_open(site_url().'admin');

            echo form_hidden('nombreTabla', 'tipos');

            echo form_dropdown("colorUno", $tiposNombres, 1);

            echo form_label("Tipo");
            echo form_input("valor");

            echo form_submit("tabla", "Subir Tipo");

            echo form_close();
        ?>
    </section>

    <section>
        <h2>Introducir nuevo Tipo De Carta</h2>
        <?php 
            echo form_open(site_url().'admin');

            echo form_hidden('nombreTabla', 'tiposcarta');

            echo form_dropdown("colorUno", $tiposCardNombres, 1);

            echo form_label("Tipo De Carta");
            echo form_input("valor");

            echo form_submit("tabla", "Subir Tipo De Carta");

            echo form_close();
        ?>
    </section>

    <section style="margin-bottom: 0.5em">
        <h1>Subir Carta</h1>
        <p>No me daba tiempo a hacer el menu pero en el modelo esta la funcion para subir una carta al servidor</p>
    </section>
</main>