<?php
session_start();
include 'database.php';
include 'DAO.php';

$libelle = $_POST['libelle'];
$active = $_POST['active'];

$database = new Database();
$db = $database->getConnection();

addCategory($db, $libelle, $active);

header('Location: admin_dashboard.php');
exit();
?>
