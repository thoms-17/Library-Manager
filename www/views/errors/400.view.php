<div class="text-center">
    <h1 class="text-primary">Erreur 400 - Requête invalide</h1>
    <h1>Erreur 400 - Requête invalide</h1>
    <?php if (isset($reason)) : ?>
        <?php if ($reason === 'Lien invalide.') : ?>
            <p>Le lien fourni est invalide.</p>
        <?php elseif ($reason === 'Lien invalide ou expiré.') : ?>
            <p>Le lien a expiré. Veuillez recommencer la procédure.</p>
        <?php else : ?>
            <p>Une erreur est survenue lors de la requête.</p>
        <?php endif; ?>
    <?php else : ?>
        <p>Requête incorrecte.</p>
    <?php endif; ?>

    <a href="/" class="btn btn-primary">Retour à l'accueil</a>
</div>