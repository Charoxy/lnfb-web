<?php

session_start(); 
if(!isset($_SESSION["pseudo"])){
    header("location: connexion.html");
}
$pseudo = $_SESSION["pseudo"];
$uid = $_SESSION["id"];
$grade = $_SESSION["grade"];

$servername = 'localhost:3307';
$username = 'root';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard.css">
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
            <?php if(strpos($grade,"admin") !== false){ ?>
                <p class="btn"><a href="Admin/administration.php">Admin</a></p>
            <?php } ?>
        </div>
    </div>



    <div class="News">
        <h1 class="News-title">News - LNFB ESPORT</h1>

        <?php
            try{
                $conn = new PDO('mysql:host=localhost:3307;dbname=lnfb', $username);
                $stmt = $conn->prepare('SELECT * FROM news ORDER BY id DESC');
                $stmt->execute();

                foreach ($stmt as $row) {
                    $newsTitle = $row[0];
                    $newsDesc = $row[1];
                    $newsAuthor = $row[2];
                ?>

                <div class="article">
                    <div class="article-corps">
                        <h2 class="Article-title"> <?php echo $newsTitle?> </h2>
                        <p class="article-text"><?php echo $newsDesc?></p>
                        <p class="article-Auteur">Auteur : <?php echo $newsAuthor?> </p>
                    </div>
                </div>

                <?php
                }
            }
            catch (PDOException $e){
                echo "<br>Connexion BDD OFF<br>";
            }
        ?>

        <div class="newsflex">

        </div>
    </div>
</body>
</html>