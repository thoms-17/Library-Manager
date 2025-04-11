<?php

namespace App\Controllers;

use App\Models\Task;
use App\Middlewares\AuthMiddleware;

class KanbanController
{
    private $taskModel;

    public function __construct()
    {
        $this->taskModel = new Task();
    }

    public function index()
    {
        AuthMiddleware::checkAdmin();
        $pageTitle = "Tableau Kanban";
        $tasks = $this->taskModel->getAllTasks();

        $pageStyles = '<link rel="stylesheet" href="../public/styles/kanban.css">';
        $pageScripts = '<script src="../public/js/kanban.js"></script>';

        ob_start();
        require_once 'views/kanban/kanban.view.php';
        $content = ob_get_clean();
        require_once 'views/layout.view.php';
    }

    public function addTask()
    {
        if ($_POST['title'] && !empty($_POST['title'])) {
            date_default_timezone_set('Europe/Paris');
            $date = date('Y-m-d H:i:s');
            $description = isset($_POST['description']) && !empty($_POST['description']) ? $_POST['description'] : '';
            $this->taskModel->addTask($_POST['title'], $description, 'to_do', $date, $date);
        }
        header('Location: /kanban');
    }

    public function updateTask($id)
    {
        // Cas 1 : Requête JSON pour le drag & drop
        if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
            // Récupérer les données JSON envoyées par la requête fetch()
            $data = json_decode(file_get_contents('php://input'), true);

            // Vérifier que les données ont bien été récupérées
            if ($data && isset($data['status'])) {
                $status = $data['status'];
                date_default_timezone_set('Europe/Paris');
                $updated_at = date('Y-m-d H:i:s');

                // Appeler le modèle pour mettre à jour le statut de la tâche
                $success = $this->taskModel->updateTask($id, $status, $updated_at, null, null);

                // Répondre avec un contenu JSON
                header('Content-Type: application/json');

                if ($success) {
                    echo json_encode(['success' => true, 'message' => 'Tâche mise à jour']);
                } else {
                    http_response_code(500);  // Définit le code d'erreur si échec
                    //echo json_encode(['success' => false, 'message' => 'Erreur lors de la mise à jour']);
                }
            } else {
                // Si les données JSON ne sont pas valides
                http_response_code(400);  // Code pour mauvaise requête
                //echo json_encode(['success' => false, 'message' => 'Données invalides']);
            }

            // Terminer l'exécution pour éviter toute collision avec le code suivant
            return;
        }

        // Cas 2 : Requête classique via formulaire (méthode POST)
        if (isset($_POST['title'], $_POST['description'], $_POST['status'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $status = $_POST['status'];
            date_default_timezone_set('Europe/Paris');
            $updated_at = date('Y-m-d H:i:s');

            // Appeler le modèle pour mettre à jour tous les champs
            $this->taskModel->updateTask($id, $status, $updated_at, $title, $description);

            // Rediriger vers la vue du tableau Kanban après la mise à jour
            header('Location: /kanban');
            exit;
        }
    }

    public function deleteTask($id)
    {
        $this->taskModel->deleteTask($id);
        header('Location: /kanban');
    }
}
