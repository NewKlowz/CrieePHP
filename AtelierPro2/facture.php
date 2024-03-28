<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Assurez-vous que le chemin est correct selon votre configuration

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération des données du formulaire
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $date = isset($_POST["date"]) ? $_POST["date"] : "";
    $selectedLots = isset($_POST["lots"]) ? $_POST["lots"] : [];

    // Validation des données (ajoutez vos propres validations si nécessaire)
    if (empty($email) || empty($date) || empty($selectedLots)) {
        echo "Veuillez remplir tous les champs.";
        exit();
    }

    // Création du fichier XML
    $xml = new DOMDocument('1.0', 'utf-8');
    $xml->formatOutput = true;

    $facture = $xml->createElement('facture');
    $facture->setAttribute('date', $date);

    // Correction ici : vérifiez si $selectedLots est un tableau avant de l'itérer
    if (is_array($selectedLots)) {
        foreach ($selectedLots as $lot) {
            $lotElement = $xml->createElement('lot');
            $lotElement->setAttribute('id', $lot);
            $facture->appendChild($lotElement);
        }
    }

    $xml->appendChild($facture);

    // Sauvegarde du fichier XML
    $xml->save('facture.xml');

    // Utilisation de PHPMailer pour envoyer l'e-mail
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com.'; // Adresse SMTP de votre serveur de messagerie
        $mail->SMTPAuth   = true;
        $mail->Username   = 'arthurtestpourlycee@gmail.com'; // Votre adresse e-mail
        $mail->Password   = 'votre_mot_de_passe'; // Votre mot de passe SMTP
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        //Destinataire
        $mail->setFrom('arthurtestpourlycee@gmail.com', 'Votre Nom');
        $mail->addAddress($email);

        // Pièce jointe : le fichier XML
        $mail->addAttachment('facture.xml', 'facture.xml');

        //Contenu du message
        $mail->isHTML(true);
        $mail->Subject = "Facture pour la date $date";
        $mail->Body    = "Veuillez trouver la facture en pièce jointe.";

        $mail->send();

        echo "Facture générée et envoyée avec succès.";
    } catch (Exception $e) {
        echo "Erreur lors de l'envoi de l'e-mail. Message d'erreur : {$mail->ErrorInfo}";
    }
} else {
    // Redirection si la page est accédée directement sans méthode POST
    header("Location: index.php");
    exit();
}
?>
