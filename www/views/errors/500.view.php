<h1>Erreur 500 - Erreur interne du serveur</h1>

<?php if (!empty($details)) : ?>
    <p>Détail de l'erreur : <?= htmlspecialchars($details) ?></p>
<?php else : ?>
    <p>Une erreur inattendue est survenue. Veuillez réessayer plus tard.</p>
<?php endif; ?>