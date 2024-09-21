<?php

namespace App\Controllers\Library;

use App\Models\Book;
use App\Models\Review;

class LibraryController
{
    public function index()
    {
        $bookModel = new Book();
        $books = $bookModel->getAllBooks();

        require_once 'views/layout.view.php';
        require_once 'views/library/index.view.php';
    }

    public function addBook()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bookModel = new Book();
            $bookModel->addBook($_POST['title'], $_POST['author'], $_POST['publication_date'], $_POST['description']);

            header('Location: /library');
            exit;
        }

        require_once 'views/layout.view.php';
        require_once 'views/library/add_book.view.php';
    }

    public function viewBook($bookId)
    {
        $bookModel = new Book();
        $book = $bookModel->getBookById($bookId);

        $reviewModel = new Review();
        $reviews = $reviewModel->getReviewsByBookId($bookId);

        require_once 'views/layout.view.php';
        require_once 'views/library/books_details.view.php';
    }

    public function addReview($bookId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reviewModel = new Review();
            $reviewModel->addReview($bookId, $_SESSION['user_id'], $_POST['content'], $_POST['rating']);

            header('Location: /library/book/' . $bookId);
            exit;
        }

        require_once 'views/layout.view.php';
        require_once 'views/library/add_review.view.php';
    }

    public function deleteBook($bookId)
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: /home");
            exit;
        }

        $bookModel = new Book();
        $bookModel->deleteBook($bookId);

        header('Location: /library');
        exit;
    }
}
