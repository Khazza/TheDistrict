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
            echo "<h2 class='mt-4'>{$plat['category_name']}</h2>";
            $current_category = $plat['category_name'];
        }
        
        // Déterminer le statut de disponibilité
        $availability = ($plat['active'] == 'Yes') ? 'Disponible' : 'Non disponible';
        
        // Début de la carte
        echo "<div class='card mb-3'>
                <div class='row g-0'>
                    <div class='col-md-4'>
                        <img src='chemin_vers_images/{$plat['image']}' alt='{$plat['libelle']}' class='img-fluid'>
                    </div>
                    <div class='col-md-8'>
                        <div class='card-body'>
                            <h5 class='card-title'>{$plat['libelle']}</h5>
                            <p class='card-text'>{$plat['description']}</p>
                            <p class='card-text'><small class='text-muted'>Prix: {$plat['prix']} €</small></p>
                            <p class='card-text'><small class='text-muted'>Catégorie: {$plat['category_name']}</small></p>
                            <p class='card-text'><small class='text-muted'>Disponibilité: {$availability}</small></p>
                        </div>
                    </div>
                </div>
            </div>"; // Fin de la carte
    }    

    ?>
</div>

<!-- Appel de la fonction pour afficher le footer -->
<?php render_footer(); ?>