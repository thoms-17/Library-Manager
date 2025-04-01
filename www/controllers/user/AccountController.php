<?php

namespace App\Controllers\User;

use App\Middlewares\AuthMiddleware;
use App\Models\User;

class AccountController
{
    public function index()
    {
        // Vérifier si l'utilisateur est connecté
        AuthMiddleware::checkAuth();

        // Récupérer les informations de l'utilisateur
        $userModel = new User();
        $userData = $userModel->getUserDataById($_SESSION['user_id']); // Assurez-vous que user_id est bien stocké en session

        // Vérifier et encoder l'image
        $profileImage = null;
        if (!empty($userData['profile_image'])) {
            $profileImage = base64_encode($userData['profile_image']);
        }

        // L'utilisateur est connecté
        $delete_error_message = null;

        if (isset($_SESSION['delete_account_error'])) {
            $delete_error_message = $_SESSION['delete_account_error'];
            unset($_SESSION['delete_account_error']);
        }

        $pageTitle = "Mon compte";

        // Inclure les vues en passant les données utilisateur
        require_once 'views/layout.view.php';
        require_once 'views/user/user_account.view.php';
    }

    public function updateUserInfo()
    {
        AuthMiddleware::checkAuth();

        $username = isset($_POST['username']) ? htmlspecialchars(trim($_POST['username'])) : null;
        var_dump($username);
        $imageData = null;

        if (!empty($_FILES['profile_image']['tmp_name'])) {
            $imageData = file_get_contents($_FILES['profile_image']['tmp_name']);
        }

        $userModel = new User();
        $updateSuccess = $userModel->updateUserInfo($_SESSION['user_id'], $username, $imageData);

        if ($updateSuccess) {
            $_SESSION['username'] = $username;
            echo "Mise à jour réussie.";
        } else {
            http_response_code(500);
            echo "Erreur lors de la mise à jour.";
        }
    }
}