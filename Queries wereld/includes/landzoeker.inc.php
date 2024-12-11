<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $land = $_POST['land'];
    $Continent = $_POST['continent'];

    try {
        require 'dbh.inc.php';

            //check hier of alleen land is ingevult of iets anders.
        if (!empty($land) && empty($Continent)) {
            $query = "SELECT * FROM land WHERE landnaam LIKE :land";
            $stmt = $pdo->prepare($query);
            //bindValue zodat ik met 1 letter kan zoeken.
            $stmt->bindValue(':land', $land . '%'); 
            $stmt->execute();

            //haalt alles uit de database en zet het in $results
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($results)) {
                $_SESSION['err'] = 'Geen resultaten gevonden met deze invoer.';
            } else {
                //maak hier een array aan voor later verwerk in de tabel.
                foreach ($results as $result) {
                    $_SESSION['land'] .= " " . $result['landnaam'] . ",";
                    $_SESSION['landcode'] .= " " . $result['landcode'] . ",";
                    $_SESSION['continent'] .= " " . $result['werelddeelcode'] . ",";
                    $_SESSION['vlag_url'] .= " " . $result['vlag_url'] . ",";
                }
                $_SESSION['land'] = rtrim($_SESSION['land'], ',');
                $_SESSION['landcode'] = rtrim($_SESSION['landcode'], ',');
                $_SESSION['continent'] = rtrim($_SESSION['continent'], ',');
                $_SESSION['vlag_url'] = rtrim($_SESSION['vlag_url'], ',');
            }
        }
        elseif (!empty($Continent) && empty($land)) {
            $query = "SELECT * FROM land WHERE werelddeelcode = :continent";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':continent', $Continent);
            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($results)) {
                $_SESSION['err'] = 'Geen resultaten gevonden met deze invoer.';
            } else {
                foreach ($results as $result) {
                    $_SESSION['land'] .= " " . $result['landnaam'] . ",";
                    $_SESSION['landcode'] .= " " . $result['landcode'] . ",";
                    $_SESSION['continent'] .= " " . $result['werelddeelcode'] . ",";
                    $_SESSION['vlag_url'] .= " " . $result['vlag_url'] . ",";
                }
                $_SESSION['land'] = rtrim($_SESSION['land'], ',');
                $_SESSION['landcode'] = rtrim($_SESSION['landcode'], ',');
                $_SESSION['continent'] = rtrim($_SESSION['continent'], ',');
                $_SESSION['vlag_url'] = rtrim($_SESSION['vlag_url'], ',');
            }
        }
        elseif (is_numeric($land)) {
            $_SESSION['err'] = 'Je mag geen nummer invoeren.';
        }
        elseif (!empty($land) && !empty($Continent)) {
            $query = "SELECT * FROM land WHERE landnaam LIKE :land AND werelddeelcode = :continent";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':land', $land . '%'); 
            $stmt->bindParam(':continent', $Continent);
            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($results)) {
                $_SESSION['err'] = 'Geen resultaten gevonden met deze combinatie.';
            } else {
                foreach ($results as $result) {
                    $_SESSION['land'] .= " " . $result['landnaam'] . ",";
                    $_SESSION['landcode'] .= " " . $result['landcode'] . ",";
                    $_SESSION['continent'] .= " " . $result['werelddeelcode'] . ",";
                    $_SESSION['vlag_url'] .= " " . $result['vlag_url'] . ",";
                }
                
                $_SESSION['land'] = rtrim($_SESSION['land'], ',');
                $_SESSION['landcode'] = rtrim($_SESSION['landcode'], ',');
                $_SESSION['continent'] = rtrim($_SESSION['continent'], ',');
                $_SESSION['vlag_url'] = rtrim($_SESSION['vlag_url'], ',');
            }
        } elseif (empty($land) && empty($Continent)){
            $_SESSION['err'] = 'Geen invoer!!!.';
        }

        header('location:../index.php');
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
} else {
    header('location:../index.php');
}
