<?php
session_start();

function chargerClasse($classe)
{
require $classe . '.php';
}
spl_autoload_register('chargerClasse');

$db=new PDO('mysql:host=localhost;dbname=pookemongit;port=3306', 'root', '');
$manager = new PersonnageManager($db);

$perso = new Personnage($_POST);

if (isset($_SESSION["admin"])){
    if ($_SESSION["admin"] == 1){
        $manager->ModifPerso($perso);
    }
}
// $manager->supprPersoById($perso->getId());
// $manager->InsertPersonnage($perso,true);
// var_dump($perso);


header("Location: backOffice_perso.php");




       