<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="building.css">
    <title>bulding</title>
</head>

<body>
    <h1>Gebouw</h1>
    <button onclick="window.location.href='home.php'">personeel info</button>
    <form action="includes/building.inc.php" method="post">

        <p>Medewerker id: <input type="number" name="person" max="80" value="<?php if (!empty($_SESSION['person_id'])) {
                                                                                    echo htmlspecialchars($_SESSION['person_id']);
                                                                                } ?>"></p>

        <p> Gebouw: <select name="building">
                <option value=""></option>
                <option value="1" <?php if (isset($_SESSION['building_id']) && $_SESSION['building_id'] == '1') echo 'selected'; ?>>Bakkers Shop</option>
                <option value="2" <?php if (isset($_SESSION['building_id']) && $_SESSION['building_id'] == '2') echo 'selected'; ?>>Badkamerreus</option>
                <option value="3" <?php if (isset($_SESSION['building_id']) && $_SESSION['building_id'] == '3') echo 'selected'; ?>>Videodump</option>
                <option value="4" <?php if (isset($_SESSION['building_id']) && $_SESSION['building_id'] == '4') echo 'selected'; ?>>Schoenmaker van Laon</option>
                <option value="5" <?php if (isset($_SESSION['building_id']) && $_SESSION['building_id'] == '5') echo 'selected'; ?>>Boekenconcurrent CV</option>
            </select>
        </p>
        <p>Datum gewerkt Vanaf: <input type="date" name="date_vanaf" value="<?php if (!empty($_SESSION['date_vanaf'])) {
                                                                                echo htmlspecialchars($_SESSION['date_vanaf']);
                                                                            } ?>"></p>
        <p>Datum gewerkt Tot: <input type="date" name="date_tot" value="<?php if (!empty($_SESSION['date_tot'])) {
                                                                            echo htmlspecialchars($_SESSION['date_tot']);
                                                                        } ?>"></p>
        <p>Uren tonen: <select name="uren">
                <option value="">Nee</option>
                <option value="ja" <?php if (isset($_SESSION['uren']) && $_SESSION['uren'] == 'ja') echo 'selected'; ?>>Ja</option>
        </p>

        <button>zoek</button>
    </form>

    <div class="display">
        <?php

        if (isset($_SESSION['med.id'])) {
            if(!empty($_SESSION['building_id'])){
            echo '<h2>Er zijn ' . htmlspecialchars(count($_SESSION['med.id'])) . ' resultaten gevonden in gebouw ' . htmlspecialchars($_SESSION['building_naam']) . '.</h2>';
            } else {
                echo '<h2>Er zijn '. htmlspecialchars(count($_SESSION['med.id'])) . ' resultaten gevonden.</h2>';
            }
            if (!empty($_SESSION['date_vanaf'])) {
                echo '<h2> Vanaf datum: ' . htmlspecialchars($_SESSION['date_vanaf']) . '</h2>';
            }
            if (!empty($_SESSION['date_tot'])) {
                echo '<h2> Tot datum: ' . htmlspecialchars($_SESSION['date_tot']) . '</h2>';
            }

            echo '<table border="1">';
            echo '<tr><th>Medewerker ID</th><th>Titel</th><th>Voornaam</th><th>Achternaam</th><th>Email</th><th>Job Titel</th><th>Building_id</th><th>Building_naam</th><th>Straat</th><th>Buildingnumber</th></tr>';

            for ($i = 0; $i < count($_SESSION['med.id']); $i++) {
                echo '<tr>';
                echo '<td>' .  htmlspecialchars($_SESSION['med.id'][$i]) . '</td>';
                echo '<td>' .  htmlspecialchars($_SESSION['title'][$i]) . '</td>';
                echo '<td>' .  htmlspecialchars($_SESSION['voornaam'][$i]) . '</td>';
                echo '<td>' .  htmlspecialchars($_SESSION['achternaam'][$i]) . '</td>';
                echo '<td>' .  htmlspecialchars($_SESSION['email'][$i]) . '</td>';
                echo '<td>' .  htmlspecialchars($_SESSION['jobtitle'][$i]) . '</td>';
                if (!empty($_SESSION['building_id'])) {
                    echo '<td>' .  htmlspecialchars($_SESSION['building_id']) . '</td>';
                    echo '<td>' .  htmlspecialchars($_SESSION['building_naam']) . '</td>';
                    echo '<td>' .  htmlspecialchars($_SESSION['straat']) . '</td>';
                    echo '<td>' .  htmlspecialchars($_SESSION['buildingnumber']) . '</td>';
                }
                echo '</tr>';
            }
            echo '</table>';
            session_destroy();
        }
        if (!empty($_SESSION['err'])) {
            echo '<h3>' . htmlspecialchars($_SESSION['err']) . '</h3>';
            session_destroy();
        }
        if (isset($_SESSION['urenGewerkt'])) {
            echo '<h2>Gewerkte uren:</h2>';
            foreach ($_SESSION['urenGewerkt'] as $personId => $uren) {
                echo '<p>Persoon ID: ' . htmlspecialchars($personId) . ' heeft ' . htmlspecialchars($uren) . ' uur gewerkt.</p>';
            }
        }
        ?>
    </div>
</body>

</html>