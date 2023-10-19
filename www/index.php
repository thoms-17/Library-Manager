<?php

require_once 'Autoloader.php';
require_once 'router.php';

use App\Autoloader;

Autoloader::register();

$action = $_SERVER['REQUEST_URI'];

// Appelez la fonction route() pour gérer la route actuelle
route($action);