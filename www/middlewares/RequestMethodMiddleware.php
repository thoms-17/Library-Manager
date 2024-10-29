<?php

namespace App\Middlewares;

use App\Controllers\ErrorController;

class RequestMethodMiddleware
{
    public static function ensureMethod($method)
    {
        $requestedUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Permet l'accès à /delete-account-success uniquement si account_deleted est définie
        if ($requestedUri === '/delete-account-success' && isset($_SESSION['account_deleted'])) {
            unset($_SESSION['account_deleted']);  // Supprime la variable pour empêcher les accès futurs
            return;
        }

        if ($_SERVER["REQUEST_METHOD"] !== strtoupper($method)) {
            $errorController = new ErrorController();
            $errorController->notFound();
            exit;
        }
    }
}
