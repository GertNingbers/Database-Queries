<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //filter de invoer
    $land = filter_var($_POST['land'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $Continent = $_POST['continent'];


    try {
        require 'dbh.inc.php';

        //hier controleer ik of bijde velden zijn ingevult.
        if (!empty($land) && !empty($Continent)) {
            $query = "SELECT * FROM land WHERE landnaam LIKE :land AND werelddeelcode = :continent";
            $stmt = $pdo->prepare($query);

            //bindValue zodat ik met 1 letter kan zoeken.
            $stmt->bindValue(':land', '%' . $land . '%');
            $stmt->bindParam(':continent', $Continent);
            $stmt->execute();

            //haalt alles uit de database en zet het in $results
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($results)) {
                $_SESSION['err'] = 'Geen resultaten gevonden met deze combinatie.';
            } else {
                $query2 = "SELECT * FROM werelddeel";
                $stmt2 = $pdo->prepare($query2);
                $stmt2->execute();
                $continents = $stmt2->fetchAll(PDO::FETCH_ASSOC);

                //ik maak hier een array.
                foreach ($results as $result) {
                    foreach ($continents as $continent) {
                        if ($continent['werelddeelcode'] == $result['werelddeelcode']) {
                            $werelddeel = $continent['werelddeel'];
                            break;
                        }
                    }
                    $_SESSION['land'][] = $result['landnaam'];
                    $_SESSION['landcode'][] = $result['landcode'];
                    $_SESSION['continent'][] = $werelddeel;
                    $_SESSION['continent_af'][] = $result['werelddeelcode'];
                    $_SESSION['vlag_url'][] = $result['vlag_url'];
                }
            }
        }
        //check hier of alleen land is ingevult of iets anders.
        elseif (!empty($land) && empty($Continent)) {
            $query = "SELECT * FROM land WHERE landnaam LIKE :land";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':land', '%' . $land . '%');
            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($results)) {
                $_SESSION['err'] = 'Geen resultaten gevonden met deze invoer.';
            } else {
                $query2 = "SELECT * FROM werelddeel";
                $stmt2 = $pdo->prepare($query2);
                $stmt2->execute();
                $continents = $stmt2->fetchAll(PDO::FETCH_ASSOC);


                foreach ($results as $result) {
                    foreach ($continents as $continent) {
                        if ($continent['werelddeelcode'] == $result['werelddeelcode']) {
                            $werelddeel = $continent['werelddeel'];
                            break;
                        }
                    }
                    $_SESSION['land'][] = $result['landnaam'];
                    $_SESSION['landcode'][] = $result['landcode'];
                    $_SESSION['continent'][] = $werelddeel;
                    $_SESSION['continent_af'][] = $result['werelddeelcode'];
                    $_SESSION['vlag_url'][] = $result['vlag_url'];
                }
            }
        }
        // hier of continent wel maar land niet is ingevult.
        elseif (!empty($Continent) && empty($land)) {
            $query = "SELECT * FROM land WHERE werelddeelcode = :continent";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':continent', $Continent);
            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($results)) {
                $_SESSION['err'] = 'Geen resultaten gevonden met deze invoer.';
            } else {
                $query2 = "SELECT * FROM werelddeel";
                $stmt2 = $pdo->prepare($query2);
                $stmt2->execute();
                $continents = $stmt2->fetchAll(PDO::FETCH_ASSOC);

                //ik maak hier een array.
                foreach ($results as $result) {
                    foreach ($continents as $continent) {
                        if ($continent['werelddeelcode'] == $result['werelddeelcode']) {
                            $werelddeel = $continent['werelddeel'];
                            break;
                        }
                    }
                    $_SESSION['land'][] = $result['landnaam'];
                    $_SESSION['landcode'][] = $result['landcode'];
                    $_SESSION['continent'][] = $werelddeel;
                    $_SESSION['continent_af'][] = $result['werelddeelcode'];
                    $_SESSION['vlag_url'][] = $result['vlag_url'];
                }
            }
        }
        //hier of het een nummer is.
        elseif (is_numeric($land)) {
            $_SESSION['err'] = 'Je mag geen nummer invoeren.';
        }
        //hier of de velden leeg zijn een error mes.
        elseif (empty($land) && empty($Continent)) {
            $_SESSION['err'] = 'Geen invoer!!!.';
        }


        header('location:../index.php');
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
} else {
    header('location:../index.php');
}
