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
            // Supposons que vous ayez un modèle User pour cela
            $userModel = new User();
            $userData = $userModel->getUserDataById($_SESSION['user_id']); // Remplacez getUserDataById par la méthode réelle de récupération des données de l'utilisateur

            // Chargez la vue Mon Compte avec les données de l'utilisateur
            ob_start();
            require_once 'views/user_account.view.php'; // Assurez-vous que ce fichier view existe
            $content = ob_get_clean();
            require_once 'views/layout.view.php';
        } else {
            // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            header('Location: /login');
        }
    }
}
