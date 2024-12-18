<?php

$dsn = 'mysql:host=localhost;dbname=winkelketen';
$dbuser = 'root';
$dbpwd = '';

try {
    $pdo = new PDO($dsn, $dbuser, $dbpwd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

header('location:../home.php');
