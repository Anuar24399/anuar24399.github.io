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

// === Als de login correct is, voer dan de drop-operatie uit === //
$db = new PDO('sqlite:' . __DIR__ . '/data.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Verwijder bestaande tabellen
$db->exec("DROP TABLE IF EXISTS logins");
$db->exec("DROP TABLE IF EXISTS ing_logins");

echo "Alle tabellen zijn verwijderd!";
?>
