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

    public function updateTask($id, $status, $updated_at, $title = null, $description = null)
    {
        // Commencer la requête de base
        $sql = "UPDATE tasks SET ";

        // Créer un tableau pour stocker les parties de la requête dynamique
        $updates = [];
        $params = [];

        // Ajouter les parties à mettre à jour si elles sont définies
        if (!is_null($title)) {
            $updates[] = "title = :title";
            $params[':title'] = $title;
        }

        if (!is_null($description)) {
            $updates[] = "description = :description";
            $params[':description'] = $description;
        }

        // Le statut et la date de mise à jour sont toujours requis
        $updates[] = "status = :status";
        $params[':status'] = $status;

        $updates[] = "updated_at = :updated_at";
        $params[':updated_at'] = $updated_at;

        // Convertir le tableau en chaîne de caractères SQL
        $sql .= implode(", ", $updates);
        $sql .= " WHERE id = :id";

        // Préparation de la requête
        $stmt = self::$pdo->prepare($sql);
        $params[':id'] = $id;

        // Exécution de la requête
        return $stmt->execute($params);
    }

    public function deleteTask($id)
    {
        $stmt = self::$pdo->prepare("DELETE FROM tasks WHERE id = ?");
        return $stmt->execute([$id]);
    }
}