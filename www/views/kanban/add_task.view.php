<div class="container">
    <h1>Ajouter une tâche</h1>
    <form action="/kanban/add-task" method="POST">
        <div class="form-group">
            <label for="title">Titre :</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
