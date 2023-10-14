<?php

namespace App\Controllers;

class LogoutController
{
    public function index()
    {
        session_destroy();

        // Rediriger l'utilisateur vers la page d'accueil
        header('Location: /');
        exit;
    }
}
