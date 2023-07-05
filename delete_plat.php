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

    // Vérifier si le plat est utilisé dans une commande
    $check_query = "SELECT COUNT(*) as count FROM commande WHERE id_plat = :id";
    $check_stmt = $db->prepare($check_query);
    $check_stmt->bindParam(':id', $id);
    $check_stmt->execute();
    $result = $check_stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        // Le plat est utilisé dans une commande, ne peut pas être supprimé
        $_SESSION['deletion_message'] = "Le plat ne peut pas être supprimé car il fait partie d'une commande.";
    } else {
        // Supprimer le plat
        $query = "DELETE FROM plat WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $_SESSION['deletion_message'] = "Le plat a été supprimé avec succès!";
    }

    header('Location: admin_dashboard.php');
    exit();
}
?>
