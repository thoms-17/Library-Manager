<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Mon Compte</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container my-5">
        <h1 class="mt-4 text-center">Mon Compte</h1>
        <?php if (isset($userData)) : ?>
            <div class="card mt-4 mx-auto" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Informations Utilisateur</h5>
                    <p class="card-text">Nom d'utilisateur : <?= $userData['username'] ?></p>
                    <p class="card-text">Adresse e-mail : <?= $userData['email'] ?></p>
                    <p class="card-text">Date d'inscription : <?= date("d/m/Y", strtotime($userData['creation_date'])) ?></p>
                </div>
            </div>
        <?php else : ?>
            <p>Impossible de récupérer les informations de l'utilisateur.</p>
        <?php endif; ?>
    </div>
    <!-- Inclure les scripts Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>