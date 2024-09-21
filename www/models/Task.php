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

    public function updateTask($id, $status)
    {
        $stmt = self::$pdo->prepare("UPDATE tasks SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }

    public function deleteTask($id)
    {
        $stmt = self::$pdo->prepare("DELETE FROM tasks WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
