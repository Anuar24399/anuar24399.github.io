<?php
$db = new PDO('sqlite:' . __DIR__ . '/data.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->exec("DROP TABLE IF EXISTS logins");
echo "Tabel 'logins' verwijderd!";
?>
