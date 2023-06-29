<?php
session_start();
include 'database.php';
include 'DAO.php';

$database = new Database();
$db = $database->getConnection();

// Utilisez $_GET au lieu de $_POST pour récupérer l'ID à partir de l'URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    deletePlat($db, $id);
    // Rediriger vers la page admin_dashboard.php après la suppression
    header('Location: admin_dashboard.php');
} else {
    // Gérer le cas où l'ID n'est pas défini
    echo "ID non défini";
}
?>
