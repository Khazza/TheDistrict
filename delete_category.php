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

    // Vérifier si la catégorie contient des plats
    $check_plats_query = "SELECT COUNT(*) as count FROM plat WHERE id_categorie = :id";
    $check_plats_stmt = $db->prepare($check_plats_query);
    $check_plats_stmt->bindParam(':id', $id);
    $check_plats_stmt->execute();
    $result_plats = $check_plats_stmt->fetch(PDO::FETCH_ASSOC);

    if ($result_plats['count'] > 0) {
        // La catégorie contient des plats, ne peut pas être supprimée
        $_SESSION['deletion_message'] = "La catégorie ne peut pas être supprimée car elle contient des plats.";
    } else {
        // Vérifier si un plat de cette catégorie est utilisé dans une commande
        $check_query = "SELECT COUNT(*) as count FROM commande c JOIN plat p ON c.id_plat = p.id WHERE p.id_categorie = :id";
        $check_stmt = $db->prepare($check_query);
        $check_stmt->bindParam(':id', $id);
        $check_stmt->execute();
        $result = $check_stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            // Un plat de cette catégorie est utilisé dans une commande, ne peut pas être supprimée
            $_SESSION['deletion_message'] = "La catégorie ne peut pas être supprimée car un plat de cette catégorie fait partie d'une commande.";
        } else {
            // Supprimer la catégorie
            $query = "DELETE FROM categorie WHERE id = :id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $_SESSION['deletion_message'] = "L'élément a été supprimé avec succès!";
        }
    }

    header('Location: admin_dashboard.php');
    exit();
}
?>
