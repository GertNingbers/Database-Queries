<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $_SESSION['medewerker_id'] = filter_var($_POST['med.id'], FILTER_VALIDATE_INT); 
    $_SESSION['medewerker_voornaam'] = $_POST['voornaam'];
    $_SESSION['medewerker_achternaam'] = $_POST['achternaam'];
    $_SESSION['medewerker_email'] = $_POST['email'];
    $_SESSION['medewerker_date_vanaf'] = $_POST['date_vanaf'];
    $_SESSION['medewerker_date_tot'] = $_POST['date_tot'];
    $_SESSION['medewerker_jobtitle'] = $_POST['jobtitle'];
    $_SESSION['medewerker_jobtitle2'] = $_POST['jobtitle2'];
    $_SESSION['medewerker_title'] = $_POST['title'];
    $_SESSION['medewerker_date_tot'] = $_POST['date_tot'];


    try {
        require_once 'dbh.inc.php';

        if (!empty($_SESSION['medewerker_id']) || !empty($_SESSION['medewerker_voornaam']) || !empty($_SESSION['medewerker_achternaam']) || !empty($_SESSION['medewerker_email']) || !empty($_SESSION['medewerker_jobtitle']) || !empty($_SESSION['medewerker_title'])|| !empty($_SESSION['medewerker_jobtitle2']) ) {
            
            $query = 'SELECT * FROM persons WHERE 1=1';


            if (!empty($_SESSION['medewerker_id'])) {
                $query .= ' AND medewerker_id = :medewerker_id';
            }
            if (!empty($_SESSION['medewerker_voornaam'])) {
                $query .= ' AND firstname = :voornaam';
            }
            if (!empty($_SESSION['medewerker_achternaam'])) {
                $query .= ' AND lastname = :achternaam';
            }
            if (!empty($_SESSION['medewerker_email'])) {
                $query .= ' AND email = :email';
            }
            if (!empty($_SESSION['medewerker_title'])) {
                $query .= ' AND title = :title';
            }
            if (!empty($_SESSION['medewerker_jobtitle'])) {
                $query .= ' AND jobtitle = :jobtitle';
            }
            if (!empty($_SESSION['medewerker_jobtitle2'])) {
                $query .= ' AND jobtitle = :jobtitle2';
            }
            $stmt = $pdo->prepare($query);

            if (!empty($_SESSION['medewerker_id'])) {
                $stmt->bindParam(':medewerker_id', $_SESSION['medewerker_id']);
            }
            if (!empty($_SESSION['medewerker_voornaam'])) {
                $stmt->bindParam(':voornaam', $_SESSION['medewerker_voornaam']);
            }
            if (!empty($_SESSION['medewerker_achternaam'])) {
                $stmt->bindParam(':achternaam', $_SESSION['medewerker_achternaam']);
            }
            if (!empty($_SESSION['medewerker_email'])) {
                $stmt->bindParam(':email', $_SESSION['medewerker_email']);
            }
            if (!empty($_SESSION['medewerker_title'])) {
                $stmt->bindParam(':title', $_SESSION['medewerker_title']);
            }
            if (!empty($_SESSION['medewerker_jobtitle'])) {
                $stmt->bindParam(':jobtitle', $_SESSION['medewerker_jobtitle']);
            }if (!empty($_SESSION['medewerker_jobtitle2'])) {
                $stmt->bindParam(':jobtitle2', $_SESSION['medewerker_jobtitle2']);
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
                $_SESSION['created_at'][] = $result['created_at'];
                $_SESSION['updated_at'][] = $result['updated_at'];
            }
        }
        header('location:../home.php');
    } catch (PDOException $e) {

        echo 'Conection failed: ' . $e->getMessage();
    }
} else {
    header('lacation:../home.php');
}
