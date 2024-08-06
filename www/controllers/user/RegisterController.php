<?php

namespace App\Controllers\User;

use App\Models\User;

class RegisterController
{
    public function index()
    {
        $errorMessage = null;

        if (isset($_SESSION['register_error'])) {
            $errorMessage = $_SESSION['register_error'];
            unset($_SESSION['register_error']); // Effacez le message d'erreur de la session après l'avoir affiché
        }

        // Afficher la vue register.view.php avec le formulaire d'inscription
        require_once 'views/layout.view.php';
        require_once 'views/user/register.view.php';
    }

    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: /register");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $creation_date = date('Y-m-d');

            $user = new User();

            $errorMessage = '';

            if (!$this->isPasswordSecure($password)) {
                $errorMessage = "Le mot de passe doit contenir au moins 8 caractères, une majuscule et un caractère spécial.";
                $_SESSION['register_error'] = $errorMessage;
            } elseif ($user->userExists($username, $email)) {
                $errorMessage = "Ce nom d'utilisateur ou cette adresse e-mail est déjà utilisée.";
                $_SESSION['register_error'] = $errorMessage;
            } else {
                $user = new User();
                $user->setUsername($username);
                $user->setEmail($email);
                $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
                $user->setCreationDate($creation_date);
                $user->setRole('user');

                try {
                    $user->save();
                    header('Location: /login');
                    exit;
                } catch (\Exception $e) {
                    echo $e->getMessage();
                    $errorMessage = "Une erreur s'est produite lors de l'enregistrement de l'utilisateur.";
                }
            }
            $_SESSION['register_error'] = $errorMessage;
            header('Location: /register');
            exit;
        }
    }

    private function isPasswordSecure($password)
    {
        return preg_match('/^(?=.*[A-Z])(?=.*[!@#\$%\^&\*])(?=.{8,})/', $password);
    }
}
