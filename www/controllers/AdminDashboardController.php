<?php

namespace App\Controllers;

//use App\Models\User;

class AdminDashboardController
{
    public function index()
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
}
