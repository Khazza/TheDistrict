<?php
session_start();
include 'database.php';
include 'DAO.php';

$libelle = $_POST['libelle'];
$description = $_POST['description'];
$prix = $_POST['prix'];
$active = $_POST['active'];
$id_categorie = $_POST['id_categorie'];

$database = new Database();
$db = $database->getConnection();

addPlat($db, $libelle, $description, $prix, $active, $id_categorie);

header('Location: admin_dashboard.php');
exit();
?>
