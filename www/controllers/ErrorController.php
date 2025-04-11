<?php

namespace App\Controllers;

class ErrorController
{
    public function notFound()
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
}
