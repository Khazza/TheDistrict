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

<div class="content-wrapper">
    <div class="blur-background"></div>
    <div class="container">

        <!-- Formulaire de commande -->
        <form action="submit_order.php" method="post" class="order-form">

            <!-- Carte du plat -->
            <?php if ($plat) : ?>
                <div class="plat-card2">
                    <img src="src/img/food/<?= $plat['image'] ?>" alt="<?= $plat['libelle'] ?>">
                    <div class="card-body">
                        <h2 class="card-title"><?= $plat['libelle'] ?></h2>
                        <p class="card-text"><?= $plat['description'] ?></p>
                        <div class="quant text-end">
                            <label for="quantite">Quantité:</label>
                            <input type="number" id="quantite" name="quantite" min="1" max="25" value="1">
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label for="nom_prenom">Nom et prénom *</label>
                <input type="text" id="nom_prenom" name="nom_prenom" required>
                <span class="required-message">Ce champ est obligatoire</span>
            </div>

            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" required>
                <span class="required-message">Ce champ est obligatoire</span>
            </div>

            <div class="form-group">
                <label for="telephone">Téléphone *</label>
                <input type="tel" id="telephone" name="telephone" required>
                <span class="required-message">Ce champ est obligatoire</span>
            </div>

            <div class="form-group">
                <label for="adresse">Adresse *</label>
                <textarea id="adresse" name="adresse" required></textarea>
                <span class="required-message">Ce champ est obligatoire</span>
            </div>

            <div class="row">
                <div class="col-md-12 text-end">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Appel de la fonction pour afficher le footer -->
<?php render_footer(); ?>
