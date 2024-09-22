<?php

namespace App\Models;

use App\Database;
use PDO;

class Task
{
    private static $pdo;

    public function __construct()
    {
        if (!self::$pdo) {
            self::$pdo = Database::connect();
        }
    }

    public function getAllTasks()
    {
        $stmt = self::$pdo->query("SELECT * FROM tasks ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addTask($title, $description, $status = 'to_do')
    {
        $stmt = self::$pdo->prepare("INSERT INTO tasks (title, description, status) VALUES (?, ?, ?)");
        return $stmt->execute([$title, $description, $status]);
    }

    public function updateTask($id, $title, $description, $status, $updated_at) {
        $sql = "UPDATE tasks SET title = :title, description = :description, status = :status, updated_at = :updated_at WHERE id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':updated_at', $updated_at);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }    

    public function deleteTask($id)
    {
        $stmt = self::$pdo->prepare("DELETE FROM tasks WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
