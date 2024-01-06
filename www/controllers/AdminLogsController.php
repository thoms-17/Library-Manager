<?php

namespace App\Controllers;

use App\Models\Logs;

class AdminLogsController
{
    public function index()
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
}
