<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>public/favicon.ico">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/style.css">
    <title>La Posada Del Tamer: registro</title>
</head>
<body>
    <main>
        <section class="loginSection">
            <?php 
                if (isset($erroresTexto)) {
                    echo '<p style="color: red;">'.$erroresTexto.'</p>';
                }

                echo form_open(site_url().'registro/registrarse', ['class' => 'login']);

                echo '<h1 class="titulo">The Tamer Tavern</h1>';

                echo form_label("Usuario");
                echo form_input("usuario", $user, ['min' => '2', 'max' => '50']);
                
                echo form_label("Contraseña");
                echo form_password('contra', "", 'class="form-control"');

                echo form_label("Email");
                echo form_input("email", $email, ['max' => '120']);

                echo form_submit("registrarse", "Registrarse");
                echo form_close();
            ?>
        </section>
    </main>
</body>
</html>