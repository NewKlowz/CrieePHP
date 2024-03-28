<?php
// Connexion à la base de données
$db = new PDO("mysql:host=localhost;dbname=bddcriee", "root", "");

// Récupération de tous les lots vendus
$requete = $db->query("SELECT * FROM lot");
$lots = $requete->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="afficherlots.css">
    <title>Liste des lots vendus</title>
</head>
<body>
  <nav>
    <ul>
      <li><a href="index.php">Générer une facture</a></li>
    </ul>
    <br>
  </nav>
  <header>
    <h1>Afficher tout les lots</h1>
  </header>

<div class="container mt-12" id="affichertout">
    <?php if (!empty($lots)): ?>
        <h2>Liste des lots vendus :</h2>
        <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date de pêche</th>
                <th>ID Bateau</th>
                <th>ID Espèce</th>
                <th>ID Taille</th>
                <th>ID Présentation</th>
                <th>ID Qualité</th>
                <th>ID Bac</th>
                <th>Poids Brut du Lot</th>
                <th>Prix d'Enchère</th>
                <th>Date d'Enchère</th>
                <th>Heure de Début d'Enchère</th>
                <th>Prix Plancher</th>
                <th>Prix de Départ</th>
                <th>Code Etat</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lots as $lot): ?>
                <tr>
                    <td><?= $lot['id'] ?></td>
                    <td><?= $lot['datePeche'] ?></td>
                    <td><?= $lot['idBateau'] ?></td>
                    <td><?= $lot['idEspece'] ?></td>
                    <td><?= $lot['idTaille'] ?></td>
                    <td><?= $lot['idPresentation'] ?></td>
                    <td><?= $lot['idQualite'] ?></td>
                    <td><?= $lot['idBac'] ?></td>
                    <td><?= $lot['poidsBrutLot'] ?></td>
                    <td><?= $lot['prixEnchere'] ?></td>
                    <td><?= $lot['dateEnchere'] ?></td>
                    <td><?= $lot['HeureDebutEnchere'] ?></td>
                    <td><?= $lot['prixPlancher'] ?></td>
                    <td><?= $lot['prixDepart'] ?></td>
                    <td><?= $lot['codeEtat'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
    <?php else: ?>
        <p>Aucun lot vendu trouvé.</p>
    <?php endif; ?>
</div>
<footer>
    <br>
    <h2 id="footeraffichertout">Voici tout les lots existant</h2>
</footer>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>