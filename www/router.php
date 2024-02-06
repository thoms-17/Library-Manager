<?php

$routes = [
    '/' => ['controller' => 'HomeController', 'action' => 'index'],
    '/home' => ['controller' => 'HomeController', 'action' => 'index'],
    '/register' => ['controller' => 'User\\RegisterController', 'action' => 'index'],
    '/register/submit' => ['controller' => 'User\\RegisterController', 'action' => 'register'],
    '/login' => ['controller' => 'User\\LoginController', 'action' => 'index'],
    '/login/submit' => ['controller' => 'User\\LoginController', 'action' => 'login'],
    '/logout' => ['controller' => 'User\\LogoutController', 'action' => 'index'],
    '/account' => ['controller' => 'User\\AccountController', 'action' => 'index'],
    '/admin/dashboard' => ['controller' => 'Admin\\AdminController', 'action' => 'dashboard'],
    '/admin/logs' => ['controller' => 'Admin\\AdminController', 'action' => 'logs'],
    '/admin/users' => ['controller' => 'Admin\\AdminController', 'action' => 'listUsers'],
];

function route($action)
{
    global $routes;
    
    if (isset($routes[$action])) {
        $route = $routes[$action];
        $controllerName = 'App\\Controllers\\' . $route['controller']; // Construisez le nom de la classe du contrôleur
        $controller = new $controllerName();
        $action = $route['action'];
        $controller->$action();
    } else {
        echo 'Page not found';
    }
}