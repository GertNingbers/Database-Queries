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
    <h1>Landen en continenten</h1>
    <form action="includes/landzoeker.inc.php" method="post">
        <label for="land">Land:</label>
        <input type="text" id="land" name="land">
        <label for="continent">Continent:</label>
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
        <button>Zoek</button>
    </form>
    <?php
    if(isset($_SESSION['land'])){
        echo '<p>' . htmlspecialchars($_SESSION['land']) . '</p>';
        echo '<p>' . htmlspecialchars($_SESSION['landcode']) . '</p>';
        echo '<p>' . htmlspecialchars($_SESSION['continent']) . '</p>';
        session_unset();
    }
    if(isset($_SESSION['err'])){
        echo '<p>' . htmlspecialchars($_SESSION['err']) . '</p>';
        session_unset();
    }
    ?>
</body>

</html>