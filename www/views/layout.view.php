<!DOCTYPE html>
<html>

<head>
    <title>Mon site</title>
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/home">Mon Site</a>

        <!-- Icône d'utilisateur avec menu déroulant -->
        <div class="nav-item dropdown ml-auto">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <a class="dropdown-item" href="/account">Mon Compte</a>
                    <a class="dropdown-item" href="/logout">Déconnexion</a>
                <?php else : ?>
                    <a class="dropdown-item" href="/login">Connexion</a>
                    <a class="dropdown-item" href="/register">Inscription</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Votre contenu de page ici -->
</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>
