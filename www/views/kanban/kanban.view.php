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
                        <li class="list-group-item" data-id="<?= $task['id'] ?>">
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

        <!-- Colonne En cours -->
        <div class="col kanban-column">
            <h2>En cours</h2>
            <ul class="list-group" id="in-progress">
                <?php foreach ($tasks as $task) : ?>
                    <?php if ($task['status'] === 'in_progress') : ?>
                        <li class="list-group-item" data-id="<?= $task['id'] ?>">
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
                        <li class="list-group-item" data-id="<?= $task['id'] ?>">
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
    const lists = document.querySelectorAll('.list-group');

    lists.forEach(list => {
        list.addEventListener('dragover', function(event) {
            event.preventDefault();
        });

        list.addEventListener('drop', function(event) {
            const id = event.dataTransfer.getData('text/plain');
            const taskElement = document.querySelector(`[data-id="${id}"]`);
            const listItem = event.target.closest('.list-group-item');

            if (listItem) {
                listItem.parentNode.insertBefore(taskElement, listItem);
            } else {
                list.appendChild(taskElement);
            }

            // Mettre à jour le statut de la tâche ici, si nécessaire
            updateTaskStatus(taskElement.dataset.id, list.id);
        });
    });

    document.querySelectorAll('.list-group-item').forEach(item => {
        item.addEventListener('dragstart', function(event) {
            event.dataTransfer.setData('text/plain', item.dataset.id);
        });
    });
});

// Fonction pour mettre à jour le statut de la tâche
function updateTaskStatus(taskId, newStatus) {
    const statusMap = {
        'todo': 'to_do',
        'in-progress': 'in_progress',
        'done': 'done'
    };

    const newStatusKey = Object.keys(statusMap).find(key => statusMap[key] === newStatus);

    // Envoyer une requête pour mettre à jour le statut
    fetch(`/kanban/update-task/${taskId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ status: newStatusKey })
    });
}
</script>
