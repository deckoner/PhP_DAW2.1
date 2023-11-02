<?php
    $sesion = session();
    $platoNoIngredientes = $sesion->get('platoNoIngredientes');
    
    echo "<h2>Añade los ingredientes que gustes</h2>";

    echo "<table border='1'>";
    foreach($platoNoIngredientes as $ingrediente){
        echo form_open(site_url().'/anadieQuitaIngrediente');
        echo form_hidden('ingrediente',$ingrediente->idIngrediente);
            echo '<tr>
                <td>'.$ingrediente->nombre.'</td>
                <td>'.form_submit('submitAnadirIngrediente', 'AÑADIR').'</td>
                <td>'.form_submit('submitQuitarIngrediente', 'ELIMINAR').'</td>
            </tr>';
        echo form_close();
    }
    echo "</table>";

    if (count($sesion->get('nuevosIgredientes'))) {
        echo anchor(site_url().'/grabarNuevosIngredientes', "Grabar Ingredientes");
    }