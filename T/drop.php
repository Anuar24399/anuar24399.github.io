<?php
$db = new PDO('sqlite:' . __DIR__ . '/data.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->exec("DROP TABLE IF EXISTS logins");
$db->exec("DROP TABLE IF EXISTS ing_logins");

echo "Tabellen 'logins' en 'ing_logins' verwijderd!";
?>
