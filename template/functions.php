<?php

function render_header() {
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand"><img src="../src/img/the_district_brand/logo.png" alt="Logo" height="60"></a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="categories.php">Catégories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="plats.php">Plats</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
        </div>
    </nav>
    <?php
}

function render_footer() {
    ?>
    <footer class="footer text-center py-3" style="background-color: #f8f9fa; position: relative; width: 100%; bottom: 0;">
        <div class="container">
            <a href="#" class="mr-3"><i class="fab fa-facebook-f" style="font-size: 24px; color: #3b5998;"></i></a>
            <a href="#" class="mr-3"><i class="fab fa-twitter" style="font-size: 24px; color: #00acee;"></i></a>
            <a href="#"><i class="fab fa-instagram" style="font-size: 24px; color: #C13584;"></i></a>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <?php
}

?>
