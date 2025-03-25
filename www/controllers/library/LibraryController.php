<?php

namespace App\Controllers\Library;

use App\Models\Book;
use App\Models\Review;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\RequestMethodMiddleware;
use App\Controllers\ErrorController;

class LibraryController
{
    public function index()
    {
        $bookModel = new Book();
        $books = $bookModel->getAllBooks();

        $pageTitle = "Biliothèque"; 

        require_once 'views/layout.view.php';
        require_once 'views/library/index.view.php';
    }

    public function showAddForm()
    {
        AuthMiddleware::checkAuth();
        AuthMiddleware::checkAdmin();

        $pageTitle = "Ajouter un livre"; 

        require_once 'views/layout.view.php';
        require_once 'views/library/add_book.view.php';
    }

    public function addBook()
    {
        AuthMiddleware::checkAdmin();
        RequestMethodMiddleware::ensureMethod('POST'); // Vérifie la méthode POST

        if (!isset($_POST['title'], $_POST['author'], $_POST['publication_date'], $_POST['description'])) {
            $_SESSION['error'] = "Tous les champs sont requis.";
            header('Location: /library/add');
            exit;
        }

        $bookModel = new Book();
        $bookModel->addBook($_POST['title'], $_POST['author'], $_POST['publication_date'], $_POST['description']);

        $_SESSION['success'] = "Livre ajouté avec succès.";
        header('Location: /library');
        exit;
    }

    public function viewBook($bookId)
    {
        $bookModel = new Book();
        $book = $bookModel->getBookById($bookId);

        if (!$book) {
            (new ErrorController())->notFound();
            exit;
        }

        $reviewModel = new Review();
        $reviews = $reviewModel->getReviewsByBookId($bookId);

        $pageTitle = "Livre : " . $book['title']; 

        require_once 'views/layout.view.php';
        require_once 'views/library/books_details.view.php';
    }

    public function showReviewForm($bookId)
    {
        AuthMiddleware::checkAuth();
        AuthMiddleware::checkAdmin();

        $pageTitle = "Ajouter un avis le livre n° " . $bookId; 

        require_once 'views/layout.view.php';
        require_once 'views/library/add_review.view.php';
    }

    public function addReview($bookId)
    {
        AuthMiddleware::checkAuth();
        RequestMethodMiddleware::ensureMethod('POST');

        $reviewModel = new Review();
        $reviewModel->addReview($bookId, $_SESSION['user_id'], $_POST['content'], $_POST['rating']);

        header('Location: /library/book/' . $bookId);
        exit;
    }

    public function deleteBook($bookId)
    {
        AuthMiddleware::checkAdmin();
        RequestMethodMiddleware::ensureMethod('POST');

        $bookModel = new Book();
        $bookModel->deleteBook($bookId);

        header('Location: /library');
        exit;
    }
}
