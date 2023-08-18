<!DOCTYPE html>
<html>
<head>
    <title>Mon site</title>
    <link rel="stylesheet" href="/styles/main.css">
</head>
<body>
    <nav class="header">
        <ul class="menu">
            <li><a href="/home">Accueil</a></li>
            <li><a href="/login">Connexion</a></li>
            <li><a href="/register">Inscription</a></li>
        </ul>
    </nav>

    <div class="content">
        <?php echo $content; ?>
    </div>
</body>
</html>
