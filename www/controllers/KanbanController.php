<?php

namespace App\Controllers;

use App\Models\Task;

class KanbanController
{
    private $taskModel;

    public function __construct(Task $taskModel)
    {
        $this->taskModel = $taskModel;
    }

    // Afficher le tableau Kanban
    public function index()
    {
        $tasks = $this->taskModel->getAllTasks();
        require_once '../views/kanban/index.php';  // Vue pour afficher le tableau Kanban
    }

    // Ajouter une nouvelle tâche
    public function addTask()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $this->taskModel->addTask($title, $description);
        }
        header('Location: /kanban');
        exit();
    }

    // Mettre à jour le statut d'une tâche
    public function updateTask($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'];
            $this->taskModel->updateTask($id, $status);
        }
        header('Location: /kanban');
        exit();
    }

    // Supprimer une tâche
    public function deleteTask($id)
    {
        $this->taskModel->deleteTask($id);
        header('Location: /kanban');
        exit();
    }
}
