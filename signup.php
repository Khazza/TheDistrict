<?php
session_start();
include './database.php';
include './DAO.php';
include './template/functions.php';

// Génération du jeton CSRF
if (!isset($_SESSION["csrf_token"])) {
    $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
}

// Gestion erreurs
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];

?>

<!-- Appel de la fonction pour afficher le header -->
<?php render_header(); ?>

<div class="container form-container">
    <div class="card">
        <div class="card-header">
            <h2 class="title-signup text-center">Inscription</h2>
        </div>
        <div class="card-body">
            <?php
            // Afficher les erreurs s'il y en a
            if (isset($_SESSION['errors'])) {
                foreach ($_SESSION['errors'] as $error) {
                    echo "<div class='alert alert-danger' role='alert'>" . $error . "</div>";
                }
                unset($_SESSION['errors']);
            }
            ?>
            <form method="POST" action="signup_handler.php">
                <div class="mb-3">
                    <label for="nom_prenom" class="form-label">Nom et Prénom:</label>
                    <input type="text" class="form-control" name="nom_prenom" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe:</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirmer le mot de passe:</label>
                    <input type="password" class="form-control" name="confirm_password" required>
                </div>
                <input type="hidden" name="csrf_token" value="<?= $_SESSION["csrf_token"] ?>">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                </div>
            </form>
            <div class="text-center mt-2">
                <span>Vous avez déjà un compte ? <a href="login.php" class="text-login">Se connecter</a></span>
            </div>
            <div class="text-center mt-2">
                <span>Ou retourner à l'accueil <a href="index.php" class="back-index">Accueil</a></span>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap JS, jQuery -->
<script src="./js/script.js"></script>
<!-- Inclusion de SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>