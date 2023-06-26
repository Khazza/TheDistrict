<?php
include 'database.php';
include 'DAO.php';
include './template/functions.php';

// Récupération de l'ID du plat
$plat_id = isset($_GET['id']) ? $_GET['id'] : null;

// Récupération des données du plat
$plat = null;
if ($plat_id) {
    $plat = get_plat_by_id($plat_id);
}

// Appel de la fonction pour afficher le header
render_header();
?>

<div class="container">
    <!-- Carte du plat -->
    <?php if ($plat) : ?>
        <div class="plat-card2">
            <img src="src/img/food/<?= $plat['image'] ?>" alt="<?= $plat['libelle'] ?>">
            <div class="card-body">
                <h2 class="card-title"><?= $plat['libelle'] ?></h2>
                <p class="card-text"><?= $plat['description'] ?></p>
                <label for="quantite">Quantité:</label>
                <input type="number" id="quantite" name="quantite" min="1" value="1">
            </div>
        </div>
    <?php endif; ?>


    <!-- Formulaire de commande -->
    <form action="submit_order.php" method="post" class="order-form">
        <div class="form-group">
            <label for="nom_prenom">Nom et prénom *</label>
            <input type="text" id="nom_prenom" name="nom_prenom" required>
        </div>

        <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="telephone">Téléphone *</label>
            <input type="tel" id="telephone" name="telephone" required>
        </div>

        <div class="form-group">
            <label for="adresse">Adresse</label>
            <textarea id="adresse" name="adresse"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Commander</button>
    </form>
</div>

<!-- Appel de la fonction pour afficher le footer -->
<?php render_footer(); ?>