<?php

namespace App\Controllers\User;

class AccountController
{
    public function index()
    {
        if (isset($_SESSION['user_id'])) {
            // L'utilisateur est connecté
            $delete_error_message = null;

        if (isset($_SESSION['delete_account_error'])) {
            $delete_error_message = $_SESSION['delete_account_error'];
            unset($_SESSION['delete_account_error']); // Effacer le message d'erreur de la session après l'avoir affiché
        }
            require_once 'views/layout.view.php';
            require_once 'views/user/user_account.view.php';

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
