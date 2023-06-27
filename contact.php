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

<!-- Main Content -->
<div class="container main-content-container contact-page">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="handle_contact.php" method="post">

                <!-- Ligne 1: Nom et Prénom -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <input type="text" class="form-control contact-input" name="nom" placeholder="Nom" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control contact-input" name="prenom" placeholder="Prénom">
                    </div>
                </div>

                <!-- Ligne 2: Email et Téléphone -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <input type="email" class="form-control contact-input" name="email" placeholder="Email">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control contact-input" name="telephone" placeholder="Téléphone" required>
                    </div>
                </div>

                <!-- Ligne 3: Votre demande -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <textarea class="form-control contact-input" name="demande" rows="4" placeholder="Votre demande"></textarea>
                    </div>
                </div>

                <!-- Ligne 4: Bouton Envoyer -->
                <div class="row">
                    <div class="col-md-12 text-end">
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Appel de la fonction pour afficher le footer -->
<?php render_footer(); ?>
