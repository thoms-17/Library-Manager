<div class="container mt-5">
    <h1 class="mb-4">Ajouter un Livre</h1>

    <form action="/library/add" method="POST">
        <div class="form-group">
            <label for="title">Titre :</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="author">Auteur :</label>
            <input type="text" name="author" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="publication_date">Date de publication :</label>
            <input type="date" name="publication_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <textarea name="description" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Ajouter</button>
    </form>
</div>
