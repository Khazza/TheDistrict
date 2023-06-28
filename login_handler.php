<?php
session_start();
include 'database.php';
include 'DAO.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $identifier = $_POST['username'];
    $password = $_POST['password'];
    
    $user = loginUser($identifier, $password);
    
    if ($user) {
        $_SESSION['user'] = $user; // Stockez les informations de l'utilisateur dans la session
        
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
