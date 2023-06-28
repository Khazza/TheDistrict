<?php

// Demarrez la session
session_start();
include 'database.php';
include 'DAO.php';

// Vérifier si la méthode de requête est POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Récupérer l'identifiant (email ou nom d'utilisateur) et le mot de passe de la requête POST
    $identifier = $_POST['identifier'];
    $password = $_POST['password'];
    
    // Appeler la fonction loginUser pour vérifier les informations d'identification
    if (loginUser($identifier, $password)) {
        
        // Rediriger l'utilisateur vers la page d'accueil si la connexion est réussie
        header("Location: /path_to_your_homepage");
        exit();
        
    } else {
        
        // Stocker un message d'erreur dans la session
        $_SESSION['error_message'] = "Invalid identifier or password";
        
        // Rediriger l'utilisateur vers la page de connexion avec un message d'erreur
        header("Location: /path_to_your_login_page");
        exit();
        
    }
    
} else {
    
    // Rediriger vers la page de connexion si la méthode de requête n'est pas POST
    header("Location: /path_to_your_login_page");
    exit();
    
}
?>
