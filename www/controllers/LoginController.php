<?php

namespace App\Controllers;

use App\Models\User;

class LoginController
{
    public function index()
    {
        $errorMessage = null;

        if (isset($_SESSION['login_error'])) {
            $errorMessage = $_SESSION['login_error'];
            unset($_SESSION['login_error']); // Effacer le message d'erreur de la session après l'avoir affiché
        }

        require_once 'views/layout.view.php';
        require_once 'views/login.view.php';
    }

    public function login()
    {
        // Récupérer les données du formulaire
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Instancier le modèle User
        $userModel = new User();

        // Vérifier l'authentification avec la méthode authenticate du modèle User
        if ($userModel->authenticate($username, $password)) {
            // Authentification réussie

            // Stocker l'ID de l'utilisateur dans la session
            $_SESSION['user_id'] = $userModel->getUserIdByUsername($username);

            // Rediriger l'utilisateur vers sa page de compte
            header('Location: /home');
            exit;
        } else {
            // Authentification échouée
            $_SESSION['login_error'] = "Nom d'utilisateur ou mot de passe incorrect.";
            // Rediriger l'utilisateur vers la page de connexion avec un message d'erreur
            header('Location: /login');
            exit;
        }
    }
}
