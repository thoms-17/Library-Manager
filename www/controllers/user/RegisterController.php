<?php

namespace App\Controllers\User;

use App\Models\User;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\RequestMethodMiddleware;
use App\Utils\EmailHelper;
use App\Controllers\ErrorController;

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

            $token = bin2hex(random_bytes(32));
            // Si tout est valide, créer un nouvel utilisateur
            $user->setUsername($username);
            $user->setEmail($email);
            $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
            $user->setCreationDate($creation_date);
            $user->setRole('user');
            $user->setVerificationToken($token);
            $user->setEmailVerified(0);

            try {
                EmailHelper::sendVerificationEmail($email, $username, $token);
                $user->save();

                $_SESSION['register_success'] = "Inscription réussie ! Un e-mail de vérification a été envoyé à votre adresse.";
                header('Location: /login'); // Rediriger vers la page de connexion après succès
                exit;
            } catch (\Exception $e) {
                $errorMessage = "Une erreur s'est produite lors de l'enregistrement de l'utilisateur. (" . $e->getMessage() . ")";
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

    public function verifyEmail()
    {
        $token = $_GET['token'] ?? null;

        if (!$token) {
            ErrorController::notFound();
        }

        $userModel = new User();
        $user = $userModel->getUserByVerificationToken($token);

        if (!$user) {
            $pageTitle = "Lien de vérification invalide";

            ob_start();
            require_once 'views/user/invalid_link.view.php';
            $content = ob_get_clean();
            require_once 'views/layout.view.php';
        }

        // Mettre à jour l'utilisateur : verified = 1, token = NULL
        $userModel->markEmailAsVerified($user['id']);

        $pageTitle = "Email vérifié avec succès";

        ob_start();
        require_once 'views/user/email_validation.view.php';
        $content = ob_get_clean();
        require_once 'views/layout.view.php';
    }
}
