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

        <p> Gebouw: <select name="building">
                <option value=""></option>
                <option value="1">Bakkers Shop</option>
                <option value="2">Badkamerreus</option>
                <option value="3">Videodump</option>
                <option value="4">Schoenmaker van Laon</option>
                <option value="5">Boekenconcurrent CV</option>
            </select>
        </p>
        <p>Datum gewerkt Vanaf: <input type="date" name="date_vanaf" value="<?php if (!empty($_SESSION['date_vanaf'])) {
                                                                                echo htmlspecialchars($_SESSION['date_vanaf']);
                                                                            } ?>"></p>
        <p>Datum gewerkt Tot: <input type="date" name="date_tot" value="<?php if (!empty($_SESSION['date_tot'])) {
                                                                            echo htmlspecialchars($_SESSION['date_tot']);
                                                                        } ?>"></p>
        <p>Uren gewerkt Vanaf: <input type="number" name="uren_vanaf" value="<?php if (!empty($_SESSION['uren_vanaf'])) {
                                                                                    echo htmlspecialchars($_SESSION['uren_vanaf']);
                                                                                } ?>"></p>
        <p>Uren gewerkt Tot: <input type="number" name="uren_tot" value="<?php if (!empty($_SESSION['uren_tot'])) {
                                                                                echo htmlspecialchars($_SESSION['uren_tot']);
                                                                            } ?>"></p>

        <p>Check:
            <select name="check">
                <option value=""></option>
                <option value="in">in</option>
                <option value="out">out</option>
            </select>
        </p>
        <button>zoek</button>
    </form>

    <div class="display">
        <?php
        if (isset($_SESSION['med.id'])) {
            echo '<h2>Er zijn ' . htmlspecialchars(count($_SESSION['med.id'])) . ' resultaten gevonden in gebouw' . htmlspecialchars($_SESSION['building_naam'][1]) . '.</h2>';

            echo '<table border="1">';
            echo '<tr><th>Medewerker ID</th><th>Titel</th><th>Voornaam</th><th>Achternaam</th><th>Email</th><th>Job Titel</th><th>Building_id</th><th>Building_naam</th><th>Straat</th><th>Buildingnumber</th></tr>';

            for ($i = 0; $i < count($_SESSION['med.id']); $i++) {
                echo '<tr>';
                echo '<tr><td>' .  htmlspecialchars($_SESSION['med.id'][$i]) . '</td>';
                echo '<td>' .  htmlspecialchars($_SESSION['title'][$i]) . '</td>';
                echo '<td>' .  htmlspecialchars($_SESSION['voornaam'][$i]) . '</td>';
                echo '<td>' .  htmlspecialchars($_SESSION['achternaam'][$i]) . '</td>';
                echo '<td>' .  htmlspecialchars($_SESSION['email'][$i]) . '</td>';
                echo '<td>' .  htmlspecialchars($_SESSION['jobtitle'][$i]) . '</td>';
                echo '<td>' .  htmlspecialchars($_SESSION['building_id'][$i]) . '</td>';
                echo '<td>' .  htmlspecialchars($_SESSION['building_naam'][$i]) . '</td>';
                echo '<td>' .  htmlspecialchars($_SESSION['straat'][$i]) . '</td>';
                echo '<td>' .  htmlspecialchars($_SESSION['buildingnumber'][$i]) . '</td>';
                echo '</tr>';
            }
            echo '</table>';
            //session_destroy();
        }

        ?>
    </div>
</body>

</html>