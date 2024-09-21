<div class="container mt-5">
    <h1 class="mb-4"><?= $book['title'] ?></h1>
    <p><strong>Auteur :</strong> <?= $book['author'] ?></p>
    <p><strong>Date de publication :</strong> <?= $book['publication_date'] ?></p>
    <p><strong>Description :</strong> <?= $book['description'] ?></p>

    <h2 class="mt-5">Avis</h2>
    <?php if (!empty($reviews)) : ?>
        <ul class="list-group">
            <?php foreach ($reviews as $review) : ?>
                <li class="list-group-item">
                    <p><?= $review['content'] ?> <span class="badge badge-primary">Note : <?= $review['rating'] ?>/5</span></p>
                    <p><small>Posté par utilisateur #<?= $review['user_id'] ?></small></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p class="alert alert-info">Aucun avis pour ce livre.</p>
    <?php endif; ?>

    <a href="/library/book/<?= $book['id'] ?>/add-review" class="btn btn-primary mt-4">Ajouter un avis</a>
</div>