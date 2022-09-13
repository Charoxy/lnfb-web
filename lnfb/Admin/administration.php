<?php

session_start(); 
$pseudo = $_SESSION["pseudo"];
$uid = $_SESSION["id"];
$grade = $_SESSION["grade"];

if($grade != "admin"){
    header("Location: dashboard.php");
    die();
}

$servername = 'localhost:3307';
$username = 'root';

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
            <p class="btn"><a href="../dashboard.php">Home</a></p>
        </div>
    </div>
    <div class="administration">
        <div class="navAdmin">
            <p class="btnAdmin"><a href="#">News</a></p>
            <p class="btnAdmin"><a href="joueur.php">Joueur</a></p>
            <p class="btnAdmin"><a href="suivie.php">Suivie</a></p>
        </div>
    </div>
    <form action="fileSys/makeNews.php" method="post" class="newsCreation">
        <div class="formNews">
            <h2 class="titreform">Cree une news</h2>
            <h3 class="subform">Tu peux utiliser les balise html dans la description!</h3>
            <p class="textForm">Titre</p>
            <textarea rows="1" cols="50" name="titre"></textarea>
            <p class="textForm">Description</p>
            <textarea rows="1" cols="50" name="description"></textarea>
            <input class="submit" type="submit">
        </div>
    </form>

    <div class="newslist">
        
        <?php

            try{
                $conn = new PDO('mysql:host=localhost:3307;dbname=lnfb', $username);
                $stmt = $conn->prepare('SELECT * FROM news ORDER BY id DESC');
                $stmt->execute();
            
                foreach ($stmt as $row) {
                    $newsTitle = $row[0];
                    $link = "fileSys/removeNews.php?title=".$newsTitle;
                    $link = str_replace(" " , "%20" , $link);
                    ?>
                        <div class="news">
                        <p class="news-title">Titre <br> <?php echo $newsTitle; ?></p>
                        <?php echo "<p class='btn-news'><a href=".$link.">Supprimer</a></p>";?>
                        </div>


                    <?php
                }
            }catch  (PDOException $e) {
                echo $e->getMessage(); 
            }

        ?>
    </div>
</body>
</html>