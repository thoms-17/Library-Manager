<?php

require_once 'Autoloader.php';
require_once 'router.php';

use App\Autoloader;
use App\Controllers\ErrorController;

Autoloader::register();

// Nettoyer l'URL pour éviter les paramètres supplémentaires (comme les query strings)
$action = strtok($_SERVER['REQUEST_URI'], '?');

// Gestion d'erreurs pour une meilleure détection des exceptions
try {
    route($action);
} catch (Exception $e) {
    ErrorController::internalServerError($e->getMessage());
}
