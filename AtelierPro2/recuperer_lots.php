<?php
// Connexion à la base de données
$db = new PDO("mysql:host=localhost;dbname=bddcriee", "root", "");

// Récupération de la date du formulaire
$date = isset($_POST["date"]) ? $_POST["date"] : date("Y-m-d"); // Par défaut, utilise la date actuelle si aucune n'est fournie

// Vérification de l'existence de la date dans la base de données
$query = $db->prepare("SELECT * FROM lot WHERE datePeche = :date");
$query->bindParam(":date", $date);
$query->execute();
$nbLignes = $query->rowCount();

// Création du contenu pour le fichier texte
$content = "Facture du :  $date \n\n";
if ($nbLignes > 0) {
    while ($ligne = $query->fetch()) {
        // Ajout des valeurs dans le contenu du fichier
        $content .= "Numéro du lot : " . $ligne["id"] . " / Numéro Bateau : " . $ligne["idBateau"] . "\n";
    }
    // Retourner le contenu du fichier texte
    echo $content;
} else {
    // Aucun lot trouvé pour la date sélectionnée
    echo "Aucun lot trouvé pour la date sélectionnée.";
}
?>
