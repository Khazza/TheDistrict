<?php
include 'database.php';
include 'DAO.php';
include './template/functions.php';
?>
<!-- Appel de la fonction pour afficher le header -->
<?php render_header(); ?>

<!-- Search Bar Background Image -->
<div class="search-bar">
    <div class="container text-center">
        <input type="text" class="search-input" placeholder="Recherche...">
    </div>
</div>

<!-- Appel de la fonction pour afficher le footer -->
<?php render_footer(); ?>