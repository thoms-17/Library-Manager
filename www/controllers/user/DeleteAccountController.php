<?php

namespace App\Controllers\User;

use App\Models\User;

class DeleteAccountController
{
    // Dans votre contrôleur (par exemple, UserController)
    public function deleteAccount()
    {
        // Récupérer les informations de l'utilisateur actuellement connecté
        $delete_error_message = '';
        $userModel = new User();
        $userData = $userModel->getUserDataByUsername($_SESSION['username']);

        if ($userModel->deleteUser($userData['id'], $_POST['confirmPassword'])) {
            session_destroy();
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

    public function deleteSuccess() {
        require_once 'views/layout.view.php';
        require_once 'views/delete_account_success.view.php';
    }
}
