<?php

namespace App\Controllers\User;

use App\Models\User;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\RequestMethodMiddleware;

class RegisterController
{
    public function index()
    {
        // Vérifiez si l'utilisateur est déjà connecté
        AuthMiddleware::redirectIfAuthenticated();

        $errorMessage = null;

        if (isset($_SESSION['register_error'])) {
            $errorMessage = $_SESSION['register_error'];
            unset($_SESSION['register_error']); // Effacez le message d'erreur de la session après l'avoir affiché
        }

        $pageTitle = "Inscription";
        $pageScripts = '<script src="../public/js/passwordToggle.js"></script>';

        ob_start();
        require_once 'views/user/register.view.php';
        $content = ob_get_clean();
        require_once 'views/layout.view.php';
    }

    public function register()
    {
        // Rediriger l'utilisateur connecté pour éviter qu'il puisse s'inscrire de nouveau
        AuthMiddleware::redirectIfAuthenticated();

        // Rediriger l'utilisateur connecté pour éviter qu'il puisse s'inscrire de nouveau
        AuthMiddleware::redirectIfAuthenticated();

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $creation_date = date('Y-m-d');

        $user = new User();
        $errorMessage = '';

        if (!$this->isPasswordSecure($password)) {
            $errorMessage = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, un chiffre et un caractère spécial.";
            $_SESSION['register_error'] = $errorMessage;
        }

        // Vérifier si l'utilisateur ou l'email existe déjà
        elseif ($user->userExists($username, $email)) {
            $errorMessage = "Ce nom d'utilisateur ou cette adresse e-mail est déjà utilisée.";
        } else {
            // Si tout est valide, créer un nouvel utilisateur
            $user->setUsername($username);
            $user->setEmail($email);
            $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
            $user->setCreationDate($creation_date);
            $user->setRole('user');

            try {
                $user->save();
                header('Location: /login'); // Rediriger vers la page de connexion après succès
                exit;
            } catch (\Exception $e) {
                $errorMessage = "Une erreur s'est produite lors de l'enregistrement de l'utilisateur.";
            }
        }

        // En cas d'erreur, stocker le message et rediriger vers la page d'inscription
        $_SESSION['register_error'] = $errorMessage;
        header('Location: /register');
        exit;
    }

    private function isPasswordSecure($password)
    {
        // Vérification stricte : Au moins 8 caractères, une majuscule, un chiffre, et un caractère spécial (généralisation des caractères spéciaux)
        return preg_match('/^(?=.*[A-Z])(?=.*[0-9])(?=.*[\W_])(?=.{8,})/', $password);
    }
}
