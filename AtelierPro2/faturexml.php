<?php 
// Connexion à la base de données
$db = new PDO("mysql:host=localhost;dbname=bddcriee", "root", "");

// Récupération de tous les lots vendus
$requete = $db->query("SELECT * FROM lot");
$lots = $requete->fetchAll(PDO::FETCH_ASSOC);

foreach ($lots as $lot): ?>
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
    <br>
<?php endforeach; ?>