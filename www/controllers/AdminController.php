<?php

namespace App\Controllers;

use App\Models\Logs;
use App\Models\User;

class AdminController
{
    public function dashboard()
    {
        if (isset($_SESSION['user_id'])) {
            if ($_SESSION['role'] == 'admin') {
                require_once 'views/layout.view.php';
                require_once 'views/admin_dashboard.view.php';
            } else {
                header('Location: /account');
            }
        } else {
            // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            header('Location: /login');
        }
    }

    public function logs()
    {
        if (isset($_SESSION['user_id'])) {
            if ($_SESSION['role'] == 'admin') {
                $logs = new Logs();
                $logsData = $logs->getLogs();
                require_once 'views/layout.view.php';
                require_once 'views/admin_logs.view.php';
            } else {
                header('Location: /account');
            }
        } else {
            // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            header('Location: /login');
        }
    }

    public function listUsers()
    {
        if (isset($_SESSION['user_id'])) {
            if ($_SESSION['role'] == 'admin') {
                $users = new User();
                $usersData = $users->getAllUsers();
                require_once 'views/layout.view.php';
                require_once 'views/admin_users.view.php';
            } else {
                header('Location: /account');
            }
        } else {
            // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            header('Location: /login');
        }
    }
}
