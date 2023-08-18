<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>

<body>
    <h1>Connexion</h1>

    <?php if (isset($_SESSION['login_error'])) : ?>
        <div class="error-message">
            <?php echo $_SESSION['login_error']; ?>
        </div>
        <?php unset($_SESSION['login_error']); ?>

        <script>
            console.log('Message d\'erreur :');
            console.log('<?php echo $_SESSION['login_error']; ?>'); // Affiche dans la console du navigateur
        </script>
    <?php endif; ?>

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
    </form>
</body>

</html>