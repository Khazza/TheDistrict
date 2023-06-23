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
    </div>
</div>

<!-- Contenu de la page -->
<div class="container">
    <?php
    // Récupérez l'ID de la catégorie de la requête GET
    $category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;

    // Récupérez les plats de la base de données
    $plats = get_plats_by_category($category_id);

    // Affichez les plats
    $current_category = null;
    foreach ($plats as $plat) {
        if ($current_category != $plat['category_name']) {
            echo "<h2>{$plat['category_name']}</h2>";
            $current_category = $plat['category_name'];
        }
        echo "<div>{$plat['libelle']} - {$plat['description']}</div>"; // Utiliser 'libelle' au lieu de 'nom'
    }

    ?>
</div>

<!-- Appel de la fonction pour afficher le footer -->
<?php render_footer(); ?>