<?php

$pseudo = $_POST["pseudo"];
$mdp = hash("sha256", $_POST["mdp"]);

$servername = 'localhost:3307';
$username = 'root';

try{
    $conn = new PDO('mysql:host=localhost:3307;dbname=lnfb', $username);
    echo "<br>Connexion BDD ok<br>";

    $stmt = $conn->prepare('SELECT * FROM user WHERE pseudo = :pseudo AND mdp = :mdp');
    $stmt->execute();
    $stmt->execute([ 'pseudo' => $pseudo , 'mdp' => $mdp]);

    foreach ($stmt as $row) {
            echo "Connexion succeeded";
            session_start(); 
            $_SESSION["pseudo"] = $pseudo; 
            $_SESSION["id"] = $row[2];
            $_SESSION["grade"] = $row[3];
            header("Location: dashboard.php");
            die();
    }
    header("Location: connexion.html");

}
catch (PDOException $e){
    echo "<br>Connexion BDD OFF<br>";
    header("Location: connexion.html");
}


?>