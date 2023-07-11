<?php
session_start();

include 'database.php';
include 'DAO.php';
include './template/functions.php';
?>
<!-- Appel de la fonction pour afficher le header -->
<?php render_header(); ?>

<?php
// Afficher le message de succès après la déconnexion
if (isset($_SESSION['logout_success'])) {
    echo '<div class="alert alert-success text-center">' . $_SESSION['logout_success'] . '</div>';
    unset($_SESSION['logout_success']); // Effacer le message de succès pour qu'il ne soit pas réaffiché
}
?>

<?php
// Afficher le message de succès après la connexion
if (isset($_SESSION['login_success'])) {
    echo '<div class="alert alert-success text-center">' . $_SESSION['login_success'] . '</div>';
    unset($_SESSION['login_success']); // Effacer le message de succès pour qu'il ne soit pas réaffiché
}
?>

<?php
// Afficher le message de succès après l'inscription et la connexion
if (isset($_SESSION['register_success'])) {
    echo '<div class="alert alert-success text-center">' . $_SESSION['register_success'] . '</div>';
    unset($_SESSION['register_success']); // Effacer le message de succès pour qu'il ne soit pas réaffiché
}
?>

<!-- Search Bar Background Image -->
<div class="search-bar">
    <div class="container text-center">
        <form action="search.php" method="get">
            <input type="text" name="query" class="search-input" placeholder="Recherche...">
            <button type="submit" class="custom-search-button">Rechercher</button>
        </form>
    </div>
</div>

<!-- Main Content -->
<div class="container main-content-container homepage">
    <!-- Categories -->
    <!-- Titre pour les catégories -->
    <h2 class="section-title">Nos catégories populaires</h2>
    <div class="row justify-content-center category-row">
        <?php
        $categories = get_popular_categories();
        if (!empty($categories)) {
            foreach ($categories as $category) :
        ?>
                <div class="col-md-4">
                    <a href="plats.php?category_id=<?= $category['id'] ?>" class="category-card-link">
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

    <!-- Most Sold Dishes -->
    <!-- Titre pour les plats -->
    <h2 class="section-title2">Nos plats les plus populaires</h2>
    <div class="row justify-content-center dish-row">
        <?php
        $dishes = get_most_sold_dishes();
        if (!empty($dishes)) {
            foreach ($dishes as $dish) :
        ?>
                <div class="col-md-4">
                    <a href="orders.php?id=<?= $dish['id'] ?>" class="dish-card-link">
                        <div class="profile-card-3">
                            <img src="src/img/food/<?= $dish['image'] ?>" alt="Plat <?= $dish['libelle'] ?>" class="img img-responsive">
                            <div class="profile-name"><?= $dish['libelle'] ?></div>
                        </div>
                    </a>
                </div>

        <?php
            endforeach;
        }
        ?>
    </div>
</div>
<!-- Appel de la fonction pour afficher le footer -->
<?php render_footer(); ?>