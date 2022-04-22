<?php
/*
 * Copyright (c) 2022.
 * Giacchini Valerio
 * 5AIN - School Test
 */

require 'Connection.php';
session_start();

$conn = new Connection("verifica20220422");

if (isset($_SESSION["username"]))
    header("location:entry.php");

if (isset($_POST["register"]))
{
    if (empty($_POST["username"]) || empty($_POST["password"]))
        echo '<script>alert("Both Fields are required")</script>';

    else
    {
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $query = "
            INSERT INTO verifica20220422.tutenti(nomeUtente, passwordUtente, isAdmin) VALUES
            (?, ?, false)
        ";
        $conn->execute($query, [$_POST["username"], $password]);
        echo '<script>alert("Registration Done")</script>';
    }
}

if(isset($_POST["login"]))
{
    if(empty($_POST["username"]) || empty($_POST["password"]))
        echo '<script>alert("Both Fields are required")</script>';

    else
    {
        $query = "
            SELECT nomeUtente, passwordUtente
            FROM verifica20220422.tutenti
            WHERE tutenti.nomeUtente = ?";
        $result = $conn->execute($query, [$_POST["username"]]);

        if(password_verify($_POST["password"], $result[0]["passwordUtente"] ?? ""))
        {
            $_SESSION["username"] = $_POST["username"];
            header("location:entry.php");
        }
        else
            echo '<script>alert("Wrong User Details")</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register / Login</title>
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
    if(isset($_GET["action"]) == "login")
    {
        ?>
        <h3 align="center">Login</h3>
        <br />
        <form method="post">
            <label>Enter Username</label>
            <input type="text" name="username" class="form-control" />
            <br />
            <label>Enter Password</label>
            <input type="text" name="password" class="form-control" />
            <br />
            <input type="submit" name="login" value="Login" class="btn btn-info" />
            <br />
            <p align="center"><a href="index.php">Register</a></p>
        </form>
        <?php
    }
    else
    {
        ?>
        <h3 align="center">Register</h3>
        <br />
        <form method="post">
            <label>Enter Username</label>
            <input type="text" name="username" class="form-control" />
            <br />
            <label>Enter Password</label>
            <input type="text" name="password" class="form-control" />
            <br />
            <input type="submit" name="register" value="Register" class="btn btn-info" />
            <br />
            <p align="center"><a href="index.php?action=login">Login</a></p>
        </form>
        <?php
    }
    ?>
</div>
</body>
</html>


