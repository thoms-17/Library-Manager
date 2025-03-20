<div class="container mt-5">
    <h1 class="mb-4">Ajouter un Avis</h1>

    <form action="/library/book/<?= $bookId ?>/add-review" method="POST">
        <div class="form-group">
            <label for="content">Votre avis :</label>
            <textarea name="content" class="form-control" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <label for="rating">Note (1 à 5) :</label>
            <input type="number" name="rating" class="form-control" min="1" max="5" required>
        </div>
        <button type="submit" class="btn btn-success">Poster l'avis</button>
    </form>
</div>

<script>
    document.querySelector("form").addEventListener("submit", function(event) {
        console.log("Le formulaire a été soumis !");
    });
</script>
