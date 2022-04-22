<?php
/*
 * Copyright (c) 2022.
 * Giacchini Valerio
 * 5AIN - School Test
 */

session_start();
require 'Connection.php';

if(!isset($_SESSION["username"]))
    header("location:index.php?action=login");

$conn = new Connection('verifica20220422');

$query = "
    SELECT *
    FROM verifica20220422.tanime;
";
$all_anime = $conn->execute($query);

$query = "
    SELECT *
    FROM verifica20220422.tmecha;
";
$all_mecha = $conn->execute($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Match Anime and Mecha</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
        td, tr, th {
            border: solid;
        }
    </style>
</head>
<body>
<br /><br />
<div class="container" style="width:500px;">
    <h3 align="center">School Test - Giacchini Valerio</h3>
    <br />
    <?php
    echo '<h1>Match Anime and Mecha</h1>';
    ?>
    <div id="selection">
        <form action="match_anime_mecha.php" method="POST">
            <label for="anime">Select Anime</label>
            <select id="anime" name="anime">
                <?php
                foreach ($all_anime as $anime)
                    echo "<option value='{$anime['IDAnime']}'>{$anime['titoloAnime']}</option>"
                ?>
            </select><br>
            <label for="mecha">Select Mecha</label>
            <select id="mecha" name="mecha">
                <?php
                foreach ($all_mecha as $mecha)
                    echo "<option value='{$mecha['IDMecha']}'>{$mecha['nomeMecha']}</option>"
                ?>
            </select>
            <input type="submit">
        </form>
    </div><br>
    <div>
        <?php
        if (isset($_POST['anime']) and isset($_POST['mecha']))
        {
            $query = "
                INSERT INTO verifica20220422.rappare(kAnime, kMecha) VALUES
                (?, ?);
            ";
            $conn->execute($query, [$_POST['anime'], $_POST['mecha']]);

            echo "The selected Mecha splash into the selected Anime!";
        }
        ?>
    </div><br>
    <label><a href="entry.php">Return to Home</a></label>;
</div>
</body>
</html>

