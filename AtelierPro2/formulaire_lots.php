<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Facturation</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <nav>
    <ul>
      <li><a href="index.php">Générer une facture</a></li>
      <li><a href="afficher_tout_les_lots.php">Afficher tout les lots</a></li>
    </ul>
  </nav>
  <header>
    <h1>Afficher tout les lots</h1>
  </header>
  <main>
    <form action="generation.php" method="post">
      <fieldset>
        <legend>Factures</legend>
        <div class="form-group">
          <label for="date">Date</label>
          <input type="date" id="date" name="date" value="<?php echo $date; ?>" readonly>
        </div>
      </fieldset>
      <fieldset>
        <legend>Lots vendus</legend>
        <div class="form-group">
          <label for="lots">Lots</label>
          <select id="lots" name="lots" multiple required>
            <?php echo $options; ?>
          </select>
        </div>
      </fieldset>
      <input id="generateButton" type="submit" value="Générer la facture">
    </form>
  </main>
  <footer>
    <p>Copyright &copy; 2023</p>
  </footer>
</body>
</html>
