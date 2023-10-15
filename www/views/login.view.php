<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="../styles/login.css">
</head>

<body>
    <h1>Connexion</h1>

    <form action="/login/submit" method="POST">
        <div>
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div>
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <button type="submit">Se connecter</button>
        </div>
        <?php if (isset($errorMessage)) : ?>
            <p class="error-message"><?= $errorMessage ?></p>
        <?php endif; ?>
    </form>
</body>

</html>