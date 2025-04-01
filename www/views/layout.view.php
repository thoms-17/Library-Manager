<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle : "Library Manager" ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <a class="navbar-brand text-white" href="/home">MyProject</a>
        <div class="nav-item dropdown ml-auto">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user text-white"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                <?php if (isset($_SESSION['user_id'])) : ?>
                    <?php if ($_SESSION['role'] == 'admin') : ?>
                        <a class="dropdown-item" href="/admin/dashboard">Dashboard</a>
                        <a class="dropdown-item" href="/account">Mon Compte</a>
                        <a class="dropdown-item" href="/logout">Déconnexion</a>
                    <?php else : ?>
                        <a class="dropdown-item" href="/account">Mon Compte</a>
                        <a class="dropdown-item" href="/logout">Déconnexion</a>
                    <?php endif; ?>
                <?php else : ?>
                    <a class="dropdown-item" href="/login">Connexion</a>
                    <a class="dropdown-item" href="/register">Inscription</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

</body>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>