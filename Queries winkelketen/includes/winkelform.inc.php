<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $_SESSION['medewerker_id'] = $_POST['med_id']; 
    $_SESSION['medewerker_voornaam'] = $_POST['voornaam'];
    $_SESSION['medewerker_achternaam'] = $_POST['achternaam'];
    $_SESSION['medewerker_email'] = $_POST['email'];
    $_SESSION['medewerker_jobtitle'] = $_POST['jobtitle'];
    $_SESSION['medewerker_title'] = $_POST['title'];


    try {
        require 'dbh.inc.php';

        if (!empty($_SESSION['medewerker_id']) || !empty($_SESSION['medewerker_voornaam']) || !empty($_SESSION['medewerker_achternaam']) || !empty($_SESSION['medewerker_email']) || !empty($_SESSION['medewerker_jobtitle']) || !empty($_SESSION['medewerker_title'])) {
            
            $query = 'SELECT * FROM persons WHERE 1=1';


            if (!empty($_SESSION['medewerker_id'])) {
                $query .= ' AND id = :id';
            }
            if (!empty($_SESSION['medewerker_voornaam'])) {
                $query .= ' AND firstname LIKE :voornaam';
            }
            if (!empty($_SESSION['medewerker_achternaam'])) {
                $query .= ' AND lastname LIKE :achternaam';
            }
            if (!empty($_SESSION['medewerker_email'])) {
                $query .= ' AND email LIKE :email';
            }
            if (!empty($_SESSION['medewerker_title'])) {
                $query .= ' AND title = :title';
            }
            if (!empty($_SESSION['medewerker_jobtitle'])) {
                $query .= ' AND jobtitle = :jobtitle';
            }

            if (!empty($_POST['gebouwen'])) {
                $gebouwen = $_POST['gebouwen'];
                $query .= ' AND gebouw_id IN (:gebouwen)';
            }
            $stmt = $pdo->prepare($query);

            if (!empty($_SESSION['medewerker_id'])) {
                $stmt->bindParam(':id', $_SESSION['medewerker_id']);
            }
            if (!empty($_SESSION['medewerker_voornaam'])) {
                $stmt->bindValue(':voornaam', '%' . $_SESSION['medewerker_voornaam'] . '%');
            }
            if (!empty($_SESSION['medewerker_achternaam'])) {
                $stmt->bindValue(':achternaam', '%' . $_SESSION['medewerker_achternaam'] . '%');
            }
            if (!empty($_SESSION['medewerker_email'])) {
                $stmt->bindValue(':email', '%' .  $_SESSION['medewerker_email'] . '%');
            }
            if (!empty($_SESSION['medewerker_title'])) {
                $stmt->bindParam(':title', $_SESSION['medewerker_title']);
            }
            if (!empty($_SESSION['medewerker_jobtitle'])) {
                $stmt->bindParam(':jobtitle', $_SESSION['medewerker_jobtitle']);
            }
            
            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($results as $result) {
                $_SESSION['med.id'][] = $result['id'];
                $_SESSION['voornaam'][] = $result['firstname'];
                $_SESSION['achternaam'][] = $result['lastname'];
                $_SESSION['email'][] = $result['email'];
                $_SESSION['jobtitle'][] = $result['jobtitle'];
                $_SESSION['title'][] = $result['title'];
                $_SESSION['created_at'][] = $result['created_at'];
                $_SESSION['updated_at'][] = $result['updated_at'];
            }
            if (empty($results)) {
                $_SESSION['err'] = 'Geen resultaten gevonden';
            }

        } else {
            $query = 'SELECT * FROM persons';
            $stmt = $pdo->prepare($query);
            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($results as $result) {
                $_SESSION['med.id'][] = $result['id'];
                $_SESSION['voornaam'][] = $result['firstname'];
                $_SESSION['achternaam'][] = $result['lastname'];
                $_SESSION['email'][] = $result['email'];
                $_SESSION['jobtitle'][] = $result['jobtitle'];
                $_SESSION['title'][] = $result['title'];
              
            }
        }
        header('location:../home.php');
    } catch (PDOException $e) {

        echo 'Conection failed: ' . $e->getMessage();
    }
} else {
    header('location:../home.php');
}
