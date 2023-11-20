<main>
    <h1>Lista de Decks de <?php echo $user ?></h1>
    <section class="listaDecks">
        <?php 
            if (empty($listaDecks)) {
                echo"<h2>NO TIENES DECKS</h2>";
            } else {
                foreach ($listaDecks as $deck) {
                    echo"<article><a href='".base_url()."decks/verDeck/$deck->id"."'>";
                    echo"<h2>$deck->nombre</h2>";
                    echo "<p>Creacion: $deck->fechaCreacion</p>";
                    echo "</a></article>";
                }
            }
        ?>
    </section>
    <section>
        <?php echo anchor(base_url()."decks/crearDeck", "CREAR MAZO") ?>
    </section>
</main>