<?php

namespace App\Models;

use App\Database;
use PDO;

class Book
{
    private static $pdo;

    public function __construct()
    {
        if (!self::$pdo) {
            self::$pdo = Database::connect();
        }
    }

    public function getAllBooks()
    {
        $stmt = self::$pdo->query("SELECT * FROM books");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBookById($bookId)
    {
        $stmt = self::$pdo->prepare("SELECT * FROM books WHERE id = :id");
        $stmt->execute(['id' => $bookId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addBook($title, $author, $publication_date, $description)
    {
        $stmt = self::$pdo->prepare("INSERT INTO books (title, author, publication_date, description) VALUES (:title, :author, :publication_date, :description)");
        return $stmt->execute([
            'title' => $title,
            'author' => $author,
            'publication_date' => $publication_date,
            'description' => $description,
        ]);
    }

    public function deleteBook($bookId)
    {
        $stmt = self::$pdo->prepare("DELETE FROM books WHERE id = :id");
        return $stmt->execute(['id' => $bookId]);
    }

    public function getAllBooksSortedByTitle()
    {
        $stmt = self::$pdo->query("SELECT * FROM books ORDER BY title ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
