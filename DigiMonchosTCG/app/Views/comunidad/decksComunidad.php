<main>
    <h1>Decks De La Comunidad</h1>

    <section>
        <table>
            <tr>
                <td>Titulo Deck</td>
                <td>Autor</td>
                <td></td>
            </tr>
            <?php 
                foreach ($listaDecks as $deck) {
                    $link = anchor(base_url()."decks/verDeck/$deck->id", "Ver Link");
                    echo "<tr>
                        <td class='titulo-deck'>$deck->nombre<br><p>Creacion: $deck->fechaCreacion</p></td>
                        <td>$deck->autor</td>
                        <td>$link</td>
                    </tr>";
                }
            ?>
        </table>
    </section>
</main>