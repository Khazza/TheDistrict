<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';

// Récupération des données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$demande = $_POST['demande'];

// Construire le message
$message = "Nouveau message de contact: <br>";
$message .= "Nom: $nom <br>";
$message .= "Prénom: $prenom <br>";
$message .= "Email: $email <br>";
$message .= "Téléphone: $telephone <br>";
$message .= "Demande: <br> $demande";

// Configuration de PHPMailer
$mail = new PHPMailer(true);
$mail->CharSet = "utf-8";
$mail->isSMTP();
$mail->Host = 'localhost';
$mail->SMTPAuth = false;
$mail->Port = 1025; // Changez ceci si vous utilisez un port différent pour Mailtrap/Mailhog

$mail->setFrom($email, "$nom $prenom");
$mail->addAddress('from@district.com');

$mail->isHTML(true);
$mail->Subject = 'Nouveau message de contact';
$mail->Body    = $message;

try {
    $mail->send();
    // Redirigez vers une page de remerciement ou affichez un message de succès
    header("Location: merci.php");
} catch (Exception $e) {
    // Afficher un message d'erreur
    echo "Une erreur s'est produite lors de l'envoi de l'e-mail. L'erreur suivante s'est produite : " . $mail->ErrorInfo;
}

?>
