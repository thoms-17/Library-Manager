<div class="container mt-5">
    <h1>Tableau Kanban</h1>
    <!-- Button to trigger modal -->
    <button class="btn btn-primary" data-toggle="modal" data-target="#addTaskModal">Ajouter Tâche</button>

    <!-- Modal -->
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
                    <form action="/kanban/add-task" id="addTaskForm" method="POST">
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

    <div class="row mt-4">
        <div class="col">
            <h2>À faire</h2>
            <ul class="list-group" id="todo">
                <?php foreach ($tasks as $task) : ?>
                    <?php if ($task['status'] === 'to_do') : ?>
                        <li class="list-group-item" data-id="<?= $task['id'] ?>">
                            <?= $task['title'] ?>
                            <button class="btn btn-success btn-sm float-right ml-2 update-status" data-status="in-progress">Démarrer</button>
                            <button class="btn btn-danger btn-sm float-right delete-task">Supprimer</button>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="col">
            <h2>En cours</h2>
            <ul class="list-group" id="in-progress">
                <?php foreach ($tasks as $task) : ?>
                    <?php if ($task['status'] === 'in-progress') : ?>
                        <li class="list-group-item" data-id="<?= $task['id'] ?>">
                            <?= $task['title'] ?>
                            <button class="btn btn-success btn-sm float-right ml-2 update-status" data-status="done">Terminer</button>
                            <button class="btn btn-danger btn-sm float-right delete-task">Supprimer</button>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="col">
            <h2>Terminé</h2>
            <ul class="list-group" id="done">
                <?php foreach ($tasks as $task) : ?>
                    <?php if ($task['status'] === 'done') : ?>
                        <li class="list-group-item" data-id="<?= $task['id'] ?>">
                            <?= $task['title'] ?>
                            <button class="btn btn-danger btn-sm float-right delete-task">Supprimer</button>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Soumettre le formulaire d'ajout de tâche
    $('#addTaskForm').submit(function(event) {
        event.preventDefault(); // Empêche le rechargement de la page

        const title = $('#taskTitle').val();
        const description = $('#taskDescription').val();

        $.post('/kanban/add-task', { title: title, description: description }, function() {
            $('#addTaskModal').modal('hide'); // Ferme la modale
            location.reload(); // Recharge la page pour afficher la nouvelle tâche
        });
    });

    // Autres interactions (changement de statut et suppression)...
});
</script>