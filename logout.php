<?php
session_start();

if (isset($_SESSION['user'])) {
    $_SESSION["logout_success"] = "Déconnexion réussie. À bientôt, " . $_SESSION['user']['nom_prenom'] . "!";
    unset($_SESSION['user']); // Supprimer seulement les informations de l'utilisateur
}

header("Location: index.php");
exit();
?>
