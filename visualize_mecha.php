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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Visualize Mecha</title>
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
    echo '<h1>Visualize Mecha</h1>';
    ?>
    <div id="selection">
        <form action="visualize_mecha.php" method="POST">
            <label for="sel">Select Anime</label>
            <select id="sel" name="anime">
                <?php
                foreach ($all_anime as $anime)
                    echo "<option value='{$anime['IDAnime']}'>{$anime['titoloAnime']}</option>"
                ?>
            </select>
            <input type="submit">
        </form>
    </div><br>
    <div id="table">
        <?php
        if (isset($_POST['anime']))
        {
            $query = "
                SELECT tmecha.nomeMecha, tmecha.altezzaMecha, tmecha.pesoMecha
                FROM verifica20220422.tanime, verifica20220422.tmecha, verifica20220422.rappare
                WHERE rappare.kMecha = tmecha.IDMecha and rappare.kAnime = tanime.IDAnime
                    and tanime.IDAnime = ?;
            ";
            $result = $conn->execute($query, [$_POST['anime']]);
            echo $conn::generate_table($result, ['name', 'height', 'weight']);
        }
        ?>
    </div><br>
    <label><a href="entry.php">Return to Home</a></label>;
</div>
</body>
</html>

