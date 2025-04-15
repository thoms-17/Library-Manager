<header class="bg-dark text-white text-center py-5">
    <h1>Bienvenue sur notre bibliothèque !</h1>
</header>

<main class="container my-5">
    <section class="mb-5">
        <h2 class="text-center mb-4">Livres disponibles</h2>
        <?php if (!empty($books)) : ?>
            <div class="row">
                <?php foreach ($books as $book) : ?>
                    <div class="col-md-4 col-sm-6 mb-4">
                        <a href="/library/book/<?= $book['id'] ?>" style="text-decoration: none; color: inherit;">
                            <div class="card h-100 shadow-sm hover-shadow transition">
                                <div class="card-body text-center">
                                    <i class="fa-solid fa-book fa-2x mb-3 text-primary"></i>
                                    <h5 class="card-title"><?= htmlspecialchars($book['title']) ?></h5>
                                    <?php if (!empty($book['author'])) : ?>
                                        <p class="card-text text-muted small">par <?= htmlspecialchars($book['author']) ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p class="text-center">Aucun livre disponible pour le moment.</p>
        <?php endif; ?>
    </section>
</main>