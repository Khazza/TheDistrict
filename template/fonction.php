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
    <footer class="footer text-center">
        <a href="#"><img src="path/to/facebook-icon.png" alt="Facebook"></a>
        <a href="#"><img src="path/to/twitter-icon.png" alt="Twitter"></a>
        <a href="#"><img src="path/to/instagram-icon.png" alt="Instagram"></a>
    </footer>
    <?php
}
?>
