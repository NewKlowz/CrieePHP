<?php
// Vérifier si la date a été soumise
if (isset($_POST["date"])) {
    // Connexion à la base de données
    $db = new PDO("mysql:host=localhost;dbname=bddcriee", "root", "");

    // Récupération de la date du formulaire
    $date = $_POST["date"];

    // Formatage de la date pour la requête SQL
    $formattedDate = date("Y-m-d", strtotime($date));

    // Vérification de l'existence de la date dans la base de données
    $query = $db->prepare("SELECT * FROM lot WHERE datePeche = :date");
    $query->bindParam(":date", $formattedDate);
    $query->execute();
    $nbLignes = $query->rowCount();

    // Affichage des lots
    if ($nbLignes > 0) {
        // La date a été sélectionnée
        $options = "";
        while ($ligne = $query->fetch()) {
            $options .= "<option =>Numéro du lot : " . $ligne["id"] . " / Numéro Bateau : " . $ligne["idBateau"] . "</option>";
        }

        // Afficher le formulaire avec les lots
        include("formulaire_lots.php");
    } else {
        // Aucun lot trouvé pour la date sélectionnée
        echo "Aucun lot trouvé pour la date sélectionnée.";
    }
} else {
    // Redirection vers la première page si la date n'a pas été soumise
    header("Location: index.php");
    exit();
}
?>
<script>
document.getElementById('generateButton').addEventListener('click', function() {
            // Récupérer la date entrée par l'utilisateur
            var selectedDate = document.getElementById('date').value;

            // Requête AJAX pour récupérer les lots correspondant à la date sélectionnée
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'recuperer_lots.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Récupérer les données des lots
                        var data = xhr.responseText;

                        // Créer un objet Blob avec les données
                        var blob = new Blob([data], { type: 'text/plain' });

                        // Créer un objet URL à partir du Blob
                        var url = window.URL.createObjectURL(blob);

                        // Créer un élément <a> pour le téléchargement
                        var link = document.createElement('a');
                        link.href = url;
                        link.download = 'lots_' + selectedDate + '.txt'; // Nom du fichier à télécharger

                        // Ajouter l'élément <a> au document
                        document.body.appendChild(link);

                        // Simuler un clic sur le lien pour déclencher le téléchargement
                        link.click();

                        // Supprimer l'élément <a> du document
                        document.body.removeChild(link);

                        // Libérer l'URL de l'objet Blob
                        window.URL.revokeObjectURL(url);
                    } else {
                        console.error('Une erreur s\'est produite lors de la récupération des lots.');
                    }
                }
            };
            xhr.send('date=' + selectedDate); // Envoyer la date sélectionnée
        });
    </script>