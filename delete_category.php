<?php
session_start();
include 'database.php';
include 'DAO.php';

if (!isset($_SESSION['user']['nom_prenom']) || $_SESSION['user']['role'] !== 'admin') {
    // Rediriger vers la page de connexion ou une page d'erreur
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $database = new Database();
    $db = $database->getConnection();

    // Supprimer la catégorie
    $query = "DELETE FROM categorie WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header('Location: admin_dashboard.php');
    exit();
}
?>
