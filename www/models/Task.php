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

    public function addTask($title, $description, $status, $created_at, $updated_at)
    {
        $stmt = self::$pdo->prepare("INSERT INTO tasks (title, description, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$title, $description, $status, $created_at, $updated_at]);
    }

    public function updateTask($id, $status, $updated_at, $title = null, $description = null)
    {
        $sql = "UPDATE tasks SET ";
        $updates = [];
        $params = [];

        if (!is_null($title)) {
            $updates[] = "title = :title";
            $params[':title'] = $title;
        }

        if (!is_null($description)) {
            $updates[] = "description = :description";
            $params[':description'] = $description;
        }

        $updates[] = "status = :status";
        $params[':status'] = $status;

        $updates[] = "updated_at = :updated_at";
        $params[':updated_at'] = $updated_at;

        $sql .= implode(", ", $updates);
        $sql .= " WHERE id = :id";

        $stmt = self::$pdo->prepare($sql);
        $params[':id'] = $id;

        return $stmt->execute($params);
    }

    public function deleteTask($id)
    {
        $stmt = self::$pdo->prepare("DELETE FROM tasks WHERE id = ?");
        return $stmt->execute([$id]);
    }
}