<?php

namespace App\Controllers;

class ErrorController
{
    public function notFound()
    {
        // Spécifie le code de réponse 404
        http_response_code(404);

        $pageTitle = "Error 404"; 

        // Inclut la vue de la page 404
        require_once 'views/layout.view.php';
        require_once 'views/errors/404.view.php';
        exit;
    }
}
