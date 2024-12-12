<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Landen</title>
</head>

<body>
    <div class="top">
        <h1>Landen en continenten</h1>
        <form action="includes/landzoeker.inc.php" method="post">
            <p>
                Land: <input type="text" id="land" name="land">
            </p>
            <p>Continent:
                <select name="continent">
                    <option value=""></option>
                    <option value="EU">Europa</option>
                    <option value="AZ">Azië</option>
                    <option value="NAM">Noord Amerika</option>
                    <option value="ZAM">Zuid Amerika</option>
                    <option value="AF">Afrika</option>
                    <option value="OC">Oceania</option>
                    <option value="AN">Antarctica</option>
                </select>
            </p>
            <button>Zoek</button>
        </form>
    </div>
    <?php

    if (isset($_SESSION['land'])) {
        echo '<h2>' . 'Er zijn ' . count($_SESSION['land']) . ' landen gevonden' . '</h2>';

        echo '<table border="1">';
        echo '<tr><th>Vlag</th><th>Land</th><th>Land afkorting</th><th>Continent</th><th>Cont. Afkorting</th></tr>';

        for ($i = 0; $i < count($_SESSION['land']); $i++) {
            echo '<tr>';
            echo '<td><img src="' . htmlspecialchars($_SESSION['vlag_url'][$i]) . '" alt="Vlag van ' . htmlspecialchars($_SESSION['land'][$i]) . '"></td>';
            echo '<td>' . htmlspecialchars($_SESSION['land'][$i]) . '</td>';
            echo '<td>' . htmlspecialchars($_SESSION['landcode'][$i]) . '</td>';
            echo '<td>' . htmlspecialchars($_SESSION['continent'][$i]) . '</td>';
            echo '<td>' . htmlspecialchars($_SESSION['continent_af'][$i]) . '</td>';
            echo '</tr>';
        }

        echo '</table>';
        session_unset();
    }

    if (isset($_SESSION['err'])) {
        echo '<p class="err">' . htmlspecialchars($_SESSION['err']) . '</p>';
        session_unset();
    }
    ?>
</body>

</html>