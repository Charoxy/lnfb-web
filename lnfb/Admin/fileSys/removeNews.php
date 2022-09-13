<?php
session_start(); 
$grade = $_SESSION["grade"];

$username = 'root';

if($grade != "admin"){
    header("Location: dashboard.php");
    die();
}

$title = '"'.$_GET["title"].'"';

try{
    $conn = new PDO('mysql:host=localhost:3307;dbname=lnfb', $username);
    $stmt = $conn->prepare('DELETE FROM news WHERE titre= '.$title.';');
    $stmt->execute([ 'titre' => $title ]);
    header("Location: ../administration.php");
}
catch(PDOException $e){
    echo "Error: ".$e->getMessage();
}

?>