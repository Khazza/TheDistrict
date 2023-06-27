<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'database.php';
require_once 'DAO.php';
require_once 'vendor/autoload.php';

$database = new Database();
$db = $database->getConnection();

// Récupération des données du formulaire
$plat_id = $_POST['id_plat'];
$quantite = $_POST['quantite'];
$nom_client = $_POST['nom_prenom'];
$email_client = $_POST['email'];
$telephone_client = $_POST['telephone'];
$adresse_client = $_POST['adresse'];

// Récupération du prix du plat en utilisant la fonction dans DAO.php
$prix = get_plat_prix($db, $plat_id);
if ($prix === null) {
    die("Erreur lors de la récupération du prix du plat.");
}

// Calcul du total
$total = $prix * $quantite;

// Insertion dans la base de données en utilisant la fonction dans DAO.php
insert_order($db, $plat_id, $quantite, $total, $nom_client, $telephone_client, $email_client, $adresse_client);

// Configuration de PHPMailer
$mail = new PHPMailer(true);
$mail->CharSet="utf-8";
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
