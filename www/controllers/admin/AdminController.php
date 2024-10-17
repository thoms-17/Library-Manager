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

        require_once 'views/layout.view.php';
        require_once 'views/admin/admin_dashboard.view.php';
    }

    public function logs()
    {
        AuthMiddleware::checkAdmin();

        $logs = new Log();
        $logsData = $logs->getLogs();
        require_once 'views/layout.view.php';
        require_once 'views/admin/admin_logs.view.php';
    }

    public function listUsers()
    {
        AuthMiddleware::checkAdmin();

        $users = new User();
        $usersData = $users->getAllUsers();
        require_once 'views/layout.view.php';
        require_once 'views/admin/admin_users.view.php';
    }
}
