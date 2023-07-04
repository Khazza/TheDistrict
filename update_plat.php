<?php
session_start();

include 'database.php';
include 'DAO.php';

$database = new Database();
$db = $database->getConnection();

$id = $_POST['id'];
$libelle = $_POST['libelle'];
$description = $_POST['description'];
$prix = $_POST['prix'];
$id_categorie = $_POST['id_categorie'];
$active = $_POST['active'];
$image = null;

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $uploadDirectory = 'src/img/food/';
    $uploadFile = $uploadDirectory . basename($_FILES['image']['name']);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
        $image = basename($_FILES['image']['name']);
    } else {
        // Gérer l'erreur de téléchargement
        echo "Erreur lors du téléchargement de l'image.";
    }
}

updatePlat($db, $id, $libelle, $description, $prix, $id_categorie, $active, $image);

$_SESSION['message'] = "La modification a été effectuée avec succès!";

header('Location: admin_dashboard.php');
exit();
?>
