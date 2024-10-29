<?php

namespace App\Controllers\User;

use App\Models\User;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\RequestMethodMiddleware;

class DeleteAccountController
{
    // Dans votre contrôleur (par exemple, UserController)
    public function deleteAccount()
    {

        // Vérifie si l'utilisateur est connecté
        AuthMiddleware::checkAuth();

        RequestMethodMiddleware::ensureMethod('POST');

        // Récupérer les informations de l'utilisateur actuellement connecté
        $delete_error_message = '';
        $userModel = new User();
        $userData = $userModel->getUserDataByUsername($_SESSION['username']);

        if ($userModel->deleteUser($userData['id'], $_POST['confirmPassword'])) {
            session_destroy();
            
            // Démarre une nouvelle session pour gérer l'accès à la page de succès
            session_start();
            $_SESSION['account_deleted'] = true;
            header('Location: /delete-account-success');
            exit;
        } else {
            // La suppression du compte a échoué, vous pouvez gérer cela ici
            //$delete_error_message = "Mot de passe incorrect";
            $_SESSION['delete_account_error'] = "Mot de passe incorrect.";
            // Rediriger vers une page appropriée ou afficher un message d'erreur
            header('Location: /account'); // Redirection vers la page de compte par défaut
            exit;
        }
    }

    public function deleteSuccess()
    {
        RequestMethodMiddleware::ensureMethod('POST');

        require_once 'views/layout.view.php';
        require_once 'views/delete_account_success.view.php';
    }
}
