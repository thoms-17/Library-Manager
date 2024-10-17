<?php

namespace App\Middlewares;

class AuthMiddleware
{
    // Vérifie si l'utilisateur est authentifié
    public static function checkAuth()
    {
        if (!isset($_SESSION['user_id'])) {
            // Rediriger vers la page de connexion si non authentifié
            header('Location: /login');
            exit;
        }
    }

    // Vérifie si l'utilisateur est admin
    public static function checkAdmin()
    {
        self::checkAuth(); // Vérifier si l'utilisateur est connecté
        if ($_SESSION['role'] !== 'admin') {
            // Rediriger vers une autre page si l'utilisateur n'est pas admin
            header('Location: /account');
            exit;
        }
    }

    // Vérifie si l'utilisateur a un rôle spécifique
    public static function checkRole($role)
    {
        self::checkAuth(); // Vérifier si l'utilisateur est connecté
        if ($_SESSION['role'] !== $role) {
            // Rediriger vers une autre page si l'utilisateur n'a pas le bon rôle
            header('Location: /unauthorized');
            exit;
        }
    }
}
