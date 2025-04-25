<?php

namespace App\Controllers\User;

class LogoutController
{
    public function logout()
{
    // Vérification d’une session active
    if (isset($_SESSION['user_id'])) {
        session_unset();
        session_destroy();
    }

    // Redirection vers la page d'accueil ou de connexion
    header('Location: /home');
    exit;
}

}
