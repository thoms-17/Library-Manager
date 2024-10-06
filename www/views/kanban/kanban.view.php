<link rel="stylesheet" href="../styles/kanban.css">

<div class="container mt-5">
    <h1>Tableau Kanban</h1>

    <!-- Modal pour ajouter une tâche -->
    <div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTaskModalLabel">Ajouter une Tâche</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/kanban/add-task" method="POST">
                        <div class="form-group">
                            <label for="taskTitle">Titre</label>
                            <input type="text" class="form-control" id="taskTitle" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="taskDescription">Description</label>
                            <textarea class="form-control" id="taskDescription" name="description" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Button to trigger modal -->
    <button class="btn btn-primary" data-toggle="modal" data-target="#addTaskModal">Ajouter Tâche</button>

    <div class="row mt-4">
        <!-- Colonne À faire -->
        <div class="col kanban-column">
            <h2>À faire</h2>
            <ul class="list-group" id="todo">
                <?php foreach ($tasks as $task) : ?>
                    <?php if ($task['status'] === 'to_do') : ?>
                        <li class="list-group-item" data-id="<?= $task['id'] ?>" draggable="true">
                            <?= $task['title'] ?>

                            <!-- Formulaire de modification -->
                            <button class="btn btn-warning btn-sm float-right ml-2" data-toggle="modal" data-target="#editTaskModal-<?= $task['id'] ?>">Modifier</button>

                            <!-- Formulaire de suppression -->
                            <form action="/kanban/delete-task/<?= $task['id'] ?>" method="POST" class="d-inline">
                                <button type="submit" class="btn btn-danger btn-sm float-right">Supprimer</button>
                            </form>

                            <!-- Modal de modification -->
                            <div class="modal fade" id="editTaskModal-<?= $task['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editTaskModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Modifier la Tâche</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/kanban/update-task/<?= $task['id'] ?>" method="POST">
                                                <div class="form-group">
                                                    <label for="editTaskTitle">Titre</label>
                                                    <input type="text" class="form-control" name="title" value="<?= $task['title'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editTaskDescription">Description</label>
                                                    <textarea class="form-control" name="description" rows="3" required><?= $task['description'] ?></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Confirmer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Colonne En cours -->
        <div class="col kanban-column">
            <h2>En cours</h2>
            <ul class="list-group" id="in-progress">
                <?php foreach ($tasks as $task) : ?>
                    <?php if ($task['status'] === 'in_progress') : ?>
                        <li class="list-group-item" data-id="<?= $task['id'] ?>" draggable="true">
                            <?= $task['title'] ?>

                            <!-- Formulaire de modification -->
                            <button class="btn btn-warning btn-sm float-right ml-2" data-toggle="modal" data-target="#editTaskModal-<?= $task['id'] ?>">Modifier</button>

                            <!-- Formulaire de suppression -->
                            <form action="/kanban/delete-task/<?= $task['id'] ?>" method="POST" class="d-inline">
                                <button type="submit" class="btn btn-danger btn-sm float-right">Supprimer</button>
                            </form>

                            <!-- Modal de modification -->
                            <div class="modal fade" id="editTaskModal-<?= $task['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editTaskModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Modifier la Tâche</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/kanban/update-task/<?= $task['id'] ?>" method="POST">
                                                <div class="form-group">
                                                    <label for="editTaskTitle">Titre</label>
                                                    <input type="text" class="form-control" name="title" value="<?= $task['title'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editTaskDescription">Description</label>
                                                    <textarea class="form-control" name="description" rows="3" required><?= $task['description'] ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editTaskStatus">Statut</label>
                                                    <select class="form-control" name="status" required>
                                                        <option value="to_do" <?= $task['status'] === 'to_do' ? 'selected' : '' ?>>À faire</option>
                                                        <option value="in_progress" <?= $task['status'] === 'in_progress' ? 'selected' : '' ?>>En cours</option>
                                                        <option value="done" <?= $task['status'] === 'done' ? 'selected' : '' ?>>Terminé</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Modifier</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Colonne Terminé -->
        <div class="col kanban-column">
            <h2>Terminé</h2>
            <ul class="list-group" id="done">
                <?php foreach ($tasks as $task) : ?>
                    <?php if ($task['status'] === 'done') : ?>
                        <li class="list-group-item" data-id="<?= $task['id'] ?>" draggable="true">
                            <?= $task['title'] ?>

                            <!-- Formulaire de modification -->
                            <button class="btn btn-warning btn-sm float-right ml-2" data-toggle="modal" data-target="#editTaskModal-<?= $task['id'] ?>">Modifier</button>

                            <!-- Formulaire de suppression -->
                            <form action="/kanban/delete-task/<?= $task['id'] ?>" method="POST" class="d-inline">
                                <button type="submit" class="btn btn-danger btn-sm float-right">Supprimer</button>
                            </form>

                            <!-- Modal de modification -->
                            <div class="modal fade" id="editTaskModal-<?= $task['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editTaskModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Modifier la Tâche</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/kanban/update-task/<?= $task['id'] ?>" method="POST">
                                                <div class="form-group">
                                                    <label for="editTaskTitle">Titre</label>
                                                    <input type="text" class="form-control" name="title" value="<?= $task['title'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editTaskDescription">Description</label>
                                                    <textarea class="form-control" name="description" rows="3" required><?= $task['description'] ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editTaskStatus">Statut</label>
                                                    <select class="form-control" name="status" required>
                                                        <option value="to_do" <?= $task['status'] === 'to_do' ? 'selected' : '' ?>>À faire</option>
                                                        <option value="in_progress" <?= $task['status'] === 'in_progress' ? 'selected' : '' ?>>En cours</option>
                                                        <option value="done" <?= $task['status'] === 'done' ? 'selected' : '' ?>>Terminé</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Modifier</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tasks = document.querySelectorAll('.list-group-item');
        const columns = document.querySelectorAll('.list-group');

        tasks.forEach(task => {
            task.addEventListener('dragstart', function(event) {
                console.log('Drag started for task:', task.dataset.id); // Vérification du drag
                event.dataTransfer.setData('text/plain', task.dataset.id); // Sauvegarde l'ID de la tâche
                event.dataTransfer.effectAllowed = 'move'; // Autorise le déplacement
            });
        });

        columns.forEach(column => {
            // Empêche le comportement par défaut pour permettre le drop
            column.addEventListener('dragover', function(event) {
                event.preventDefault();
                event.dataTransfer.dropEffect = 'move'; // Indiquer que le déplacement est permis
                column.classList.add('dragging-over'); // Ajouter feedback visuel
            });

            // Retirer le feedback visuel si l'élément quitte la zone de drop
            column.addEventListener('dragleave', function(event) {
                column.classList.remove('dragging-over');
            });

            // Gérer le drop
            column.addEventListener('drop', function(event) {
                event.preventDefault();
                column.classList.remove('dragging-over'); // Enlever le feedback visuel

                const id = event.dataTransfer.getData('text/plain');
                const taskElement = document.querySelector(`[data-id="${id}"]`);

                if (taskElement) {
                    // Ajouter la tâche à la nouvelle colonne
                    column.appendChild(taskElement);

                    // Mettre à jour le statut de la tâche en fonction de la nouvelle colonne
                    updateTaskStatus(taskElement.dataset.id, column.id);
                }
            });
        });
    });

    // Fonction pour envoyer la mise à jour du statut au serveur
    function updateTaskStatus(taskId, newStatus) {
        const statusMap = {
            'todo': 'to_do',
            'in-progress': 'in_progress',
            'done': 'done'
        };

        if (statusMap[newStatus]) {
            fetch(`/kanban/update-task/${taskId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        status: statusMap[newStatus]
                    })
                })
                .then(response => response.text())
                .then(text => {
                    console.log('Réponse brute du serveur:', text);
                    try {
                        const data = JSON.parse(text); // Essaie de parser le texte en JSON
                        console.log('Mise à jour réussie:', data);
                    } catch (error) {
                        console.error('Erreur lors du parsing JSON:', error, 'Réponse brute:', text);
                    }
                })
                .catch(error => {
                    console.error('Erreur lors de la mise à jour du statut:', error);
                }); // Récupère le corps de la réponse
        } else {
            console.error('Statut non reconnu:', newStatus);
        }
    }
</script>