<main>
    <section>
        <h2><?php echo $deck->nombre ?></h2>
        <p>Autor: <?php echo $userAuthor ?></p>
        <p>Fecha de creacion: <?php echo $deck->fechaCreacion ?></p>
    </section>

    <?php
        if ($idUser == $deck->idUser) {
            echo "<section>".
                anchor(base_url()."decks/eliminarDeck/".$deck->id, "Eliminar Deck")
            ."</section>";
         }
    ?>

    <section class="coleccion">
        <?php 
            foreach ($cartasDeck as $c) {
                echo "<article>
                    <img class='cardIMG' src='$c->url_imagen' alt='$c->numero_carta' loading='lazy'>
                </article>";
            }
        ?>
    </section>
</main>