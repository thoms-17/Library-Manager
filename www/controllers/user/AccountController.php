<?php

namespace App\Controllers\User;

use App\Middlewares\AuthMiddleware;

class AccountController
{
    public function index()
    {
        // Vérifier si l'utilisateur est connecté
        AuthMiddleware::checkAuth();

        // L'utilisateur est connecté
        $delete_error_message = null;

        if (isset($_SESSION['delete_account_error'])) {
            $delete_error_message = $_SESSION['delete_account_error'];
            unset($_SESSION['delete_account_error']); // Effacer le message d'erreur de la session après l'avoir affiché
        }

        $pageTitle = "Mon compte";
         
        require_once 'views/layout.view.php';
        require_once 'views/user/user_account.view.php';

        // Charger l'image de profil (si elle existe)
        $profileImage = null;
        if (!empty($userData['profile_image'])) {
            $profileImage = base64_encode($userData['profile_image']);
        }
    }
}
