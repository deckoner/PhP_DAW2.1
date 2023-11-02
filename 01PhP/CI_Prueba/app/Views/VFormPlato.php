<?php

echo form_open(site_url().'/aniadePlato');

echo form_label("NOMBRE ");
echo form_input("nombre");
echo "<br>";

echo form_label("PRECIO ");
echo form_input("precio", 0, ['type'=>'number', 'min' => '10', 'max' => '500']);
echo "<br>";

echo form_label("FECHA ");
echo form_input(['name'=>'fecha', 'type'=>'date', 'value' => strFechaHoy()]);
echo "<br>";

echo form_submit("aniadePlato", "AÑADIR");

echo form_close();