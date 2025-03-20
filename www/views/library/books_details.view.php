<div class="container mt-5">
    
    <?php if ($book): ?>
        <h1 class="mb-4"><?= htmlspecialchars($book['title']) ?></h1>
        <p><strong>Auteur :</strong> <?= htmlspecialchars($book['author']) ?></p>
        <p><strong>Date de publication :</strong> <?= htmlspecialchars($book['publication_date']) ?></p>
        <p><strong>Description :</strong> <?= nl2br(htmlspecialchars($book['description'])) ?></p>

        <h2 class="mt-5">Avis</h2>
        <?php if (!empty($reviews)) : ?>
            <ul class="list-group">
                <?php foreach ($reviews as $review) : ?>
                    <li class="list-group-item">
                        <p><?= htmlspecialchars($review['content']) ?> 
                        <span class="badge badge-primary">Note : <?= htmlspecialchars($review['rating']) ?>/5</span></p>
                        <p><small>Posté par utilisateur #<?= htmlspecialchars($review['user_id']) ?></small></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p class="alert alert-info">Aucun avis pour ce livre.</p>
        <?php endif; ?>

        <a href="/library/book/<?= htmlspecialchars($book['id']) ?>/add-review-form" class="btn btn-primary mt-4">Ajouter un avis</a>
    <?php else: ?>
        <p class="alert alert-danger">Livre introuvable.</p>
        <a href="/library" class="btn btn-secondary mt-3">Retour à la bibliothèque</a>
    <?php endif; ?>
</div>
