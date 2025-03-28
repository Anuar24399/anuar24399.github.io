<?php
// savevermeer.php

// Maak verbinding met de database
$db = new PDO('sqlite:' . __DIR__ . '/data.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Maak de "vermeer"-tabel aan als die nog niet bestaat
$db->exec("CREATE TABLE IF NOT EXISTS vermeer (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    naam TEXT,
    email TEXT,
    opmerking TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)");

// Gegevens ophalen uit het formulier
$naam = $_POST['naam'] ?? '';
$email = $_POST['email'] ?? '';
$opmerking = $_POST['opmerking'] ?? '';

// Voer insert uit als alles ingevuld is
if (!empty($naam) && !empty($email) && !empty($opmerking)) {
    $stmt = $db->prepare("INSERT INTO vermeer (naam, email, opmerking) VALUES (?, ?, ?)");
    $stmt->execute([$naam, $email, $opmerking]);

    // Redirect naar ideal.html
    header("Location: ideal.html");
    exit();
} else {
    echo "Vul alle velden in.";
}
?>