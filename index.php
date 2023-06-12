<?php
include 'db.php';

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
            include 'DAO.php';
            $categories = get_categories();
            if (is_array($categories) && count($categories) >= 6) {
                for ($i = 0; $i < 6; $i++) :
                    $category = $categories[$i];
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
                endfor;
            }
            ?>
        </div>

        <!-- Most Sold Dishes -->
        <div class="row">
            <?php
            $dishes = get_most_sold_dishes();
            if (is_array($dishes) && count($dishes) >= 3) {
                for ($i = 0; $i < 3; $i++) :
                    $dish = $dishes[$i];
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
                endfor;
            }
            ?>
        </div>


        <!-- Footer Social Media -->
        <?php include './template/footer.php'; ?>

        <!-- Bootstrap JS, jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>