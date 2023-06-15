<?php
include 'database.php';
include 'DAO.php';
include './template/functions.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="icon" href="./src/img/the_district_brand/favicon.png">
    <title>The District - Restaurant et Commande en Ligne</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">

</head>

<body>
    <!-- Appel de la fonction pour afficher le header -->
    <?php render_header(); ?>

    <!-- Search Bar Background Image -->
    <div class="search-bar" style="background-image: url('./src/img/bg3.jpeg');">
        <div class="container text-center">
            <input type="text" class="search-input" placeholder="Recherche...">
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <!-- Categories -->
        <div class="row">
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
        <div class="row">
            <?php
            $dishes = get_most_sold_dishes();
            if (!empty($dishes)) {
                foreach ($dishes as $dish) :
            ?>
                    <div class="col-md-4">
                        <div class="profile-card-2">
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

    <!-- Bootstrap JS, jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>