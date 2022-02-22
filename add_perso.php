<?php


function chargerClasse($classe)
{
require $classe . '.php';
}
spl_autoload_register('chargerClasse');

$db=new PDO('mysql:host=localhost;dbname=pookemongit;port=3306', 'root', '');
$manager = new PersonnageManager($db);

$perso = new Personnage($_POST);
$manager->InsertPersonnage($perso,false);


header("Location: backOffice_perso.php");