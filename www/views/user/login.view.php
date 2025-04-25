<div class="container mt-5">
    <div class="border p-4 bg-white col-md-6 mx-auto">
        <h1 class="mb-4 text-center">Connexion</h1>

        <form action="/login/submit" method="POST">
            <div class="form-group">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <div class="input-group password-container">
                    <input type="password" name="password" id="password" class="form-control" required>
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary active" type="button" id="togglePassword" style="border: none;">
                            <i class="fa fa-eye-slash" id="eyeIcon" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </div>
            <?php if (isset($errorMessage)) : ?>
                <p class="alert alert-danger"><?= $errorMessage ?></p>
            <?php endif; ?>
        </form>
    </div>
</div>