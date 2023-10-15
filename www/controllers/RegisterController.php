<?php

namespace App\Controllers;

use App\Models\User;

class RegisterController
{

    private $content;

    public function index()
    {
        require_once 'views/layout.view.php';
        require_once 'views/register.view.php';
    }

    public function register()
    {
        // Vérifier si le formulaire a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $creation_date = date('Y-m-d');

            // Créer un nouvel utilisateur
            $user = new User();

            if ($user->userExists($username, $email)) {
                $errorMessage = "Cette adresse e-mail est déjà utilisé.";
            } else {
                $user->setUsername($username);
                $user->setEmail($email);
                $user->setPassword($password);
                $user->setCreationDate($creation_date);

                // Enregistrer l'utilisateur dans la base de données
                $user->save();

                // Redirection de l'utilisateur vers la page de connexion
                header('Location: /login');
                exit;
            }
        }
        // Afficher la vue register.view.php avec le formulaire d'inscription
        require_once 'views/register.view.php';
    }
}
