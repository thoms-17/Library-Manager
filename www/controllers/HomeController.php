<?php

namespace App\Controllers;

use App\Database;

class HomeController
{
    public function index()
    {
        // Charger la vue home.view.php
        require_once 'views/layout.view.php';
        require_once 'views/home.view.php';
    }
}
