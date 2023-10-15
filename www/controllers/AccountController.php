<?php

namespace App\Controllers;

use App\Models\User;

class AccountController
{
    public function index()
    {
        if (isset($_SESSION['user_id'])) {
            // L'utilisateur est connecté
            // Vous pouvez maintenant obtenir les informations de l'utilisateur depuis la base de données en utilisant son ID
            $userModel = new User();
            $userData = $userModel->getUserDataById($_SESSION['user_id']);

            // Chargez la vue Mon Compte avec les données de l'utilisateur
            require_once 'views/layout.view.php';
            require_once 'views/user_account.view.php';
            
        } else {
            // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            header('Location: /login');
        }
    }
}
