<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>public/favicon.ico">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/style.css">
    <title>La Posada Del Tamer: Login</title>
</head>
<body>
    <main>
        <section class="loginSection">
            <?php 
                if (isset($erroresTexto)) {
                    echo '<p style="color: red;">'.$erroresTexto.'</p>';
                }

                echo form_open(site_url().'login/logearse', ['class' => 'login']);

                echo '<h1 class="titulo">The Tamer Tavern</h1>';

                echo form_label("Usuario");
                echo form_input("usuario", "", ['min' => '10', 'max' => '500']);
                
                echo form_label("contraseña");
                echo form_password('contra', '', 'class="form-control"');

                echo form_submit("logearse", "Login");
                echo form_close();
                
                echo "<p>Si no te has registrado lo puedes hacer ".anchor(site_url()."registro","aqui")."</p>";
            ?>
        </section>
    </main>
</body>
</html>