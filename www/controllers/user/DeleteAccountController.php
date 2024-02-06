<?php

namespace App\Controllers\User;

use App\Models\User;

class AccountController
{
    // Dans votre contrôleur (par exemple, UserController)
    public function deleteAccount()
    {
        // Récupérer les informations de l'utilisateur actuellement connecté
        $userModel = new User();
        $userData = $userModel->getUserDataByUsername($_SESSION['username']);

        // Vérifier si la suppression est autorisée (par exemple, en utilisant un jeton ou une vérification supplémentaire)

        // Appeler la méthode deleteUser avec l'ID de l'utilisateur et le mot de passe saisi
        $success = $userModel->deleteUser($userData['id'], $_POST['password']);

        // Traiter la réponse (par exemple, rediriger l'utilisateur avec un message)
        if ($success) {
            // Afficher un message de succès et déconnecter l'utilisateur, etc.
            echo 'Compte supprimé avec succès';
        } else {
            // Afficher un message d'erreur (mot de passe incorrect, etc.)
            echo 'Échec de la suppression du compte';
        }
    }
}
