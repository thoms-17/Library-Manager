<?php

namespace App\Controllers;

use App\Models\Task;

class KanbanController
{
    private $taskModel;

    public function __construct()
    {
        $this->taskModel = new Task();
    }

    public function index()
    {
        $tasks = $this->taskModel->getAllTasks();
        require_once 'views/layout.view.php';
        require_once 'views/kanban/kanban.view.php';
    }

    public function addTask()
    {
        if ($_POST['title'] && $_POST['description']) {
            $this->taskModel->addTask($_POST['title'], $_POST['description']);
        }
        header('Location: /kanban');
    }

    public function updateTask($id)
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $status = $_POST['status'];
        $updated_at = date('Y-m-d H:i:s');

        $this->taskModel->updateTask($id, $title, $description, $status, $updated_at);

        header('Location: /kanban');
        exit;
    }

    public function deleteTask($id)
    {
        $this->taskModel->deleteTask($id);
        header('Location: /kanban'); // Redirige vers la page Kanban
    }
}
