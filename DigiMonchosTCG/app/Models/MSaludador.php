<?php
namespace App\Models;

use CodeIgniter\Model;

class MSaludador extends Model {
    public function saludoSegunIdioma($idioma) {
        switch ($idioma) {
            case 'es':
                $saludar = "A huevo!!!";
                break;

            case 'uk':
                $saludar = "Hi!!!";
                break;

            case 'eus':
                $saludar = "Kaixo!!!";
                break;
            
            
            default:
                $saludar = "No se que idioma es pero holi";
                break;
        }

        return $saludar;
    }
}