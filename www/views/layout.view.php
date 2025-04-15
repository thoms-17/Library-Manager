<?php
require_once 'partials/header.php';
?>

<main class="container mt-4">
    <?= $content ?? '' ?>
</main>

<?php
require_once 'partials/footer.php';
?>
<!--
    This is the main layout file for the application. It includes the header and footer partials, and displays the content of the page.
    The content is injected into the layout using the $content variable.
    The header and footer files are included at the beginning and end of the file respectively.
    The main content area is defined within a Bootstrap container for styling.