<?php
session_start();
include 'database.php';
include 'DAO.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $identifier = $_POST['email'];
    $password = $_POST['password'];
    
    $user = loginUser($identifier, $password);
    
    if ($user) {
        $_SESSION['user'] = $user; // Stockez les informations de l'utilisateur dans la session
        $_SESSION["login_success"] = "Connexion réussie! Bienvenue " . $user['nom_prenom'] . ".";
        
        header("Location: index.php");
        exit();
        
    } else {
        
        $_SESSION['error_message'] = "Invalid identifier or password";
        
        header("Location: login.php");
        exit();
        
    }
    
} else {
    header("Location: login.php");
    exit();
}
?>
