<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $_SESSION['person_id'] = $_POST['person'];
    $_SESSION['building_id'] = $_POST['building'];
    $_SESSION['date_tot'] = $_POST['date_tot'];
    $_SESSION['date_vanaf'] = $_POST['date_vanaf'];
    $_SESSION['uren'] = $_POST['uren'];




    try {
        require 'dbh.inc.php';


        $query = 'SELECT DISTINCT persons.id, persons.firstname, persons.lastname, persons.email, persons.jobtitle, persons.title FROM scans INNER JOIN persons ON scans.person_id = persons.id WHERE 1=1';
        if (!empty($_SESSION['building_id'])) {
            $query .= ' AND scans.building_id = :building_id';
        }
        if (!empty($_SESSION['date_vanaf'])) {
            $query .= ' AND scans.scandate >= :date_vanaf';
        }
        if (!empty($_SESSION['date_tot'])) {
            $query .= ' AND scans.scandate <= :date_tot';
        }
        if (!empty($_SESSION['person_id'])) {
            $query .= ' AND scans.person_id = :person_id';
        }

        $stmt = $pdo->prepare($query);

        if (!empty($_SESSION['building_id'])) {
            $stmt->bindParam(':building_id', $_SESSION['building_id']);
        }
        if (!empty($_SESSION['date_vanaf'])) {
            $stmt->bindParam(':date_vanaf', $_SESSION['date_vanaf']);
        }
        if (!empty($_SESSION['date_tot'])) {
            $stmt->bindParam(':date_tot', $_SESSION['date_tot']);
        }
        if (!empty($_SESSION['person_id'])) {
            $stmt->bindParam(':person_id', $_SESSION['person_id']);
        }
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($results)) {
            $_SESSION['err'] = 'geen resultaten gevonden';
        }

        $query2 = 'SELECT * FROM buildings';
        $stmt2 = $pdo->prepare($query2);
        $stmt2->execute();

        $buildings = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        foreach ($buildings as $building) {
            if ($building['id'] == $_SESSION['building_id']) {
                $_SESSION['building_id'] = $building['id'];
                $_SESSION['building_naam'] = $building['buildingname'];
                $_SESSION['straat'] = $building['street'];
                $_SESSION['buildingnumber'] = $building['buildingnumber'];
                $_SESSION['created_at'] = $building['created_at'];
                $_SESSION['updated_at'] = $building['updated_at'];
            }
        }

        foreach ($results as $result) {
            $_SESSION['med.id'][] = $result['id'];
            $_SESSION['voornaam'][] = $result['firstname'];
            $_SESSION['achternaam'][] = $result['lastname'];
            $_SESSION['email'][] = $result['email'];
            $_SESSION['jobtitle'][] = $result['jobtitle'];
            $_SESSION['title'][] = $result['title'];
        }
        if (!empty($_SESSION['uren'])) {
            $query3 = 'SELECT person_id, scandate, scantime, in_out FROM scans WHERE 1=1';
            if (!empty($_SESSION['building_id'])) {
                $query3 .= ' AND building_id = :building_id';
            }
            if (!empty($_SESSION['date_vanaf'])) {
                $query3 .= ' AND scandate >= :date_vanaf';
            }
            if (!empty($_SESSION['date_tot'])) {
                $query3 .= ' AND scandate <= :date_tot';
            }
            if (!empty($_SESSION['person_id'])) {
                $query3 .= ' AND person_id = :person_id';
            }

            $query3 .= ' ORDER BY person_id, scandate, scantime';

            $stmt3 = $pdo->prepare($query3);
            if (!empty($_SESSION['building_id'])) {
                $stmt3->bindParam(':building_id', $_SESSION['building_id']);
            }
            if (!empty($_SESSION['date_vanaf'])) {
                $stmt3->bindParam(':date_vanaf', $_SESSION['date_vanaf']);
            }
            if (!empty($_SESSION['date_tot'])) {
                $stmt3->bindParam(':date_tot', $_SESSION['date_tot']);
            }
            if (!empty($_SESSION['person_id'])) {
                $stmt3->bindParam(':person_id', $_SESSION['person_id']);
            }
            $stmt3->execute();
            $results2 = $stmt3->fetchAll(PDO::FETCH_ASSOC);


            if (empty($results2)) {
                $_SESSION['err'] = 'geen resultaten gevonden';
            }

            $urenGewerkt = [];

            // Loop door de resultaten
            foreach ($results2 as $result) {
                $personId = $result['person_id'];

                //maakt een datetime object zodat ik de uren kan uitrekenen
                $datetime = new DateTime($result['scandate'] . ' ' . $result['scantime']);

                // Controleer of de persoon al in de array zit
                if (!isset($urenGewerkt[$personId])) {
                    $urenGewerkt[$personId] = 0;
                }

                // Als het in is voeg het toe aan de incheck array
                if ($result['in_out'] === 'in') {
                    $incheckTijden[$personId][] = $datetime;
                } elseif ($result['in_out'] === 'out') {
                    // Als het een uitcheck is, controleer of er een bijbehorende incheck is
                    if (isset($incheckTijden[$personId]) && !empty($incheckTijden[$personId])) {

                        // Haalt de laatste inchecktijd
                        $incheckTijd = array_pop($incheckTijden[$personId]);

                        // Bereken het verschil $datetime is nu out
                        $interval = $incheckTijd->diff($datetime);

                        // zet de uren er in
                        $urenGewerkt[$personId] += $interval->format('%d') * 24 + $interval->format('%H');
                    }
                }
            }
            $_SESSION['urenGewerkt'] = $urenGewerkt;
        }

        header('location: ../building.php');
        die();
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
} else {
    header('location: ../building.php');
}
