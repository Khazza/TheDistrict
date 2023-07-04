<?php
session_start();
include 'database.php';
include 'DAO.php';

// Vérifier si l'utilisateur est un administrateur
if (!isset($_SESSION['user']['nom_prenom']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Vérifie si l'ID de la commande est fourni
if (isset($_GET['id'])) {
    // Récupérer l'ID de la commande
    $id = $_GET['id'];

    // Supprimer la commande
    delete_order($id);

    // Rediriger vers le tableau de bord administrateur avec un message de succès
    $_SESSION['message'] = 'Commande supprimée avec succès';
    header("Location: admin_dashboard.php");
    exit();
} else {
    // Rediriger en cas d'accès non autorisé
    header("Location: admin_dashboard.php");
    exit();
}
