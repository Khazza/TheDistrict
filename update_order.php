<?php
session_start();
include 'database.php';
include 'DAO.php';

// Vérifier si l'utilisateur est un administrateur
if (!isset($_SESSION['user']['nom_prenom']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Vérifie si la requête est de type POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $id = $_POST['id'];
    $quantite = $_POST['quantite'];
    $total = $_POST['total'];
    $etat = $_POST['etat'];

    // Mettre à jour la commande
    update_order($id, $quantite, $total, $etat);

    // Rediriger vers le tableau de bord administrateur avec un message de succès
    $_SESSION['message'] = 'Commande mise à jour avec succès';
    header("Location: admin_dashboard.php");
    exit();
} else {
    // Rediriger en cas d'accès non autorisé
    header("Location: admin_dashboard.php");
    exit();
}
