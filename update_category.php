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
    // Il y a un fichier image à télécharger
    $image = file_get_contents($_FILES['image']['tmp_name']);
}

updateCategory($db, $id, $libelle, $active, $image);

// Redirection vers la page admin_dashboard.php
header('Location: admin_dashboard.php');
exit();
?>
