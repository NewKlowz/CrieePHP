<?php
    // Connexion à la base de données
    $db = new PDO("mysql:host=localhost;dbname=bddcriee", "root", "");

    // Récupération des données du formulaire
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $date = isset($_POST["date"]) ? $_POST["date"] : "";
    $lots = isset($_POST["lots"]) ? $_POST["lots"] : "";

    // Vérification de la validité de la date
    $dateParts = date_parse_from_format("d/m/Y", $date);
    if (!$dateParts || !checkdate($dateParts["month"], $dateParts["day"], $dateParts["year"])) {
        // La date n'est pas valide
        echo "La date sélectionnée n'est pas valide.";
        return;
    }

    // Formatage de la date pour la requête SQL
    $formattedDate = $dateParts["year"] . "-" . $dateParts["month"] . "-" . $dateParts["day"];

    // Vérification de l'existence de la date dans la base de données
    $query = $db->prepare("SELECT * FROM lot WHERE datePeche = :date");
    $query->bindParam(":date", $formattedDate);
    $query->execute();
    $nbLignes = $query->rowCount();

    // Affichage des lots
    if (!empty($date)) {
        // La date a été sélectionnée
        $options = "";
        while ($ligne = $query->fetch()) {
            $options .= "<option value='" . $ligne["id"] . "'>" . $ligne["nom"] . "</option>";
        }

        echo $options;
    } else {
        // La date n'a pas été sélectionnée
        echo "Veuillez sélectionner une date avant de choisir des lots.";
    }
?>
