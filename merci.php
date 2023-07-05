<?php
session_start();

include 'database.php';
include 'DAO.php';
include './template/functions.php';
?>
<!-- Appel de la fonction pour afficher le header -->
<?php render_header(); ?>

<div class="container thank-you-section text-center">
    <h1>Merci pour votre message!</h1>
    <p>Nous avons bien reçu votre demande et nous vous répondrons dans les plus brefs délais.</p>
    <a href="index.php" class="btn-merci-home">Retour à l'accueil</a>
</div>

<!-- Bootstrap JS, jQuery -->
<script src="./js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>