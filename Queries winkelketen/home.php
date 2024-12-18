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
    <button onclick="window.location.href='building.php'">Gebouw info</button>
    <div class="filbox">
        <form action="includes/winkelform.inc.php" method="post">
            <div class="box">
                <p>Medewerker id: <input type="number" name="med_id" max="80" value="<?php if (!empty($_SESSION['medewerker_id'])) {
                                                                                            echo htmlspecialchars($_SESSION['medewerker_id']);
                                                                                        } ?>"></p>
                <p>Voornaam: <input type="text" name="voornaam" value="<?php if (!empty($_SESSION['medewerker_voornaam'])) {
                                                                            echo htmlspecialchars($_SESSION['medewerker_voornaam']);
                                                                        } ?>"></p>
                <p>Achternaam: <input type="text" name="achternaam" value="<?php if (!empty($_SESSION['medewerker_achternaam'])) {
                                                                                echo htmlspecialchars($_SESSION['medewerker_achternaam']);
                                                                            } ?>"></p>
                <p>Email: <input type="text" name="email" value="<?php if (!empty($_SESSION['medewerker_email'])) {
                                                                        echo htmlspecialchars($_SESSION['medewerker_email']);
                                                                    } ?>"></p>
                <p>Titel: <select name="title">
                        <option value=""></option>
                        <option value="dhr." <?php if (isset($_SESSION['medewerker_title']) && $_SESSION['medewerker_title'] == 'dhr.') echo 'selected'; ?>>dhr.</option>
                        <option value="dr." <?php if (isset($_SESSION['medewerker_title']) && $_SESSION['medewerker_title'] == 'dr.') echo 'selected'; ?>>dr.</option>
                        <option value="drs." <?php if (isset($_SESSION['medewerker_title']) && $_SESSION['medewerker_title'] == 'drs.') echo 'selected'; ?>>drs.</option>
                        <option value="ds." <?php if (isset($_SESSION['medewerker_title']) && $_SESSION['medewerker_title'] == 'ds.') echo 'selected'; ?>>ds.</option>
                        <option value="ing." <?php if (isset($_SESSION['medewerker_title']) && $_SESSION['medewerker_title'] == 'ing.') echo 'selected'; ?>>ing.</option>
                        <option value="ir." <?php if (isset($_SESSION['medewerker_title']) && $_SESSION['medewerker_title'] == 'ir.') echo 'selected'; ?>>ir.</option>
                        <option value="mevr." <?php if (isset($_SESSION['medewerker_title']) && $_SESSION['medewerker_title'] == 'mevr.') echo 'selected'; ?>>mevr.</option>
                        <option value="mr." <?php if (isset($_SESSION['medewerker_title']) && $_SESSION['medewerker_title'] == 'mr.') echo 'selected'; ?>>mr.</option>
                        <option value="prof." <?php if (isset($_SESSION['medewerker_title']) && $_SESSION['medewerker_title'] == 'prof.') echo 'selected'; ?>>prof.</option>
                    </select>
                </p>

                <p>Werk titel
                    <select name="jobtitle">
                        <option value=""></option>
                        <option value="commercieel directeur" <?php if (isset($_SESSION['medewerker_jobtitle']) && $_SESSION['medewerker_jobtitle'] == 'commercieel directeur') echo 'selected'; ?>>Commercieel directeur</option>
                        <option value="hoofd administratie" <?php if (isset($_SESSION['medewerker_jobtitle']) && $_SESSION['medewerker_jobtitle'] == 'hoofd administratie') echo 'selected'; ?>>Hoofd administratie</option>
                        <option value="kassamedewerker" <?php if (isset($_SESSION['medewerker_jobtitle']) && $_SESSION['medewerker_jobtitle'] == 'kassamedewerker') echo 'selected'; ?>>Kassamedewerker</option>
                        <option value="kwaliteitsmanager" <?php if (isset($_SESSION['medewerker_jobtitle']) && $_SESSION['medewerker_jobtitle'] == 'kwaliteitsmanager') echo 'selected'; ?>>Kwaliteitsmanager</option>
                        <option value="magazijnmedewerker" <?php if (isset($_SESSION['medewerker_jobtitle']) && $_SESSION['medewerker_jobtitle'] == 'magazijnmedewerker') echo 'selected'; ?>>Magazijnmedewerker</option>
                        <option value="medewerker administratie" <?php if (isset($_SESSION['medewerker_jobtitle']) && $_SESSION['medewerker_jobtitle'] == 'medewerker administratie') echo 'selected'; ?>>Medewerker administratie</option>
                        <option value="medewerker communicatie" <?php if (isset($_SESSION['medewerker_jobtitle']) && $_SESSION['medewerker_jobtitle'] == 'medewerker communicatie') echo 'selected'; ?>>Medewerker communicatie</option>
                        <option value="medewerker M&O" <?php if (isset($_SESSION['medewerker_jobtitle']) && $_SESSION['medewerker_jobtitle'] == 'medewerker M&O') echo 'selected'; ?>>Medewerker M&O</option>
                        <option value="projectleider" <?php if (isset($_SESSION['medewerker_jobtitle']) && $_SESSION['medewerker_jobtitle'] == 'projectleider') echo 'selected'; ?>>Projectleider</option>
                        <option value="verkoopadviseur" <?php if (isset($_SESSION['medewerker_jobtitle']) && $_SESSION['medewerker_jobtitle'] == 'verkoopadviseur') echo 'selected'; ?>>Verkoopadviseur</option>
                        <option value="supervisor" <?php if (isset($_SESSION['medewerker_jobtitle']) && $_SESSION['medewerker_jobtitle'] == 'supervisor') echo 'selected'; ?>>Supervisor</option>
                        <option value="verkoopassistent" <?php if (isset($_SESSION['medewerker_jobtitle']) && $_SESSION['medewerker_jobtitle'] == 'verkoopassistent') echo 'selected'; ?>>Verkoopassistent</option>
                    </select>
                </p>
            </div>


            <button class="fil">zoek</button>
        </form>
        <button onclick="window.location.href='home.php'">clear</button>
    </div>
    <?php
    if (isset($_SESSION['med.id'])) {
        echo '<h2>Er zijn ' . htmlspecialchars(count($_SESSION['med.id'])) . ' resultaten gevonden.</h2>';

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
    }
    if(isset($_SESSION['err'])){
        echo '<p>' . htmlspecialchars($_SESSION['err']) . '</p>';
    }
    session_destroy();

    ?>

</body>

</html>