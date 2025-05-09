<div class="container my-5">
    <h1 class="mt-4 text-center">Mon Compte</h1>

    <?php if (isset($_SESSION['user_id'])) : ?>
        <div class="card mt-4 mx-auto text-center" style="max-width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Informations Utilisateur</h5>

                <!-- Photo de profil avec icône d'édition -->
                <div class="profile-container mx-auto">
                    <img id="profilePreview"
                        src="<?= !empty($profileImage) ? "data:image/jpeg;base64,$profileImage" : '/public/images/default_user.jpg' ?>"
                        alt="Profile Image"
                        class="rounded-circle" width="150">
                    <span class="edit-icon" id="editImageBtn" style="display: none;">
                        <i class="fas fa-pencil-alt"></i>
                    </span>
                    <input type="file" id="profile-image" accept="image/*">
                </div>

                <!-- Infos utilisateur -->
                <div id="infoDisplay">
                    <p class="card-text"><strong>Nom d'utilisateur :</strong> <span id="usernameDisplay"><?= htmlspecialchars($userData['username']) ?></span></p>
                    <p class="card-text"><strong>Email :</strong> <?= htmlspecialchars($userData['email']) ?></p>
                    <?php
                    $date = new DateTime($userData['creation_date']);
                    $formattedDate = $date->format('d/m/Y');
                    ?>
                    <p class="card-text"><strong>Date d'inscription :</strong> <?= htmlspecialchars($formattedDate) ?></p>
                    <button id="editModeBtn" class="btn btn-secondary">Modifier mon profil</button>
                    <button type="button" class="btn btn-danger mt-3" data-toggle="modal" data-target="#confirmDeleteModal">
                        Supprimer mon compte
                    </button>
                </div>

                <!-- Formulaire de modification -->
                <form id="editInfoForm" style="display: none;">
                    <input type="text" id="editUsername" name="username" class="form-control mb-2" value="<?= htmlspecialchars($userData['username']) ?>">
                    <button type="submit" class="btn btn-success">Enregistrer</button>
                    <button type="button" id="cancelEditBtn" class="btn btn-danger">Annuler</button>
                </form>
            </div>
        </div>

    <?php else : ?>
        <p class="alert alert-danger">Impossible de récupérer les informations de l'utilisateur.</p>
    <?php endif; ?>
</div>

<!-- Modal pour le recadrage de l'image -->
<div class="modal fade" id="imageCropperModal" tabindex="-1" aria-labelledby="imageCropperModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Ajout de modal-lg -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageCropperModalLabel">Recadrer l’image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body text-center"> <!-- Centrage -->
                <img id="imageToCrop" style="max-width: 100%; max-height: 400px;">
            </div>
            <div class="modal-footer">
                <button id="cropImageBtn" class="btn btn-success">Valider</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation de suppression -->
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