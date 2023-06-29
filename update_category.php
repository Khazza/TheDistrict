<?php
session_start();
include 'database.php';
include 'DAO.php';

$database = new Database();
$db = $database->getConnection();

$id = $_POST['id'];
$libelle = $_POST['libelle'];
$image = $_POST['image'];
$active = $_POST['active'];

updateCategory($db, $id, $libelle, $image, $active);
?>
