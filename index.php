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

    <!-- Main Content -->
    <div class="container main-content-container">
        <!-- Categories -->
        <div class="row justify-content-center category-row">
            <?php
            $categories = get_popular_categories();
            if (!empty($categories)) {
                foreach ($categories as $category) :
            ?>
                    <div class="col-md-4">
                        <div class="profile-card-2">
                            <img src="src/img/category/<?= $category['image'] ?>" alt="Catégorie <?= $category['libelle'] ?>" class="img img-responsive">
                            <div class="profile-name"><?= $category['libelle'] ?></div>
                        </div>
                    </div>
            <?php
                endforeach;
            }
            ?>
        </div>

        <!-- Most Sold Dishes -->
        <div class="row justify-content-center dish-row">
            <?php
            $dishes = get_most_sold_dishes();
            if (!empty($dishes)) {
                foreach ($dishes as $dish) :
            ?>
                    <div class="col-md-4">
                        <div class="profile-card-3">
                            <img src="src/img/food/<?= $dish['image'] ?>" alt="Plat <?= $dish['libelle'] ?>" class="img img-responsive">
                            <div class="profile-name"><?= $dish['libelle'] ?></div>
                        </div>
                    </div>
            <?php
                endforeach;
            }
            ?>
        </div>
    </div>
    <!-- Appel de la fonction pour afficher le footer -->
    <?php render_footer(); ?>