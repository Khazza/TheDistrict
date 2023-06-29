<?php
session_start();
include 'database.php';
include 'DAO.php';

$database = new Database();
$db = $database->getConnection();

$id = $_POST['id'];
$libelle = $_POST['libelle'];
$active = $_POST['active'];

updateCategory($db, $id, $libelle, $active);
// Redirection vers la page admin_dashboard.php
header('Location: admin_dashboard.php');
exit();
?>
