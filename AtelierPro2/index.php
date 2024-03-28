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
      <li><a href="afficher_tout_les_lots.php">Afficher tous les lots</a></li>
    </ul>
  </nav>
  <br>
  <header>
    <h1>Facturation</h1>
  </header>
  <main>
    <form action="afficher_lots.php" method="post">
      <fieldset>
        <legend>Sélectionner une date</legend>
        <div class="form-group">
          <label for="date">Date</label>
          <input type="date" id="date" name="date" required>
        </div>
      </fieldset>
      <input type="submit" value="Afficher les lots">
    </form>
  </main>
  <footer>
    <p>Copyright &copy; 2023</p>
  </footer>
</body>
</html>
