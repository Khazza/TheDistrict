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
        <meta name="description" content="The District, restaurant et commande en ligne de divers spécialités comme burgers, pizzas, pastas, salades">
        <meta name="keywords" content="Commande, Restaurant, District, Burger, Pizza, Pasta">
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
        <nav class="navbar navbar-expand-lg navbar-dark bg-light">
            <a class="navbar-brand ms-3" href=""><img src="../src/img/the_district_brand/logo_transp.png" alt="Logo" height="60"></a>

            <!-- Bouton de basculement -->
            <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Liens de la barre de navigation -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto mx-2">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $current_page === 'index.php' ? 'active' : ''; ?>" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $current_page === 'categories.php' ? 'active' : ''; ?>" href="categories.php">Catégories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $current_page === 'plats.php' ? 'active' : ''; ?>" href="plats.php">Plats</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $current_page === 'contact.php' ? 'active' : ''; ?>" href="contact.php">Contact</a>
                    </li>
                </ul>
                <!-- Search bar hidden on larger screens -->
                <form action="search.php" method="get" class="d-lg-none my-3">
                    <div class="input-group w-75 mx-2">
                        <input type="text" name="query" class="form-control" placeholder="Recherche..." aria-label="Recherche...">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary mx-1" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>

                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['user'])) : ?>
                        <li class="nav-item d-flex align-items-center">
                            <span class="nav-message">Bonjour, <?php echo htmlspecialchars($_SESSION['user']['nom_prenom']); ?></span>
                        </li>
                        <?php if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin') : ?>
                            <li class="nav-item d-flex align-items-center">
                                <a class="btn custom-dashboard-btn" href="admin_dashboard.php">Tableau de bord</a>
                            </li>
                        <?php endif; ?>

                        <li class="nav-item d-flex align-items-center">
                            <a class="btn custom-logoff-btn" href="logout.php">Se déconnecter</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="btn custom-login-btn my-1" href="login.php">S'identifier</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn custom-signup-btn my-1" href="signup.php">S'enregistrer</a>
                        </li>
                    <?php endif; ?>
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
            <div class="container d-flex align-items-center justify-content-between h-100 flex-md-row flex-column">
                <div class="text-md-start text-center mb-md-0 mb-3">
                    <a href="../legal-notice.php" class="mr-auto footer-link text-sm <?php echo $current_page === 'legal-notice.php' ? 'active' : ''; ?>">Mentions légales</a> <!-- Lien vers Mentions légales -->
                    <a href="../privacy-policy.php" class="mr-auto footer-link text-sm <?php echo $current_page === 'privacy-policy.php' ? 'active' : ''; ?>">Politique de confidentialité</a> <!-- Lien vers Politique de confidentialité -->
                </div>
                <div class="text-md-end text-center">
                    <a href="#" class="ms-3"><i class="fab fa-facebook fa-lg"></i></a>
                    <a href="#" class="ms-3"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="#" class="ms-3"><i class="fab fa-instagram fa-lg"></i></a>
                </div>
        </footer>

        <!-- Bootstrap JS, jQuery -->
        <script src="./js/script.js"></script>
        <!-- Inclusion de SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
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
function generate_pagination_links($current_page, $total_categories, $items_per_page)
{
    $total_pages = ceil($total_categories / $items_per_page);

    $links = '';
    if ($current_page > 1) {
        $links .= '<a href="?page=' . ($current_page - 1) . '" class="pagination-btn pagination-prev">Précédent</a>';
    }

    // Vérifiez si c'est la dernière page
    if ($current_page < $total_pages) {
        $links .= '<a href="?page=' . ($current_page + 1) . '" class="pagination-btn pagination-next">Suivant</a>';
    }

    return $links;
}
?>