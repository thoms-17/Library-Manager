<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte</title>
    <link rel="stylesheet" href="../public/styles/user_account.css">
</head>

<body>
    <div class="container my-5">
        <h1 class="mt-4 text-center">Mon Compte</h1>

        <?php if (isset($_SESSION['user_id'])) : ?>
            <div class="card mt-4 mx-auto" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Informations Utilisateur</h5>

                    <!-- Gestion de la photo de profil -->
                    <div class="mt-4">
                        <form action="/account/upload-profile-image" method="POST" enctype="multipart/form-data">
                            <label for="profile-image" class="edit-profile-icon">
                                <?php if (!empty($profileImage)) : ?>
                                    <img src="data:image/jpeg;base64,<?= $profileImage ?>" alt="Profile Image" style="border-radius: 50%; width: 100%; height: 100%;">
                                <?php endif; ?>
                                <i class="fas fa-pencil-alt pencil-icon"></i>
                            </label>
                            <input type="file" name="profile_image" id="profile-image" accept="image/*" style="display: none;">
                            <button type="submit" class="btn btn-primary" style="display: none;">Enregistrer</button>
                        </form>
                    </div>


                    <p class="card-text">Nom d'utilisateur : <?= $_SESSION['username'] ?></p>
                    <p class="card-text">Adresse e-mail : <?= $_SESSION['email'] ?></p>
                    <p class="card-text">Date d'inscription : <?= date("d/m/Y", strtotime($_SESSION['creation_date'])) ?></p>

                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal">
                        Supprimer mon compte
                    </button>

                    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmation de Suppression</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/delete-account" method="POST">
                                    <div class="modal-body">
                                        <p>Veuillez saisir votre mot de passe pour confirmer la suppression de votre compte.</p>
                                        <input type="password" class="form-control mb-3" name="confirmPassword" id="confirmPassword" placeholder="Mot de passe">
                                        <?php if (isset($delete_error_message)) : ?>
                                            <p class="alert alert-danger"><?= $delete_error_message ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-danger">Confirmer la suppression du compte</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (isset($delete_error_message)) : ?>
                <script>
                    // Afficher la fenêtre modale au chargement de la page
                    $(document).ready(function() {
                        $('#confirmDeleteModal').modal('show');
                    });
                </script>
            <?php endif; ?>

        <?php else : ?>
            <p class="alert alert-danger">Impossible de récupérer les informations de l'utilisateur.</p>
        <?php endif; ?>
    </div>
</body>

</html>