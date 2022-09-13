

<?php

$desc = $_POST["description"];
session_start(); 
$pseudo = $_SESSION["pseudo"];
$grade = $_SESSION["grade"];
$servername = 'localhost:3307';
$username = 'root';

if($grade != "admin"){
    header("Location: ../../dashboard.php");
    die();
}

try{
    $conn = new PDO('mysql:host=localhost:3307;dbname=lnfb', $username);
    $stmt = $conn->prepare('INSERT INTO news (titre, description, autheur) VALUES(:titre, :description, :autheur);');
    $stmt->execute([ 'autheur' => $pseudo , 'description' => $_POST["description"] , 'titre' => $_POST["titre"]]);
    header("Location: ../administration.php");
    die();
}
catch(PDOException $e){
    echo "Error: ".$e->getMessage();
}

?>
