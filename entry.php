<?php
/*
 * Copyright (c) 2022.
 * Giacchini Valerio
 * 5AIN - School Test
 */

require 'Connection.php';
session_start();

if(!isset($_SESSION["username"]))
    header("location:index.php?action=login");

$conn = new Connection('verifica20220422');

$query = "
    SELECT tutenti.isAdmin
    FROM verifica20220422.tutenti
    WHERE tutenti.nomeUtente = ?;
";
$result = $conn->execute($query, [$_SESSION["username"]]);
$isAdmin = $result[0]['isAdmin'] ?? false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Entry</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<br /><br />
<div class="container" style="width:500px;">
    <h3 align="center">School Test - Giacchini Valerio</h3>
    <br />
    <?php
    echo '<h1>Welcome - '.$_SESSION["username"].'</h1>';

    if ($isAdmin)
    {
        echo "<label><a href='addMecha.php'>Add Mecha</a></label>; ";
        echo "<label><a href='match_anime_mecha.php'>Match Anime and Mecha</a></label>;<br>";
    }
    ?>

    <label><a href="visualize_mecha.php">Visualize Mecha</a></label>;
    <label><a href="logout.php">Logout</a></label>;
</div>
</body>
</html>
