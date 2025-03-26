<?php

namespace App\Controllers\User;

use App\Models\User;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\RequestMethodMiddleware;

class LoginController
{
    public function index()
    {
        // Vérifiez si l'utilisateur est déjà connecté
        AuthMiddleware::redirectIfAuthenticated();

        $errorMessage = null;

        if (isset($_SESSION['login_error'])) {
            $errorMessage = $_SESSION['login_error'];
            unset($_SESSION['login_error']); // Effacer le message d'erreur de la session après l'avoir affiché
        }

        $pageTitle = "Connexion";

        require_once 'views/layout.view.php';
        require_once 'views/user/login.view.php';
    }

    public function login()
    {
        // Vérifie que la méthode de requête est POST
        RequestMethodMiddleware::ensureMethod('POST');

        // Vérifier que les champs sont bien remplis
        if (empty($_POST['username']) || empty($_POST['password'])) {
            $_SESSION['login_error'] = "Veuillez remplir tous les champs.";
            header('Location: /login');
            exit;
        }

        // Récupérer les données du formulaire
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Instancier le modèle User
        $userModel = new User();

        // Vérifier si l'utilisateur existe et si le mot de passe est correct
        if (!$userModel->authenticate($username, $password)) {
            $_SESSION['login_error'] = "Nom d'utilisateur ou mot de passe incorrect.";
            header('Location: /login');
            exit;
        }

        // Récupérer les informations de l'utilisateur
        $userData = $userModel->getUserDataByUsername($username);

        // Vérifier si les données utilisateur existent
        if (!$userData || empty($userData['id'])) {
            $_SESSION['login_error'] = "Nom d'utilisateur ou mot de passe incorrect.";
            header('Location: /login');
            exit;
        }

        // Stocker uniquement l'ID utilisateur en session
        $_SESSION['user_id'] = $userData['id'];

        // Rediriger l'utilisateur vers la page d'accueil
        header('Location: /home');
        exit;
    }
}
