<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        // Charger la vue home.view.php
        require_once 'views/layout.view.php';
        require_once 'views/home.view.php';
    }
}
