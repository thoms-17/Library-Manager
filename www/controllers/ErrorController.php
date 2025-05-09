<?php

namespace App\Controllers;

class ErrorController
{
    public static function badRequest(string $reason = '')
    {
        http_response_code(400);
        $pageTitle = "Error 400";

        // Passe la raison à la vue pour affichage conditionnel
        ob_start();
        require 'views/errors/400.view.php';
        $content = ob_get_clean();

        require 'views/layout.view.php';
        exit;
    }

    public static function forbidden(string $message = '')
    {
        http_response_code(403);
        $pageTitle = "Erreur 403 - Accès interdit";

        ob_start();
        require 'views/errors/403.view.php';
        $content = ob_get_clean();

        require 'views/layout.view.php';
        exit;
    }


    static function notFound()
    {
        // Spécifie le code de réponse 404
        http_response_code(404);

        $pageTitle = "Error 404";

        ob_start();
        require_once 'views/errors/404.view.php';
        $content = ob_get_clean();

        require_once 'views/layout.view.php';

        exit;
    }

    public static function internalServerError(string $details = '')
    {
        http_response_code(500);
        $pageTitle = "Erreur 500";

        ob_start();
        require 'views/errors/500.view.php';
        $content = ob_get_clean();

        require 'views/layout.view.php';
        exit;
    }
}
