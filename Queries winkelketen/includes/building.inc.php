<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $_SESSION['building_id'] = $_POST['building'];


    try {
        require_once 'dbh.inc.php';
        //$_SESSION['date_tot'] = $_POST['date_tot'];
        //$_SESSION['date_vanaf'] = $_POST['date_vanaf'];
        //$_SESSION['uren_tot'] = $_POST['uren_tot'];
        //$_SESSION['uren_vanaf'] = $_POST['uren_vanaf'];

        $query = 'SELECT DISTINCT persons.*, scans.building_id FROM scans INNER JOIN persons ON scans.person_id = persons.id WHERE 1=1 AND scans.building_id = :building_id';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':building_id', $_SESSION['building_id']);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $query2 = 'SELECT * FROM buildings';
        $stmt2 = $pdo->prepare($query2);
        $stmt2->execute();

        $buildings = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        foreach ($results as $result) {
            foreach ($buildings as $building) {
                if ($building['id'] == $result['building_id']) {
                    $_SESSION['building_id'][] = $building['id'];
                    $_SESSION['building_naam'][] = $building['buildingname'];
                    $_SESSION['straat'][] = $building['street'];
                    $_SESSION['buildingnumber'][] = $building['buildingnumber'];
                    $_SESSION['created_at'][] = $building['created_at'];
                    $_SESSION['updated_at'][] = $building['updated_at'];
                }
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
        header('location: ../building.php');
        die();
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
} else {
    header('location: ../building.php');
}
