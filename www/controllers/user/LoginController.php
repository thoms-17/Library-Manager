<?php

namespace App\Controllers\User;

use App\Models\User;

class LoginController
{
    public function index()
    {
        // Vérifiez si l'utilisateur est déjà connecté
        if (isset($_SESSION['user_id'])) {
            // Utilisateur déjà connecté, redirigez-le vers la page de compte
            header('Location: /account');
            exit;
        }

        $errorMessage = null;

        if (isset($_SESSION['login_error'])) {
            $errorMessage = $_SESSION['login_error'];
            unset($_SESSION['login_error']); // Effacer le message d'erreur de la session après l'avoir affiché
        }

        require_once 'views/layout.view.php';
        require_once 'views/user/login.view.php';
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
            $userData = $userModel->getUserDataByUsername($username);
            $_SESSION['user_id'] = $userData['id'];
            $_SESSION['role'] = $userData['role'];
            $_SESSION['username'] = $userData['username'];
            $_SESSION['email'] = $userData['email'];
            $_SESSION['creation_date'] = $userData['creation_date'];            

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
        // Afficher la vue register.view.php avec le formulaire d'inscription
        require_once 'views/layout.view.php';
        require_once 'views/user/login.view.php';
    }
}
