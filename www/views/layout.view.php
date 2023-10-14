<!DOCTYPE html>
<html>

<head>
    <title>Mon site</title>
    <link rel="stylesheet" href="/styles/main.css">
</head>

<body>
    <nav class="header">
        <ul class="menu">
            <li><a href="/">Accueil</a></li>
            <?php if (isset($_SESSION['user_id'])) : ?>
                <li><a href="/account">Mon Compte</a></li>
                <li><a href="/logout">Déconnexion</a></li>
            <?php else : ?>
                <li><a href="/login">Connexion</a></li>
                <li><a href="/register">Inscription</a></li>
            <?php endif; ?>
        </ul>

    </nav>

    <div class="content">
        <?php echo $content; ?>
    </div>
</body>

</html>