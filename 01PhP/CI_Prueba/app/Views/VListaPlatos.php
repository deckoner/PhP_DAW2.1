<?php 

echo "<table>
<tr>
    <td>Nombre</td>
    <td>Precio</td>
    <td>Repetidos</td>
    <td>Detalle</td>
</tr>";

foreach ($platos as $p) {
    echo "<tr>
            <td>$p->nombre</td>
            <td>$p->precio</td>
            <td>$p->repetidos</td>";
    echo '<td>'.anchor(site_url()."/verdetalle/".$p->idPlato, "ver detalle").'</td>
    </tr>';
}

echo "</table>";