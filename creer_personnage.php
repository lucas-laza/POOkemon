<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="create.css">
</head>
<body>
<a href="index.php">Retour à l'accueil</a>
<?php 

function chargerClasse($classe)
{
require $classe . '.php';
}
spl_autoload_register('chargerClasse');

$db=new PDO('mysql:host=localhost;dbname=pookemongit;port=3306', 'root', '');
$managerE = new ElemManager($db);
$managerA = new AttaqueManager($db);

$allElem = $managerE->getList();

?>
<form action="add_perso.php" method="POST" class="create">

<label for="name">Name</label>
<input id="name" type="text" name="name" class="big">
<label for="elem">Elem</label>
<select name="elem" id="elem" class="big">
<?php

foreach ($allElem as $obj){
    $id = $obj->getId();
    $name = $obj->getName();
    
echo "<option value='$id'>$name</option>";
}

?>
</select>
<label for="pvmax">Pvmax</label>
<input id="pvmax" type="number" min="0" max="500" name="pvmax" >
<label for="atk">Atk</label>
<input id="atk" type="number" min="0" max="80" name="atk" >
<label for="maj">Maj</label>
<input id="maj" type="number" min="0" max="80" name="maj" >
<label for="arm">Arm</label>
<input id="arm" type="number" min="0" max="80" name="arm" >
<label for="rmj">Rmj</label>
<input id="rmj" type="number" min="0" max="80" name="rmj" >
<label for="soin">Soin</label>
<input id="soin" type="number" min="0" max="80" name="soin" >
<label for="vit">Vit</label>
<input id="vit" type="number" min="0" max="10" name="vit" >
<label for="A1">Attaque 1</label>
<select name="A1" id="A1" class="big">
                    <?php

                    $allAttaque = $managerA->getList();
                    
                    foreach ($allAttaque as $obj){
                        $id = $obj->getId();
                        $name = $obj->getName();
                        echo "<option value='$id'>$name</option>";
                    }

                    ?>
                </select>
<label for="phrase">Phrase</label>
<textarea id="phrase" name="phrase" id="" cols="30" rows="3" class="big"></textarea>

<input type="hidden" name="id" >

<input type="submit" value="Ajouter !">


</form>








    
</body>
</html>

