<div class="container mt-5">
    <div class="border p-4 bg-white col-md-6 mx-auto">
        <h1 class="mb-4 text-center">Mot de passe oublié</h1>

        <form action="/forgot-password/submit" method="POST">
            <div class="form-group">
                <label for="username">Votre Email :</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Recevoir un mail de réinitialisation</button>
            </div>
            <?php if (isset($errorMessage)) : ?>
                <p class="alert alert-danger"><?= $errorMessage ?></p>
            <?php endif; ?>
        </form>
    </div>
</div>