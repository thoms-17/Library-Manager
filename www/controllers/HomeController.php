<?php

namespace App\Controllers;

use App\Models\Book;

class HomeController
{
    public function index()
    {
        // Bufferise la vue spécifique
        $bookModel = new Book();
        $books = $bookModel->getAllBooksSortedByTitle();

        $pageStyles = '<link rel="stylesheet" href="/public/styles/homepage.css">';

        ob_start();
        require_once 'views/home.view.php';
        $content = ob_get_clean();

        // Appelle le layout global avec tout ce qu’il faut
        require_once 'views/layout.view.php';
    }
}
