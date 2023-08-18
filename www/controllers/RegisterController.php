<?php

namespace App\Controllers;

use App\Models\User;

class RegisterController
{
    public function index()
    {
        // Afficher la vue register.view.php avec le formulaire d'inscription
        ob_start();
        require_once 'views/register.view.php';
        $content = ob_get_clean();

        require_once 'views/layout.view.php';
    }

    public function register()
    {
        // Vérifier si le formulaire a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Créer un nouvel utilisateur
            $user = new User();
            $user->setUsername($username);
            $user->setEmail($email);
            $user->setPassword($password);

            // Enregistrer l'utilisateur dans la base de données
            $user->save();

            // Redirection de l'utilisateur vers la page de connexion
            header('Location: /login');
            exit;
        }

        // Afficher la vue register.view.php avec le formulaire d'inscription
        require 'views/register.view.php';
    }
}
