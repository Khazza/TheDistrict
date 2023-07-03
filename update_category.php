<?php
session_start();
include 'database.php';
include 'DAO.php';

$database = new Database();
$db = $database->getConnection();

$id = $_POST['id'];
$libelle = $_POST['libelle'];
$active = $_POST['active'];
$image = null;

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $uploadDirectory = 'src/img/category/';
    $uploadFile = $uploadDirectory . basename($_FILES['image']['name']);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
        $image = basename($_FILES['image']['name']);
    } else {
        // Gérer l'erreur de téléchargement
        echo "Erreur lors du téléchargement de l'image.";
    }
}

updateCategory($db, $id, $libelle, $active, $image);

// Redirection vers la page admin_dashboard.php
header('Location: admin_dashboard.php');
exit();
?>
