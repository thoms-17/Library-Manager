<?php

namespace App\Middlewares;

use App\Controllers\ErrorController;

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
            // Utiliser la page 404 pour masquer l'accès non autorisé
            (new ErrorController())->notFound();
            exit;
        }
    }

    // Vérifie si l'utilisateur a un rôle spécifique
    public static function checkRole($role)
    {
        self::checkAuth(); // Vérifier si l'utilisateur est connecté
        if ($_SESSION['role'] !== $role) {
            // Masquer les pages non accessibles pour un rôle spécifique
            (new ErrorController())->notFound();
            exit;
        }
    }

    // Redirige vers la page d'accueil si l'utilisateur est déjà connecté
    public static function redirectIfAuthenticated()
    {
        if (isset($_SESSION['user_id'])) {
            // Rediriger vers la page d'accueil si déjà connecté
            header('Location: /account');
            exit;
        }
    }
}
