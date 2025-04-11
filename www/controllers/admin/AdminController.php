<?php

namespace App\Controllers\Admin;

use App\Models\Log;
use App\Models\User;
use App\Middlewares\AuthMiddleware;

class AdminController
{
    public function dashboard()
    {
        AuthMiddleware::checkAdmin();

        $pageTitle = "Mon dashboard";
        $pageStyles = '<link rel="stylesheet" href="../public/styles/admin_dashboard.css">';

        ob_start();
        require_once 'views/admin/admin_dashboard.view.php';
        $content = ob_get_clean();
        require_once 'views/layout.view.php';
    }

    public function logs()
    {
        AuthMiddleware::checkAdmin();

        $logs = new Log();
        $logsData = $logs->getLogs();

        $pageTitle = "Logs de connexion";
        $pageStyles = '<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">';
        $pageScripts = '<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
                        <script src="../../public/js/admin_logs.js"></script>';

        ob_start();
        require_once 'views/admin/admin_logs.view.php';
        $content = ob_get_clean();
        require_once 'views/layout.view.php';
    }

    public function listUsers()
    {
        AuthMiddleware::checkAdmin();

        $users = new User();
        $usersData = $users->getAllUsers();

        $pageTitle = "Liste des utilisateurs";
        $pageStyles = '<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">';
        $pageScripts = '<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
                        <script src="../../public/js/admin_logs.js"></script>';

        ob_start();
        require_once 'views/admin/admin_users.view.php';
        $content = ob_get_clean();
        require_once 'views/layout.view.php';
    }
}
