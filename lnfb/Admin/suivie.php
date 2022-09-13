<?php

session_start(); 
$pseudo = $_SESSION["pseudo"];
$uid = $_SESSION["id"];
$grade = $_SESSION["grade"];

$servername = 'localhost:3307';
$username = 'root';

if($grade != "admin"){
    header("Location: dashboard.php");
    die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Dashboard - LNFB ESPORT</title>
</head>
<body>

    <div class="nav">
        <div class="infoNav">
            <p class="title">Dashboard</p>
            <p class="textNav">Pseudo : <?php echo $pseudo ?></p>
            <p class="textNav">Grade : <?php echo $grade ?></p>

        </div>
        <div class="boutonNav">
            <p class="btn"><a>Mon Compte</a></p>
            <p class="btn"><a href="dashboard.php">Home</a></p>
        </div>
    </div>
    <div class="administration">
        <div class="navAdmin">
            <p class="btnAdmin"><a href="administration.php">News</a></p>
            <p class="btnAdmin"><a href="joueur.php">Joueur</a></p>
            <p class="btnAdmin"><a href="#">Suivie</a></p>
        </div>
    </div>

    <div class="joueurlist">
        <?php
        try{
            $conn = new PDO('mysql:host=localhost:3307;dbname=lnfb', $username);
            $stmt = $conn->prepare('SELECT * FROM user WHERE grade="joueur" GROUP BY elo DESC');
            $stmt->execute();
        
            foreach ($stmt as $row) {
                $name = $row[0];
                $elo = $row[4];
        ?>
        <div class="joueur">
                <p class="TextSuivie">pseudo : <?php echo $name;?></p>
                <p class="TextSuivie">elo : <?php echo $elo; ?></p>
        </div>
        <?php


            }
        }
        catch(PDOException $e){

        }
        ?>
    </div>
   
</body>
</html>