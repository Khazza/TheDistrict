<?php
function render_header()
{
    $current_page = basename($_SERVER['SCRIPT_NAME']);

?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Favicon -->
        <link rel="icon" href="./src/img/the_district_brand/favicon.png">
        <title>The District - Restaurant et Commande en Ligne</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome CSS-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="./assets/css/style.css">

    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand"><img src="../src/img/the_district_brand/logo_transp.png" alt="Logo" height="60"></a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $current_page === 'index.php' ? 'active' : ''; ?>" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $current_page === 'categories.php' ? 'active' : ''; ?>" href="categories.php">Catégories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $current_page === 'plats.php' ? 'active' : ''; ?>" href="plats.php">Plats</a>
                    </li>

                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $current_page === 'contact.php' ? 'active' : ''; ?>" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a href="login.php" class="nav-link login-button">S'identifier</a>
                    </li>
                </ul>
            </div>
        </nav>
    <?php
}


function render_footer()
{
    $current_page = basename($_SERVER['SCRIPT_NAME']);
    ?>
        <footer class="footer text-center py-3 mt-2 mb-3">
            <div class="container d-flex align-items-center justify-content-between h-100">
                <div>
                    <a href="../legal-notice.php" class="mr-auto footer-link <?php echo $current_page === 'legal-notice.php' ? 'active' : ''; ?>">Mentions légales</a> <!-- Lien vers Mentions légales -->
                    <a href="../privacy-policy.php" class="mr-auto footer-link <?php echo $current_page === 'privacy-policy.php' ? 'active' : ''; ?>">Politique de confidentialité</a> <!-- Lien vers Politique de confidentialité -->
                </div>
                <div>
                    <a href="#" class="ms-3"><i class="fab fa-facebook fa-2xl"></i></a>
                    <a href="#" class="ms-3"><i class="fab fa-twitter fa-2xl"></i></a>
                    <a href="#" class="ms-3"><i class="fab fa-instagram fa-2xl"></i></a>
                </div>
        </footer>

        <!-- Bootstrap JS, jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
<?php
}
?>

<?php
// Cette fonction génère les liens de pagination en fonction de la page actuelle et du nombre total de catégories.
function generate_pagination_links($current_page, $total_categories, $items_per_page) {
    $total_pages = ceil($total_categories / $items_per_page);
    
    $links = '';
    if ($current_page > 1) {
        $links .= '<a href="?page=' . ($current_page - 1) . '" class="pagination-btn pagination-prev">Précédent</a>';
    }
    
    if ($current_page < $total_pages) {
        $links .= '<a href="?page=' . ($current_page + 1) . '" class="pagination-btn pagination-next">Suivant</a>';
    }
    
    return $links;
}
?>

