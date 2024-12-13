<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <title>Winkelketen</title>
</head>

<body>
    <h1>Winkelketen personeel</h1>
    <form action="includes/winkelform.inc.php" method="post">
    
    <p>Medewerker id: <input type="number" name="med.id" max="80" value="<?php if (!empty($_SESSION['medewerker_id'])) {
                                                                                            echo htmlspecialchars($_SESSION['medewerker_id']);
                                                                                        } ?>"></p>
                <p>Voornaam: <input type="text" name="voornaam" value="<?php if (!empty($_SESSION['invoer_voornaam'])) {
                                                                            echo htmlspecialchars($_SESSION['invoer_voornaam']);
                                                                        } ?>"></p>
                <p>Achternaam: <input type="text" name="achternaam" value="<?php if (!empty($_SESSION['invoer_achternaam'])) {
                                                                                echo htmlspecialchars($_SESSION['invoer_achternaam']);
                                                                            } ?>"></p>
                <p>Email: <input type="text" name="email" value="<?php if (!empty($_SESSION['invoer_email'])) {
                                                                        echo htmlspecialchars($_SESSION['invoer_email']);
                                                                    } ?>"></p>
                <p>Datum Vanaf: <input type="date" name="date_vanaf" value="<?php if (!empty($_SESSION['date_vanaf'])) {
                                                                                echo htmlspecialchars($_SESSION['date_vanaf']);
                                                                            } ?>"></p>
                <p>Datum Tot: <input type="date" name="date_tot" value="<?php if (!empty($_SESSION['date_tot'])) {
                                                                            echo htmlspecialchars($_SESSION['date_tot']);
                                                                        } ?>"></p>
                <p>Uren gewerkt Vanaf: <input type="number" name="Uren_vanaf" value="<?php if (!empty($_SESSION['Uren_vanaf'])) {
                                                                                    echo htmlspecialchars($_SESSION['Uren_vanaf']);
                                                                                } ?>"></p>
                <p>Uren gewerkt Tot: <input type="number" name="Uren_tot" value="<?php if (!empty($_SESSION['Uren_tot'])) {
                                                                                echo htmlspecialchars($_SESSION['Uren_tot']);
                                                                            } ?>"></p>
        <div class="Filter">


                <div class="jobtitle">
                    <h2 class="h2">Werk titel</h2>
                    <p>Commercieel directeur: <input type="checkbox" name="jobtitle" value="commercieel directeur"> </p>
                    <p>Hoofd administratie: <input type="checkbox" name="jobtitle2" value="hoofd administratie"> </p>
                    <p>Kassamedewerker: <input type="checkbox" name="jobtitle" value="kassamedewerker"> </p>
                    <p>Kwaliteitsmanager: <input type="checkbox" name="jobtitle" value="kwaliteitsmanager"> </p>
                    <p>Magazijnmedewerker: <input type="checkbox" name="jobtitle" value="magazijnmedewerker"> </p>
                    <p>Medewerker administratie: <input type="checkbox" name="jobtitle" value="medewerker administratie"> </p>
                    <p>Medewerker communicatie: <input type="checkbox" name="jobtitle" value="medewerker communicatie"> </p>
                    <p>Medewerker M&O: <input type="checkbox" name="jobtitle" value="medewerker M&O"> </p>
                    <p>Projectleider: <input type="checkbox" name="jobtitle" value="projectleider"> </p>
                    <p>Verkoopadviseur: <input type="checkbox" name="jobtitle" value="verkoopadviseur"> </p>
                    <p>Supervisor: <input type="checkbox" name="jobtitle" value="supervisor"> </p>
                    <p>Verkoopassistent: <input type="checkbox" name="jobtitle" value="verkoopassistent"> </p>
                </div>
                <p>Titel: <select name="title">
                        <option value=""></option>
                        <option value="dhr.">dhr.</option>
                        <option value="dr.">dr.</option>
                        <option value="drs.">drs.</option>
                        <option value="ds.">ds.</option>
                        <option value="ing.">ing.</option>
                        <option value="ir.">ir.</option>
                        <option value="mevr.">mevr.</option>
                        <option value="mr.">mr.</option>
                        <option value="prof.">prof.</option>
                    </select>
                </p>
                <p> Gebouw: <select name="bulding">
                        <option value=""></option>
                        <option value="1">Bakkers Shop</option>
                        <option value="2">Badkamerreus</option>
                        <option value="3">Videodump</option>
                        <option value="4">Schoenmaker van Laon</option>
                        <option value="5">Boekenconcurrent CV</option>
                    </select>
                </p>

                <p>Check:
                    <select name="check">
                        <option value=""></option>
                        <option value="in">in</option>
                        <option value="out">out</option>
                    </select>
                </p>
                <p></p>
                <p></p>
                <button class="fil">zoek</button>
            </form>
        </div>
        <?php
        if (isset($_SESSION['med.id'])) {

            echo '<table border="1">';
            echo '<tr><th>Medewerker ID</th><th>Titel</th><th>Voornaam</th><th>Achternaam</th><th>Email</th><th>Job Titel</th></tr>';

            for ($i = 0; $i < count($_SESSION['med.id']); $i++) {
                echo '<tr>';
                echo '<tr><td>' .  htmlspecialchars($_SESSION['med.id'][$i]) . '</td>';
                echo '<td>' .  htmlspecialchars($_SESSION['title'][$i]) . '</td>';
                echo '<td>' .  htmlspecialchars($_SESSION['voornaam'][$i]) . '</td>';
                echo '<td>' .  htmlspecialchars($_SESSION['achternaam'][$i]) . '</td>';
                echo '<td>' .  htmlspecialchars($_SESSION['email'][$i]) . '</td>';
                echo '<td>' .  htmlspecialchars($_SESSION['jobtitle'][$i]) . '</td>';
                echo '</tr>';
            }
            echo '</table>';
            session_destroy();
        }
        ?>
    
</body>

</html>