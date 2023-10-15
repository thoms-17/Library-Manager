<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="../styles/register.css">
</head>

<body>
    <h1>Inscription</h1>

    <form action="/register/submit" method="POST">
        <div>
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div>
            <label for="email">Adresse e-mail :</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <button type="submit">S'inscrire</button>
        </div>
        <?php if (isset($errorMessage)) : ?>
            <div class="error-message">
                <?= $errorMessage ?>
            </div>
        <?php endif; ?>
    </form>
</body>

</html>