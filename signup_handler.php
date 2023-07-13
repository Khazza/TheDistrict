<?php
session_start();
include 'database.php';
include 'DAO.php';

// Vérification du jeton CSRF
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    $_SESSION['errors'][] = "CSRF token validation failed.";
    header("Location: signup.php");
    exit();
}

// Vérification des champs
$nom_prenom = htmlspecialchars($_POST['nom_prenom']); // Échappement des caractères spéciaux
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL); // Validation de l'adresse e-mail
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if (strlen($password) < 5) {
    $_SESSION['errors'][] = "Le mot de passe doit comporter au moins 5 caractères.";
}
if (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password)) {
    $_SESSION['errors'][] = "Le mot de passe doit contenir au moins une lettre majuscule et une lettre minuscule.";
}
if ($password !== $confirm_password) {
    $_SESSION['errors'][] = "Les mots de passe ne correspondent pas.";
}

// Vérification si l'email est valide
if (!$email) {
    $_SESSION['errors'][] = "L'adresse e-mail n'est pas valide.";
}

// Vérification si l'email est déjà pris
if (userExists($pdo, $email)) {
    $_SESSION['errors'][] = "L'email est déjà pris.";
    header("Location: signup.php");
    exit();
}

// Si des erreurs ont été détectées, redirection vers signup.php
if (!empty($_SESSION['errors'])) {
    header("Location: signup.php");
    exit();
}

// Si tout est correct, ajouter l'utilisateur à la base de données
if (registerUser($pdo, $nom_prenom, $email, $password)) {
    // Connexion de l'utilisateur et création de la nouvelle session
    $user = loginUser($email, $password);
    $_SESSION['user'] = $user;

    $_SESSION["register_success"] = "Inscription réussie! Vous êtes maintenant connecté.";
    header("Location: index.php");
    exit();
} else {
    $_SESSION["errors"][] = "Erreur lors de l'inscription. Veuillez réessayer.";
    header("Location: signup.php");
    exit();
}
?>
