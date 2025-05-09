<?php

namespace App\Controllers\User;

use App\Middlewares\AuthMiddleware;
use App\Models\User;
use App\Controllers\ErrorController;

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
        $pageStyles = '<link rel="stylesheet" href="../public/styles/user_account.css">
                       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">';
        $pageScripts = '<script src="../../public/js/updateProfile.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>';

        ob_start();
        require_once 'views/user/user_account.view.php';
        $content = ob_get_clean();
        require_once 'views/layout.view.php';
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
            ErrorController::internalServerError("Erreur lors de la mise à jour des informations de l'utilisateur.");
        }
    }
}