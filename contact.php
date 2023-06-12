<?php
include 'database.php';
include 'DAO.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The District - Restaurant et Commande en Ligne</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <!-- Navbar -->
    <?php include './template/header.php'; ?>

    <!-- Search Bar Background Image -->
    <div class="search-bar" style="background-image: url('./src/img/bg3.jpeg');">
        <div class="container text-center">
            <input type="text" class="search-input" placeholder="Recherche...">
        </div>
    </div>

        <!-- Footer Social Media -->
        <?php include './template/footer.php'; ?>

        <!-- Bootstrap JS, jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>