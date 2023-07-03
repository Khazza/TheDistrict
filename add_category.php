<?php
session_start();
include 'database.php';
include 'DAO.php';

$libelle = $_POST['libelle'];
$active = $_POST['active'];

$targetDir = "src/img/category/";
$fileName = basename($_FILES["image"]["name"]);
$targetFile = $targetDir . $fileName;

if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
    $database = new Database();
    $db = $database->getConnection();

    addCategory($db, $libelle, $active, $fileName);

    header('Location: admin_dashboard.php');
    exit();
} else {
    echo "Désolé, il y a eu une erreur lors du téléchargement de votre fichier.";
}
?>
