<?php
include 'database.php';
include 'DAO.php';
include 'functions.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The District - Restaurant et Commande en Ligne</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <!-- Navbar -->
    <?php include './template/header.php'; ?>

    <!-- Appel de la fonction pour afficher le header -->
    <?php render_header(); ?>

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
                        <div class="card">
                            <img src="<?= $category['image'] ?>" alt="Catégorie <?= $category['libelle'] ?>" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"><?= $category['libelle'] ?></h5>
                            </div>
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
                        <div class="card">
                            <img src="<?= $dish['image'] ?>" alt="Plat <?= $dish['libelle'] ?>" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"><?= $dish['libelle'] ?></h5>
                            </div>
                        </div>
                    </div>
            <?php
                endforeach;
            }
            ?>
        </div>

    <!-- Appel de la fonction pour afficher le footer -->
    <?php render_footer(); ?>

        <!-- Bootstrap JS, jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>