<?php

$routes = [
    '/' => ['controller' => 'HomeController', 'action' => 'index', 'method' => 'GET'],
    '/home' => ['controller' => 'HomeController', 'action' => 'index', 'method' => 'GET'],
    '/register' => ['controller' => 'User\\RegisterController', 'action' => 'index', 'method' => 'GET'],
    '/register/submit' => ['controller' => 'User\\RegisterController', 'action' => 'register', 'method' => 'POST'],
    '/login' => ['controller' => 'User\\LoginController', 'action' => 'index', 'method' => 'GET'],
    '/login/submit' => ['controller' => 'User\\LoginController', 'action' => 'login', 'method' => 'POST'],
    '/logout' => ['controller' => 'User\\LogoutController', 'action' => 'logout', 'method' => 'GET'],
    '/account' => ['controller' => 'User\\AccountController', 'action' => 'index', 'method' => 'GET'],
    '/account/update-info' => ['controller' => 'User\\AccountController', 'action' => 'updateUserInfo', 'method' => 'POST'],
    '/admin/dashboard' => ['controller' => 'Admin\\AdminController', 'action' => 'dashboard', 'method' => 'GET'],
    '/admin/logs' => ['controller' => 'Admin\\AdminController', 'action' => 'logs', 'method' => 'GET'],
    '/admin/users' => ['controller' => 'Admin\\AdminController', 'action' => 'listUsers', 'method' => 'GET'],
    '/delete-account' => ['controller' => 'User\\DeleteAccountController', 'action' => 'deleteAccount', 'method' => 'POST'],
    '/delete-account-success' => ['controller' => 'User\\DeleteAccountController', 'action' => 'deleteSuccess', 'method' => 'GET'],
    '/library' => ['controller' => 'Library\\LibraryController', 'action' => 'index', 'method' => 'GET'],
    '/library/add' => ['controller' => 'Library\\LibraryController', 'action' => 'showAddForm', 'method' => 'GET'],
    '/library/store' => ['controller' => 'Library\\LibraryController', 'action' => 'addBook', 'method' => 'POST'],
    '/library/book/{id}' => ['controller' => 'Library\\LibraryController', 'action' => 'viewBook', 'method' => 'GET'],
    '/library/book/{id}/add-review-form' => ['controller' => 'Library\\LibraryController', 'action' => 'showReviewForm', 'method' => 'GET'],
    '/library/book/{id}/add-review' => ['controller' => 'Library\\LibraryController', 'action' => 'addReview', 'method' => 'POST'],
    '/library/delete-review/{id}' => ['controller' => 'Library\\LibraryController', 'action' => 'deleteReview', 'method' => 'POST'],
    '/library/delete/{id}' => ['controller' => 'Library\\LibraryController', 'action' => 'deleteBook', 'method' => 'POST'],
    '/kanban' => ['controller' => 'KanbanController', 'action' => 'index', 'method' => 'GET'],
    '/kanban/add-task' => ['controller' => 'KanbanController', 'action' => 'addTask', 'method' => 'POST'],
    '/kanban/update-task/{id}' => ['controller' => 'KanbanController', 'action' => 'updateTask', 'method' => 'POST'],
    '/kanban/delete-task/{id}' => ['controller' => 'KanbanController', 'action' => 'deleteTask', 'method' => 'POST'],
    '/verify-email' => ['controller' => 'User\RegisterController', 'action' => 'verifyEmail', 'method' => 'GET'],
    '/forgot-password' => ['controller' => 'User\\LoginController', 'action' => 'forgotPasswordForm', 'method' => 'GET'],
    '/forgot-password/submit' => ['controller' => 'User\\LoginController', 'action' => 'forgotPasswordSubmit', 'method' => 'POST'],
    '/reset-password' => ['controller' => 'User\\LoginController', 'action' => 'resetPasswordForm', 'method' => 'GET'],
    '/reset-password/submit' => ['controller' => 'User\\LoginController', 'action' => 'resetPasswordSubmit', 'method' => 'POST'],
];

function route($action)
{
    global $routes;
    $requestMethod = $_SERVER['REQUEST_METHOD'];

    foreach ($routes as $routePath => $route) {
        // Remplace les paramètres dynamiques {param} par une expression régulière
        $regexPath = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_]+)', $routePath);

        // Vérifie si la route correspond et que la méthode HTTP est correcte
        if (preg_match("#^$regexPath$#", $action, $matches) && $route['method'] === $requestMethod) {
            $controllerName = 'App\\Controllers\\' . $route['controller'];
            $controller = new $controllerName();
            $method = $route['action'];

            // Passe les paramètres dynamiques à la méthode du contrôleur
            array_shift($matches);  // Retire le premier élément, qui est la correspondance complète
            call_user_func_array([$controller, $method], $matches);
            return;
        }
    }

    // Si aucune route ne correspond, appelle le contrôleur d'erreur pour la page 404
    $errorController = new \App\Controllers\ErrorController();
    $errorController->notFound();
    exit;
}
