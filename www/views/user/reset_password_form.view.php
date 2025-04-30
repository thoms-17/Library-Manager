<div class="container mt-5">
    <div class="col-md-6 mx-auto border p-4 bg-white">
        <h2 class="mb-4 text-center">Réinitialiser votre mot de passe</h2>
        <form action="/reset-password/submit" method="POST">
            <input type="hidden" name="token" value="<?= htmlspecialchars($_GET['token']) ?>">

            <div class="form-group">
                <label for="password">Nouveau mot de passe</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <div class="form-group mt-3 text-center">
                <button type="submit" class="btn btn-primary">Réinitialiser</button>
            </div>
        </form>
    </div>
</div>