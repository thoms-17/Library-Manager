<?php

require_once 'Autoloader.php';

use App\Autoloader;
use App\Controllers\HomeController;
use App\Controllers\RegisterController;
use App\Controllers\LoginController;
use App\Controllers\LogoutController;
use App\Controllers\AccountController;

Autoloader::register();

$action = $_SERVER['REQUEST_URI'];

$routes = [
    '/' => ['controller' => HomeController::class, 'action' => 'index'],
    '/home' => ['controller' => HomeController::class, 'action' => 'index'],
    '/register' => ['controller' => RegisterController::class, 'action' => 'index'],
    '/register/submit' => ['controller' => RegisterController::class, 'action' => 'register'],
    '/login' => ['controller' => LoginController::class, 'action' => 'index'],
    '/login/submit' => ['controller' => LoginController::class, 'action' => 'login'],
    '/logout' => ['controller' => LogoutController::class, 'action' => 'index'],
    '/account' => ['controller' => AccountController::class, 'action' => 'index'],
];

if (isset($routes[$action])) {
    $route = $routes[$action];
    $controller = new $route['controller'];
    $action = $route['action'];
    $controller->$action();
} else {
    echo 'Page not found';
}
