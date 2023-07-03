<?php
session_start();
include 'database.php';
include 'DAO.php';

$libelle = $_POST['libelle'];
$active = $_POST['active'];

$targetDir = "src/img/category/";
$targetFile = $targetDir . basename($_FILES["image"]["name"]);

if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
    $database = new Database();
    $db = $database->getConnection();

    addCategory($db, $libelle, $active, $targetFile);

    header('Location: admin_dashboard.php');
    exit();
} else {
    echo "Désolé, il y a eu une erreur lors du téléchargement de votre fichier.";
}
?>
