<?php
function render_header() {
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand"><img src="../src/img/the_district_brand/logo.png" alt="Logo" height="60"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
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
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="login.php" class="nav-link login-button">S'identifier</a>
                </li>
            </ul>
        </div>
    </nav>
    <?php
}



function render_footer() {
    ?>
    <footer class="footer text-center py-3" >
        <div class="container">
            <a href="#" class="mr-3"><i class="fab fa-facebook-f" style="font-size: 24px; color: #3b5998;"></i></a>
            <a href="#" class="mr-3"><i class="fab fa-twitter" style="font-size: 24px; color: #00acee;"></i></a>
            <a href="#"><i class="fab fa-instagram" style="font-size: 24px; color: #C13584;"></i></a>
        </div>
    </footer>
    <?php
}

?>
