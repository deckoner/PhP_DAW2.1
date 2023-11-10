<?php 
    // Extraemos el nombre de los colores
    $coloresNombres = array();
    $coloresNombres[null] = "Ninguno";

    foreach ($coloresLista as $color) {
        $coloresNombres[$color['id']] = $color['nombre'];
    }

    // Extraemos el nombre de los tipos
    $tiposCartaNombres = array();
    $tiposCartaNombres[null] = "Ninguno";

    foreach ($tiposCartaLista as $tipo) {
        $tiposCartaNombres[$tipo['id']] = $tipo['nombre'];
    }

    // Extraemos el nombre de los atributos
    $atributosNombres = array();
    $atributosNombres[null] = "Ninguno";

    foreach ($atributosLista as $atributo) {
        $atributosNombres[$atributo['id']] = $atributo['nombre'];
    }

    // Extraemos el nombre de los BTs
    $btNombres = array();
    $btNombres[null] = "Ninguno";

    foreach ($btsLista as $bt) {
        $btNombres[$bt['id']] = $bt['abreviatura'];
    }
?>

<main>
    <section class="PFiltros">
            <?php 
                echo form_open(site_url().'coleccion/logecoleccionarse');
                echo "<table>";

                    echo '<tr>
                        <td colspan="3">'.form_input("nombreCarta", "", 'class="barraBuscar" placeholder="Introduce el nombre de la carta"').'</td>
                    </tr>
                    <tr>
                        <td>'.form_label("Color 1 ").form_dropdown("colorUno", $coloresNombres, null).'</td>
                        <td>'.form_label("Color 2 ").form_dropdown("colorDos", $coloresNombres, null).'</td>
                        <td>'.form_label("Tipo de carta").form_dropdown("tipoCarta", $tiposCartaNombres, null).'</td>
                    </tr>
                    <tr>
                        <td>'.form_label("Atributo").form_dropdown("Atributo", $atributosNombres, null).'</td>
                        <td>'.form_label("bt").form_dropdown("bt", $btNombres, null).'</td>
                        <td>'.form_label("coste").form_dropdown("coste", $costesLista, null).'</td>
                    </tr>';
                echo "</table>";
                echo form_close();
            ?>
    </section>

    <section style="background-color: #303030bd; 
                    padding-bottom: 1em; 
                    padding-top: 1em;
                    border-radius: 1em;
                    margin-top: 0.5em;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
        <div class="coleccion">
            <?php 
                $contador = 0;

                foreach ($cartas as $c) {
                    $titulo = $c->numero_carta."<br>".$c->nombre;

                    if (is_null($c->color_dos)) {
                        echo '<article class="carta" style="border: solid 0.3em var(--'.$c->color_uno.'); 
                                                    background-color: var(--'.$c->color_uno.'-fondo)">
                            <h1>'.$titulo.'</h1>
                            <a href="'.site_url()."coleccion/carta/".$c->numero_carta.'"><img src="'.$c->url_imagen.'" alt="carta: '.$c->numero_carta.'" loading="lazy"></a>
                        </article>';
                    } else {
                        echo '<article class="carta" style="
                                border: solid 0.3em transparent;
                                border-radius: 2em;
                                background-image: linear-gradient(to right, var(--'.$c->color_uno.'-fondo), var(--'.$c->color_dos.'-fondo)), radial-gradient(circle at top left, var(--'.$c->color_uno.'),var(--'.$c->color_dos.'));
                                background-origin: border-box;
                                background-clip: content-box, border-box;">
                            <h1>'.$titulo.'</h1>
                            <a href="'.site_url()."coleccion/carta/".$c->numero_carta.'"><img src="'.$c->url_imagen.'" alt="carta: '.$c->numero_carta.'" loading="lazy"></a>
                        </article>';
                    }
                }
            ?>
        </div>
    </section>
</main>