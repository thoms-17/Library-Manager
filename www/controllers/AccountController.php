<?php

namespace App\Controllers;

class AccountController
{
    public function index()
    {
        if (isset($_SESSION['user_id'])) {
            // L'utilisateur est connecté
            require_once 'views/layout.view.php';
            require_once 'views/user_account.view.php';

            // Charger l'image de profil (si elle existe)
            $profileImage = null;
            if (!empty($userData['profile_image'])) {
                $profileImage = base64_encode($userData['profile_image']);
            }
        } else {
            // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            header('Location: /login');
        }
    }
}
