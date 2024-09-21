<div class="container mt-5">
    <h1 class="mb-4">Bibliothèque</h1>

    <a href="/library/add" class="btn btn-primary mb-4">Ajouter un livre</a>

    <?php if (!empty($books)) : ?>
        <ul class="list-group">
            <?php foreach ($books as $book) : ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="/library/book/<?= $book['id'] ?>"><?= $book['title'] ?></a>

                    <!-- Bouton Supprimer -->
                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDeleteModal-<?= $book['id'] ?>">
                        <i class="fa fa-trash"></i>
                    </button>

                    <!-- Modale de confirmation -->
                    <div class="modal fade" id="confirmDeleteModal-<?= $book['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel-<?= $book['id'] ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDeleteModalLabel-<?= $book['id'] ?>">Confirmation de Suppression</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Êtes-vous sûr de vouloir supprimer le livre "<strong><?= $book['title'] ?></strong>" ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <form action="/library/delete/<?= $book['id'] ?>" method="POST" class="d-inline">
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p class="alert alert-info">Aucun livre n'est disponible pour le moment.</p>
    <?php endif; ?>
</div>