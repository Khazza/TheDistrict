<?php
session_start();

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

<!-- Main Content -->
<div class="container main-content-container">
    <!-- Categories -->
    <!-- Titre pour les catégories -->
    <h2 class="section-title">Nos catégories</h2>
    <div class="row justify-content-center category-row">
        <?php
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $items_per_page = 6;
        $offset = ($page - 1) * $items_per_page;

        // Utiliser la fonction pour obtenir des catégories paginées
        $categories = get_categories_paginated($items_per_page, $offset);

        if (!empty($categories)) {
            foreach ($categories as $category) :
        ?>
                <div class="col-md-4">
                    <a href="plats.php?category_id=<?= $category['id'] ?>">
                        <div class="profile-card-2">
                            <img src="src/img/category/<?= $category['image'] ?>" alt="Catégorie <?= $category['libelle'] ?>" class="img img-responsive">
                            <div class="profile-name"><?= $category['libelle'] ?></div>
                        </div>
                    </a>
                </div>
        <?php
            endforeach;
        }
        ?>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        
        <?php
        var_dump($page, $total_categories, $items_per_page);
        $total_categories = get_total_categories();
        echo generate_pagination_links($page, $total_categories, $items_per_page);
        ?>
    </div>
</div>

<!-- Appel de la fonction pour afficher le footer -->
<?php render_footer(); ?>
