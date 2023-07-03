<?php
session_start();
include 'database.php';
include 'DAO.php';

$libelle = $_POST['libelle'];
$description = $_POST['description'];
$prix = $_POST['prix'];
$active = $_POST['active'];
$id_categorie = $_POST['id_categorie'];

$targetDir = "src/img/food/";
$targetFile = $targetDir . basename($_FILES["image"]["name"]);

if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
    $database = new Database();
    $db = $database->getConnection();

    addPlat($db, $libelle, $description, $prix, $active, $id_categorie, $targetFile);

    header('Location: admin_dashboard.php');
    exit();
} else {
    echo "Désolé, il y a eu une erreur lors du téléchargement de votre fichier.";
}
?>
