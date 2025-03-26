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

    public function uploadProfileImage()
    {
        AuthMiddleware::checkAuth();

        if (!isset($_FILES['profile_image']) || $_FILES['profile_image']['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['error'] = "Erreur lors de l'upload de l'image.";
            header("Location: /account");
            exit();
        }

        // Vérification du type d'image (JPEG, PNG)
        $allowedTypes = ['image/jpeg', 'image/png'];
        if (!in_array($_FILES['profile_image']['type'], $allowedTypes)) {
            $_SESSION['error'] = "Format d'image non supporté.";
            header("Location: /account");
            exit();
        }

        // Lire l'image en binaire
        $imageData = file_get_contents($_FILES['profile_image']['tmp_name']);

        // Mettre à jour en base de données
        $userModel = new User();
        $userModel->updateProfileImage($_SESSION['user_id'], $imageData);

        $_SESSION['success'] = "Photo de profil mise à jour !";
        header("Location: /account");
    }
}
