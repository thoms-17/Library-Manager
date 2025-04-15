<?php

namespace App\Models;

use App\Database;
use PDO;

class Review
{
    private static $pdo;

    public function __construct()
    {
        if (!self::$pdo) {
            self::$pdo = Database::connect();
        }
    }

    public function getReviewsByBookId($bookId)
    {
        $stmt = self::$pdo->prepare("SELECT * FROM reviews WHERE book_id = :book_id");
        $stmt->execute(['book_id' => $bookId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getReviewById($reviewId)
    {
        $stmt = self::$pdo->prepare("SELECT * FROM reviews WHERE id = :id");
        $stmt->execute(['id' => $reviewId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addReview($bookId, $userId, $content, $rating)
    {
        $stmt = self::$pdo->prepare("INSERT INTO reviews (book_id, user_id, content, rating) VALUES (:book_id, :user_id, :content, :rating)");
        return $stmt->execute([
            'book_id' => $bookId,
            'user_id' => $userId,
            'content' => $content,
            'rating' => $rating,
        ]);
    }

    public function deleteReview($reviewId)
    {
        $stmt = self::$pdo->prepare("DELETE FROM reviews WHERE id = :id");
        return $stmt->execute(['id' => $reviewId]);
    }
}
