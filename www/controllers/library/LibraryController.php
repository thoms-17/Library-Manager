<?php

namespace App\Controllers\Library;

use App\Models\Book;
use App\Models\Review;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\RequestMethodMiddleware;
use App\Controllers\ErrorController;
use Error;

class LibraryController
{
    public function index()
    {
        $bookModel = new Book();
        $books = $bookModel->getAllBooks();

        $pageTitle = "Biliothèque";

        ob_start();
        require_once 'views/library/index.view.php';
        $content = ob_get_clean();
        require_once 'views/layout.view.php';
    }

    public function showAddForm()
    {
        AuthMiddleware::checkAuth();
        AuthMiddleware::checkAdmin();

        $pageTitle = "Ajouter un livre";

        ob_start();
        require_once 'views/library/add_book.view.php';
        $content = ob_get_clean();
        require_once 'views/layout.view.php';
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

        ob_start();
        require_once 'views/library/books_details.view.php';
        $content = ob_get_clean();
        require_once 'views/layout.view.php';
    }

    public function showReviewForm($bookId)
    {
        AuthMiddleware::checkAuth();

        $pageTitle = "Ajouter un avis : livre n° " . $bookId;
        $pageScripts = '<script src="../../../public/js/reviewStar.js"></script>';

        ob_start();
        require_once 'views/library/add_review.view.php';
        $content = ob_get_clean();
        require_once 'views/layout.view.php';
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

    public function deleteReview($reviewId)
    {
        AuthMiddleware::checkAuth();
        RequestMethodMiddleware::ensureMethod('POST');

        $reviewModel = new Review();
        $review = $reviewModel->getReviewById($reviewId);

        if (!$review) {
            ErrorController::notFound();
            exit;
        }

        $currentUserId = $_SESSION['user_id'];
        $currentUserRole = $_SESSION['role'] ?? 'user'; // au cas où

        $isAuthor = $review['user_id'] == $currentUserId;
        $isAdmin = $currentUserRole === 'admin';

        if (!$isAuthor && !$isAdmin) {
            ErrorController::forbidden("Vous n'avez pas la permission de supprimer cet avis.");
            exit;
        }

        $reviewModel->deleteReview($reviewId);

        header('Location: /library/book/' . $review['book_id']);
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
