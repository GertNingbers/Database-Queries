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
        echo '<table border="1">';
        echo '<tr><th>Vlag</th><th>Land</th><th>Landafkorting</th><th>Continent</th></tr>';

        $landArray = explode(',', $_SESSION['land']);
        $landcodeArray = explode(',', $_SESSION['landcode']);
        $continentArray = explode(',', $_SESSION['continent']);
        $vlagArray = explode(',', $_SESSION['vlag_url']);

        for ($i = 0; $i < count($landArray); $i++) {
            echo '<tr>';
            echo '<td><img src="' . htmlspecialchars($vlagArray[$i]) . '" alt="Vlag van ' . htmlspecialchars($landArray[$i]) . '"></td>'; // ik haal een link uit de database die zet ik hier neer.
            echo '<td>' . htmlspecialchars($landArray[$i]) . '</td>';
            echo '<td>' . htmlspecialchars($landcodeArray[$i]) . '</td>';
            echo '<td>' . htmlspecialchars($continentArray[$i]) . '</td>';
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