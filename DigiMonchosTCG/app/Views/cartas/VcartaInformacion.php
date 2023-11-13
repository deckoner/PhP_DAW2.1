<main>
    <articulo class="articuloCartaInfo">
        <?php 
            if (is_null($carta)) {
                echo "<h1>La carta no existe</h1>";
            } else {
                $nombreCarta = $carta->numero_carta.": ".$carta->nombre_carta;
        ?>
            <h1><?php echo $nombreCarta ?></h1>
            <img src="<?php echo $carta->url_imagen ?>" alt="Carta: <?php echo $carta->numero_carta ?>">

            <section class="seccionAtri">
                <?php
                    if (!is_null($carta->color_uno)) {
                        if (!is_null($carta->color_dos)) {
                            echo "<article>
                                <h3>Colores</h3>
                                <p>$carta->color_uno / $carta->color_dos</p>
                            </article>";
                        } else {
                            echo "<article>
                                <h3>Color</h3>
                                <p>$carta->color_uno</p>
                            </article>";
                        }
                    }

                    if (!is_null($carta->tipo_carta)) {
                        echo "<article>
                            <h3>Tipo De Carta</h3>
                            <p>$carta->tipo_carta</p>
                        </article>";
                    }

                    if (!is_null($carta->rareza)) {
                        echo "<article>
                            <h3>Rareza</h3>
                            <p>$carta->rareza</p>
                        </article>";
                    }

                    if (!is_null($carta->coste)) {
                        echo "<article>
                            <h3>Coste</h3>
                            <p>$carta->coste</p>
                        </article>";
                    }

                    if (!is_null($carta->digiEvoUno)) {
                        if (!is_null($carta->digiEvoDos)) {
                            echo "<article>
                                <h3>Coste Digievolución</h3>
                                <p>$carta->digiEvoUno / $carta->digiEvoDos</p>
                            </article>";
                        } else {
                            echo "<article>
                                <h3>Coste de Digievolución</h3>
                                <p>$carta->digiEvoUno</p>
                            </article>";
                        }
                    }

                    if (!is_null($carta->tipo) and !is_null($carta->atributo)) {
                        echo "<article>
                            <h3>Tipo/Atributo</h3>
                            <p>$carta->tipo / $carta->atributo</p>
                        </article>";
                    } else {
                        echo "<article>
                            <h3>Tipo</h3>
                            <p>$carta->tipo</p>
                        </article>";
                    }

                    // !NOTA IMPORTANTE: Toda carta tiene una etapa pero algunas pueden ser de etapa null
                    // !No confundir con un null de verdad por algun problema de programacion.
                    if (!is_null($carta->etapa)) {
                        echo "<article>
                            <h3>Etapa</h3>
                            <p>$carta->etapa</p>
                        </article>";
                    }

                    if (!is_null($carta->bt_nombre)) {
                        echo "<article>
                            <h3>BT</h3>
                            <p>$carta->bt_nombre</p>
                        </article>";
                    }
                ?>
            </section>

            <section class="seccionEfect">
                <?php
                    if (!is_null($carta->efecto)) {
                        echo "<article>
                                <h2>EFECTO</h2>
                                <p>$carta->efecto</p>
                            </article>";
                    }

                    if (!is_null($carta->digievolucion_efecto)) {
                    echo "<article>
                            <h2>EFECTO DE DIGIEVOLUCION</h2>
                            <p>$carta->digievolucion_efecto</p>
                        </article>";
                    }

                    if (!is_null($carta->efecto_seguridad)) {
                    echo "<article>
                            <h2>EFECTO DE SEGURIDAD</h2>
                            <p>$carta->efecto_seguridad</p>
                        </article>";
                    }
                ?>
            </section>

        <?php 
            }
        ?>
    </articulo>
</main>