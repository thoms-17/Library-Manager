<?php

$routes = [
    '/' => ['controller' => 'HomeController', 'action' => 'index'],
    '/home' => ['controller' => 'HomeController', 'action' => 'index'],
    '/register' => ['controller' => 'RegisterController', 'action' => 'index'],
    '/register/submit' => ['controller' => 'RegisterController', 'action' => 'register'],
    '/login' => ['controller' => 'LoginController', 'action' => 'index'],
    '/login/submit' => ['controller' => 'LoginController', 'action' => 'login'],
    '/logout' => ['controller' => 'LogoutController', 'action' => 'index'],
    '/account' => ['controller' => 'AccountController', 'action' => 'index'],
    '/admin/dashboard' => ['controller' => 'AdminDashboardController', 'action' => 'index'],
    '/admin/logs' => ['controller' => 'AdminLogsController', 'action' => 'index'],
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