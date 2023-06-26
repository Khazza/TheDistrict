<?php
include 'database.php';
include 'DAO.php';
include './template/functions.php';

// Récupération de la requête de recherche
$query = isset($_GET['query']) ? $_GET['query'] : '';

// Récupération des catégories et des plats correspondant à la requête
$categories = search_categories($query);
$dishes = search_dishes($query);

// Appel de la fonction pour afficher le header
render_header();
?>

<div class="container main-content-container">
    <!-- Categories -->
    <h2 class="section-title">Catégories correspondant à "<?= htmlspecialchars($query) ?>"</h2>
    <div class="row justify-content-center category-row">
        <?php
        if (!empty($categories)) {
            foreach ($categories as $category) :
        ?>
                <div class="col-md-4">
                    <!-- Lien vers la page de catégorie -->
                    <a href="categories.php?category_id=<?= $category['id'] ?>">
                        <div class="profile-card-2">
                            <img src="src/img/category/<?= $category['image'] ?>" alt="Catégorie <?= $category['libelle'] ?>" class="img img-responsive">
                            <div class="profile-name"><?= $category['libelle'] ?></div>
                        </div>
                    </a>
                </div>
        <?php
            endforeach;
        } else {
            echo '<p>Aucune catégorie trouvée.</p>';
        }
        ?>
    </div>

    <!-- Dishes -->
    <h2 class="section-title">Plats correspondant à "<?= htmlspecialchars($query) ?>"</h2>
    <div class="row justify-content-center dish-row">
        <?php
        if (!empty($dishes)) {
            foreach ($dishes as $dish) :
        ?>
                <div class="col-md-4">
                    <!-- Lien vers la page de commande du plat -->
                    <a href="orders.php?dish_id=<?= $dish['id'] ?>">
                        <div class="profile-card-3">
                            <img src="src/img/food/<?= $dish['image'] ?>" alt="Plat <?= $dish['libelle'] ?>" class="img img-responsive">
                            <div class="profile-name"><?= $dish['libelle'] ?></div>
                        </div>
                    </a>
                </div>
        <?php
            endforeach;
        } else {
            echo '<p>Aucun plat trouvé.</p>';
        }
        ?>
    </div>
</div>

<!-- Appel de la fonction pour afficher le footer -->
<?php render_footer(); ?>
