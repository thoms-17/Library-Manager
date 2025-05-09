<h1>Erreur 403 - Accès interdit</h1>

<?php if (!empty($message)) : ?>
    <p><?= htmlspecialchars($message) ?></p>
<?php else : ?>
    <p>Vous n'avez pas l'autorisation d'accéder à cette ressource.</p>
<?php endif; ?>
