<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'database.php';
require_once 'vendor/autoload.php';

// Récupération des données du formulaire
$plat_id = $_POST['id_plat'];
$quantite = $_POST['quantite'];
$nom_client = $_POST['nom_prenom'];
$email_client = $_POST['email'];
$telephone_client = $_POST['telephone'];
$adresse_client = $_POST['adresse'];

// Calcul du total
$prix = ...;
$total = $prix * $quantite;

// Insertion dans la base de données
$query = "INSERT INTO commande (id_plat, quantite, total, date_commande, etat, nom_client, telephone_client, email_client, adresse_client) VALUES (?, ?, ?, NOW(), 'en attente', ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("iidsssss", $plat_id, $quantite, $total, $nom_client, $telephone_client, $email_client, $adresse_client);
$stmt->execute();

// Configuration de PHPMailer
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'localhost';
$mail->SMTPAuth = false;
$mail->Port = 1025;

$mail->setFrom('from@thedistrict.com', 'The District Company');
$mail->addAddress($email_client, $nom_client);

$mail->isHTML(true);
$mail->Subject = 'Confirmation de commande';
$mail->Body    = 'Merci pour votre commande! Votre commande est en attente et sera traitée prochainement.';

try {
    $mail->send();
    echo 'Email envoyé avec succès';
} catch (Exception $e) {
    echo "L'envoi de mail a échoué. L'erreur suivante s'est produite : ", $mail->ErrorInfo;
}

header('Location: orders.php'); // Rediriger vers la page de commande
?>
