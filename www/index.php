<?php

require_once 'Autoloader.php';
require_once 'router.php';

use App\Autoloader;

Autoloader::register();

// Nettoyer l'URL pour éviter les paramètres supplémentaires (comme les query strings)
$action = strtok($_SERVER['REQUEST_URI'], '?');

// Gestion d'erreurs pour une meilleure détection des exceptions
try {
    route($action);
} catch (Exception $e) {
    http_response_code(500);
    echo 'Erreur interne du serveur : ' . $e->getMessage();
}
