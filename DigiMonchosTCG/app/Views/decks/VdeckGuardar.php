<main>
    <?php 
        if(isset($errorDeck)) {
            echo "<section>
                <p style='color: var(--rojo);'>$errorDeck</p>
            </section>";
        }
    ?>
    <section>
        <?php 
            echo form_open(site_url().'decks/guardarDeck');

            echo form_label("Nombre Deck");
            echo form_input("nombreDeck", "", ['min' => '5', 'max' => '500']);

            echo form_submit("crearDeck", "Crear Deck!");

            echo form_close();
        ?>
    </section>
</main>