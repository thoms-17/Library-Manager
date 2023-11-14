<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Mon Compte</title>
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
</body>

</html>