<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mon Compte</title>
    <link rel="stylesheet" href="../styles/user_account.css">
</head>
<body>
    <h1>Mon Compte</h1>
    <?php if (isset($userData)) : ?>
        <p>Nom d'utilisateur : <?= $userData['username'] ?></p>
        <p>Adresse e-mail : <?= $userData['email'] ?></p>
        <p>Date d'inscription : <?= date("d/m/Y", strtotime($userData['creation_date'])) ?></p>
    <?php else : ?>
        <p>Impossible de récupérer les informations de l'utilisateur.</p>
    <?php endif; ?>
</body>
</html>
