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

updatePlat($db, $id, $libelle, $description, $prix, $id_categorie, $active);
?>
