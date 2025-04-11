<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        // Bufferise la vue spécifique
        ob_start();
        require_once 'views/home.view.php';
        $content = ob_get_clean();

        // Appelle le layout global avec tout ce qu’il faut
        require_once 'views/layout.view.php';
    }
}
