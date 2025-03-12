<?php

namespace App\Middlewares;

use App\Controllers\ErrorController;

class RequestMethodMiddleware
{
    public static function ensureMethod($method)
    {
        $requestedUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Exceptions : Définir les comportements spécifiques pour certaines routes
        if ($requestedUri === '/delete-account-success') {
            // Permet l'accès uniquement si la session contient 'account_deleted'
            if (isset($_SESSION['account_deleted'])) {
                unset($_SESSION['account_deleted']); // Supprime la variable pour empêcher les accès futurs
                return;
            }
        }

        // Vérifier la méthode HTTP
        if ($_SERVER["REQUEST_METHOD"] !== strtoupper($method)) {
            // Appeler la méthode 404 du contrôleur des erreurs
            $errorController = new ErrorController();
            $errorController->notFound();
            exit;
        }
    }
}