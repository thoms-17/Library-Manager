<?php

namespace App\Controllers;

use App\Models\User;

class EmailVerificationController
{
    public function verify()
    {
        // Récupérer le token à partir de la requête (à ajuster selon votre logique)
        $token = $_GET['token'];

        // Vérifier le token et mettre à jour le statut de vérification dans la base de données
        $userModel = new User();
        $userModel->verifyEmailWithToken($token);

        // Rediriger l'utilisateur vers la page appropriée (par exemple, la page d'accueil)
        header('Location: /');
        exit();
    }
}