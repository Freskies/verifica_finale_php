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
    SELECT tanime.titoloAnime
    FROM verifica20220422.tanime;
";
$all_anime = $conn->execute($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Mecha</title>
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
    echo '<h1>Add Mecha</h1>';
    ?>
    <div id="add">
        <form action="addMecha.php" method="POST">
            <label for="name">Name: </label>
            <input type="text" name="name" id="name" required><br>
            <label for="height">Height: </label>
            <input type="number" name="height" id="height" step="0.01" required><br>
            <label for="weight">Weight: </label>
            <input type="number" name="weight" id="weight" step="0.01" required><br>
            <input type="submit">
        </form>
    </div><br>
    <div id="table">
        <?php
        if (isset($_POST['name']) and isset($_POST['height']) and isset($_POST['weight']))
        {
            $query = "
                INSERT INTO verifica20220422.tmecha(nomeMecha, altezzaMecha, pesoMecha) VALUES
                (?, ?, ?);
            ";
            $conn->execute($query, [$_POST['name'], $_POST['height'], $_POST['weight']]);

            echo "The new Mecha is on the board!";
            $query = "
                SELECT tmecha.nomeMecha, tmecha.altezzaMecha, tmecha.pesoMecha
                FROM verifica20220422.tmecha;
            ";
            $result = $conn->execute($query);
            echo $conn::generate_table($result, ['name', 'height', 'weight']);
        }
        ?>
    </div><br>
    <label><a href="entry.php">Return to Home</a></label>;
</div>
</body>
</html>

