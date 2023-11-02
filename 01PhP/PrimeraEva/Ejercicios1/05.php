<?php
    function obtenerFavoritas($nombrePelicula, $correspondencias) {
        $contador = 0;

        foreach ($correspondencias as $persona => $peliculasFavoritas) {
            if (in_array($nombrePelicula, $peliculasFavoritas)) {
                $contador++;
            }

            echo "Persona: $persona<br>";

            // Mostramos 2 películas favoritas al azar de la persona
            $peliculasAleatorias = array_rand($peliculasFavoritas, 2);
            foreach ($peliculasAleatorias as $indice) {
                echo "Película favorita: " . $peliculasFavoritas[$indice] . "<br>";
            }

            echo "<br>";
        }

        return $contador; // Devolvemos la cantidad de personas con la película favorita
    }

    // Ejemplo de uso con arrays asociativos
    $correspondencias = array(
        "Paco" => array("Thor 1", "Spiderman 3", "El castillo ambulante"),
        "Pepe" => array("El viaje de chijiro", "Erase una vez", "No se que poner 2: el retorno de la ignoracia"),
        "Pedro" => array("Thor 1", "El castillo ambulante", "Alguna de marvel: la pelicula"),
        "Pablo" => array("No se que poner 2: el retorno de la ignoracia", "El castillo ambulante", "Erase una vez"),
        "Parle" => array("Spiderman 3", "El castillo ambulante", "El viaje de chijiro"),
    );

    $nombrePelicula = "Thor 1";
    $personasConPelicula = obtenerFavoritas($nombrePelicula, $correspondencias);

    echo "La película '$nombrePelicula' es favorita de $personasConPelicula personas.";
?>