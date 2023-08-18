<?php

namespace App\Controllers;

use App\Database;

class HomeController
{
    public function index()
    {
        // Connexion à la base de données
        $pdo = Database::connect();

        if ($pdo) {
            // La connexion a réussi, vous pouvez maintenant exécuter des requêtes sur la base de données

            // Charger la vue home.view.php
            ob_start();
            require_once 'views/home.view.php';
            $content = ob_get_clean();

            require_once 'views/layout.view.php';
        }
    }
}
