<?php

session_start();
$land = "";
$Continent = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $land = $_POST['land'];
    $Continent = $_POST['continent'];

    try {
        require_once 'dbh.inc.php';

        if (isset($land) && isset($Continent)) {

            $query = "SELECT * FROM land WHERE landnaam = :land AND werelddeelcode = :continent";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':land', $land);
            $stmt->bindParam(':continent', $Continent);
            $stmt->execute();

            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($results == false) {
                $_SESSION['err'] = 'Geen resultaten gevonden.1';
            } else {
                $_SESSION['land'] = "Het gevonden land is " . $results['landnaam'] . ".";
                $_SESSION['landcode'] = "De land afkorting is " . $results['landcode'] . ".";
                $_SESSION['continent'] = "In de continent " . $results['werelddeelcode'] . ".";
            }
        }
        if (isset($land) && !isset($Continent)) {

            $query = "SELECT * FROM land WHERE landnaam = :land";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':land', $land);
            $stmt->execute();

            $results = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($results == false) {
                $_SESSION['err'] = 'Geen resultaten gevonden.2';
            } else {
                $_SESSION['land'] = "Het gevonden land is " . $results['landnaam'] . ".";
                $_SESSION['landcode'] = "De land afkorting is " . $results['landcode'] . ".";
                $_SESSION['continent'] = "In de continent " . $results['werelddeelcode'] . ".";
            }
        }
        if (isset($Continent) && !isset($land)) {

            $query = "SELECT * FROM land WHERE werelddeelcode = :continent";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':continent', $Continent);
            $stmt->execute();

            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($results == false) {
                $_SESSION['err'] = 'Geen resultaten gevonden.3';
            } else {
                $_SESSION['land'] = "Het gevonden land is " . $results['landnaam'] . ".";
                $_SESSION['landcode'] = "De land afkorting is " . $results['landcode'] . ".";
                $_SESSION['continent'] = "In de continent " . $results['werelddeelcode'] . ".";
            }
        }
        if (is_numeric($land)) {

            $_SESSION['err'] = 'Je mag geen nummer invoeren.';
        }


        header('location:../index.php');
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
} else {
    header('location:../index.php');
}
