<?php

$mdp = $_POST["mdp"];
session_start();

// $mdp = password_hash($mdp, PASSWORD_DEFAULT);

$db=new PDO('mysql:host=localhost;dbname=pookemongit;port=3306', 'root', '');
$stmt = $db->query("SELECT * FROM login WHERE login = 'admin'");


$result = $stmt->fetch();
if (password_verify($mdp,$result["mdp"] ) ){

    $_SESSION["admin"] = true;
    
    header('location: backOffice_perso.php');
} else {
    header('location: login.php?erreur=true');
     
}
   


