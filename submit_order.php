<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'database.php';
require_once 'DAO.php';
require_once 'vendor/autoload.php';

// Récupération des données du formulaire
$plat_id = $_POST['id_plat'];
$quantite = $_POST['quantite'];
$nom_client = $_POST['nom_prenom'];
$email_client = $_POST['email'];
$telephone_client = $_POST['telephone'];
$adresse_client = $_POST['adresse'];

// Créer une connexion à la base de données
$database = new Database();
$db = $database->getConnection();

// Récupération du prix du plat
$prix = get_plat_prix($db, $plat_id);

// Calcul du total
$total = $prix * $quantite;

// Insertion dans la base de données
insert_order($db, $plat_id, $quantite, $total, $nom_client, $telephone_client, $email_client, $adresse_client);

// Construire le résumé de la commande
$order_summary = "Résumé de votre commande: \n";
$order_summary .= "Nom: $nom_client \n";
$order_summary .= "Email: $email_client \n";
$order_summary .= "Téléphone: $telephone_client \n";
$order_summary .= "Adresse: $adresse_client \n";
$order_summary .= "ID du plat: $plat_id \n";
$order_summary .= "Quantité: $quantite \n";
$order_summary .= "Prix unitaire: $prix \n";
$order_summary .= "Total: $total \n";

// Configuration de PHPMailer
$mail = new PHPMailer(true);
$mail->CharSet="utf-8";
$mail->isSMTP();
$mail->Host = 'localhost';
$mail->SMTPAuth = false;
$mail->Port = 1025;

$mail->setFrom('from@thedistrict.com', 'The District Company');
$mail->addAddress($email_client, $nom_client);

$mail->isHTML(true); // Si vous voulez utiliser du HTML à la place du texte brut, changez ceci en true
$mail->Subject = 'Confirmation de commande';
$mail->Body    = $order_summary;

try {
    $mail->send();
    echo 'Email envoyé avec succès';
} catch (Exception $e) {
    echo "L'envoi de mail a échoué. L'erreur suivante s'est produite : ", $mail->ErrorInfo;
}

// Rediriger vers la page de commande pour le plat spécifique
header("Location: orders.php?id=$plat_id");
exit;
?>
