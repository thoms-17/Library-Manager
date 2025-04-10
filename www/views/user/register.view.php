<body class="bg-light">
    <div class="container mt-5">
        <div class="border p-4 bg-white col-md-6 mx-auto">
            <h1 class="mb-4 text-center">Inscription</h1>

            <?php if (isset($_SESSION['verification_message'])) : ?>
                <p class="alert alert-success"><?= $_SESSION['verification_message'] ?></p>
                <?php unset($_SESSION['verification_message']); ?>
            <?php endif; ?>

            <form action="/register/submit" method="POST">
                <div class="form-group">
                    <label for="username">Nom d'utilisateur :</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Adresse e-mail :</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe :</label>
                    <!-- Ajoutez la classe password-container -->
                    <div class="input-group password-container">
                        <input type="password" name="password" id="password" class="form-control" required>
                        <!-- Ajoutez l'icône directement dans le champ sans couleur de fond -->
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary active" type="button" id="togglePassword" style="border: none;">
                                <i class="fa fa-eye-slash" id="eyeIcon" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                </div>
                <?php if (isset($errorMessage)) : ?>
                    <p class="alert alert-danger"><?= $errorMessage ?></p>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <script src="../public/js/passwordToggle.js"></script>
</body>