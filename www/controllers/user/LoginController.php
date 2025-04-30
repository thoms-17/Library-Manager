<?php

namespace App\Controllers\User;

use App\Models\User;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\RequestMethodMiddleware;
use App\Utils\EmailHelper;
use App\Controllers\ErrorController;
use App\Utils\SecurePassword;

class LoginController
{
    public function index()
    {
        // Vérifiez si l'utilisateur est déjà connecté
        AuthMiddleware::redirectIfAuthenticated();

        $errorMessage = null;
        $successMessage = null;

        if (isset($_SESSION['login_error'])) {
            $errorMessage = $_SESSION['login_error'];
            unset($_SESSION['login_error']); // Effacer le message d'erreur de la session après l'avoir affiché
        }

        if (isset($_SESSION['register_success'])) {
            $successMessage = $_SESSION['register_success'];
            unset($_SESSION['register_success']); // Effacez le message de succès de la session après l'avoir affiché
        }

        if (isset($_SESSION['forgot-password'])) {
            $successMessage = $_SESSION['forgot-password'];
            unset($_SESSION['forgot-password']); // Effacez le message de succès de la session après l'avoir affiché
        }

        $pageTitle = "Connexion";
        $pageScripts = '<script src="../public/js/passwordToggle.js"></script>';

        ob_start();
        require_once 'views/user/login.view.php';
        $content = ob_get_clean();
        require_once 'views/layout.view.php';
    }

    public function login()
    {
        // Vérifie que la méthode de requête est POST
        RequestMethodMiddleware::ensureMethod('POST');

        // Vérifier que les champs sont bien remplis
        if (empty($_POST['username']) || empty($_POST['password'])) {
            $_SESSION['login_error'] = "Veuillez remplir tous les champs.";
            header('Location: /login');
            exit;
        }

        // Récupérer les données du formulaire
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Instancier le modèle User
        $userModel = new User();

        // Vérifier si l'utilisateur existe et si le mot de passe est correct
        if (!$userModel->authenticate($username, $password)) {
            $_SESSION['login_error'] = "Nom d'utilisateur ou mot de passe incorrect.";
            header('Location: /login');
            exit;
        }

        // Récupérer les informations de l'utilisateur
        $userData = $userModel->getUserDataByUsername($username);

        // Vérifier si les données utilisateur existent
        if (!$userData || empty($userData['id'])) {
            $_SESSION['login_error'] = "Nom d'utilisateur ou mot de passe incorrect.";
            header('Location: /login');
            exit;
        }

        // Vérifier si l'email a été vérifié
        if (!$userData['email_verified']) {
            $_SESSION['login_error'] = "Veuillez vérifier votre adresse email avant de vous connecter.";
            header('Location: /login');
            exit;
        }

        // Stocker uniquement l'ID utilisateur en session
        $_SESSION['user_id'] = $userData['id'];
        $_SESSION['role'] = $userData['role'];
        $_SESSION['username'] = $userData['username'];

        // Rediriger l'utilisateur vers la page d'accueil
        header('Location: /home');
        exit;
    }

    public function forgotPasswordForm()
    {
        if (isset($_SESSION['forgot-password'])) {
            $errorMessage = $_SESSION['forgot-password'];
            unset($_SESSION['forgot-password']); // Effacer le message d'erreur de la session après l'avoir affiché
        }

        $pageTitle = "Mot de passe oublié";

        ob_start();
        require_once 'views/user/forgot-password.view.php';
        $content = ob_get_clean();
        require_once 'views/layout.view.php';
    }

    public function forgotPasswordSubmit()
    {
        RequestMethodMiddleware::ensureMethod('POST');

        if (empty($_POST['email'])) {
            $_SESSION['forgot-password'] = "Veuillez remplir tous les champs.";
            header('Location: /forgot-password');
            exit;
        }

        $email = $_POST['email'];
        $userModel = new User();
        $user = $userModel->getUserDataByEmail($email); // Tu dois créer cette méthode si elle n'existe pas

        if ($user) {
            $resetToken = bin2hex(random_bytes(32));

            // Enregistrer le token en base (tu peux aussi enregistrer un champ "reset_token_expires" pour une durée de validité)
            $userModel->storeResetToken($user['id'], $resetToken); // Crée cette méthode aussi

            EmailHelper::sendPasswordResetEmail($email, $resetToken);
        }

        $_SESSION['forgot-password'] = "Si cet email est associé à un compte, un lien de réinitialisation vous a été envoyé.";
        header('Location: /login');
        exit;
    }

    public function resetPasswordForm()
    {
        if (isset($_SESSION['wrong_password'])) {
            $errorMessage = $_SESSION['wrong_password'];
            unset($_SESSION['wrong_password']); // Effacez le message d'erreur de la session après l'avoir affiché
        }

        if (isset($_SESSION['reset_password_error'])) {
            $errorMessage = $_SESSION['reset_password_error'];
            unset($_SESSION['reset_password_error']); // Effacez le message d'erreur de la session après l'avoir affiché
        }

        if (!isset($_GET['token'])) {
            http_response_code(400);
            echo "Lien invalide.";
            exit;
        }

        $token = $_GET['token'];
        $userModel = new User();
        $user = $userModel->getUserByResetToken($token);

        if (!$user) {
            http_response_code(400);
            echo "Lien invalide ou expiré.";
            exit;
        }

        $pageTitle = "Réinitialiser le mot de passe";

        ob_start();
        require 'views/user/reset_password_form.view.php';
        $content = ob_get_clean();
        require_once 'views/layout.view.php';
    }

    public function resetPasswordSubmit()
    {
        RequestMethodMiddleware::ensureMethod('POST');

        $token = $_POST['token'] ?? null;
        $newPassword = $_POST['password'] ?? null;

        try {
            // Vérification des données de base
            if (!$token || !$newPassword) {
                http_response_code(400);
                echo "Requête invalide.";
                exit;
            }

            // Vérification de la robustesse du mot de passe
            if (!SecurePassword::isPasswordSecure($newPassword)) {
                $errorMessage = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, un chiffre et un caractère spécial.";
                $_SESSION['reset_password_error'] = $errorMessage;
                header("Location: /reset-password?token=" . urlencode($token));
                exit;
            }

            $userModel = new User();
            $user = $userModel->getUserByResetToken($token);

            if (!$user) {
                http_response_code(400);
                echo "Token invalide.";
                exit;
            }

            // Mise à jour du mot de passe
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $userModel->updatePasswordAndClearToken($user['id'], $hashedPassword);

            $_SESSION['successMessage'] = "Votre mot de passe a été réinitialisé.";
            header('Location: /login');
            exit;
        } catch (\Exception $e) {
            $_SESSION['reset_password_error'] = $e->getMessage();
            header("Location: /reset-password?token=" . urlencode($token));
            exit;
        }
    }
}
