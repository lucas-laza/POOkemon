<?php session_start();
if (isset($_SESSION["admin"])){
    if ($_SESSION["admin"] == true){
        ?>
<a href="index.php">Retour à l'accueil</a>
<a href="deco.php">Deconnexion</a>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>

        body{
            font-family:Verdana, Geneva, Tahoma, sans-serif;
        }

        td{
            border-bottom:1px black solid;
        }
        
        .modifP div{
            margin: 1vh 0;
        }
    
    </style>
</head>
<body>
    <h1>C'est le back-office</h1> 
    <a href="creer_personnage.php">
        <h3>Je veux créer un personnage</h3>
    </a>

    <?php

        $db=new PDO('mysql:host=localhost;dbname=pookemongit;port=3306', 'root', '');


        function chargerClasse($classe)
        {
        require $classe . '.php';
        }
        spl_autoload_register('chargerClasse');

        $manager = new PersonnageManager($db);
        $managerE = new ElemManager($db);
        $managerA = new AttaqueManager($db);

        // var_dump($manager->getList());

        $tab = $manager->getList();

        // var_dump($tab);

        ?>
        
        <table>
            <head><td>Nom</td><td>Element</td><td>PV</td><td>Attaque</td><td>Magie</td><td>Armure</td><td>Res.Maj</td><td>soin</td><td>vitesse</td><td>Attaque 1</td><td>Type Atq 1</td><td>Phrase</td><td>Modifier</td><td>Supprimer</td></head>
        <?php
        foreach ($tab as $obj){
            echo "<tr>";

            echo "<td>";
            echo $obj->getName();
            echo "</td>";

            echo "<td>";
            echo $obj->getElem()->getName();
            echo "</td>";

            echo "<td>";
            echo $obj->getPvmax();
            echo "</td>";

            echo "<td>";
            echo $obj->getAtk();
            echo "</td>";

            echo "<td>";
            echo $obj->getMaj();
            echo "</td>";

            echo "<td>";
            echo $obj->getArm();
            echo "</td>";

            echo "<td>";
            echo $obj->getRmj();
            echo "</td>";

            echo "<td>";
            echo $obj->getSoin();
            echo "</td>";

            echo "<td>";
            echo $obj->getVit();
            echo "</td>";

            echo "<td>";
            echo $obj->getA1()->getName();
            echo "</td>";

            echo "<td>";
            echo $obj->getA1()->getElem()->getName();
            echo "</td>";

            echo "<td>";
            echo $obj->getPhrase();
            echo "</td>";

            $getId = $obj->getId();

            echo "<td>";
            echo "<form action='backOffice_perso.php' method='GET'><input type='hidden' name='id' value='$getId'><input type='submit' value='Modifier'></form>";
            echo "</td>";

            echo "<td>";
            echo "<form action='supprime_perso.php' method='GET'><input type='hidden' name='id' value='$getId'><input type='submit' value='Supprimer'></form>";
            echo "</td>";


            echo "</tr>";
        }   
        ?>

        </table>

        <?php

        if (isset($_GET["id"])){

            $idPerso = $_GET["id"];
            $personnage = $manager->getOne($idPerso);
            // var_dump($personnage);
            
            ?>

    <h2>Modifier le personnage numéro <?php echo $_GET["id"] ?></h2>

            <form class="modifP" action="modif_perso.php" method="POST">

                <div>
                    <label for="name">Name</label>
                    <input id="name" type="text" name="name" value="<?php echo $personnage->getName()?>">
                </div>
                <div>
                    <label for="elem">Elem</label>
                    <select name="elem" id="elem">
                        <?php
                        $allElem = $managerE->getList();
                        foreach ($allElem as $obj){
                            $id = $obj->getId();
                            $name = $obj->getName();
                            if ( $personnage->getElem() == $obj){
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            echo "<option value='$id' $selected>$name</option>";
                        }
                        ?>
                    </select>
                </div>
               
                
                <div>
                    <label for="pvmax">Pvmax</label>
                    <input id="pvmax" type="text" name="pvmax" value="<?php echo $personnage->getPvmax()?>">
                </div>
                <div>
                    <label for="atk">Atk</label>
                    <input id="atk" type="text" name="atk" value="<?php echo $personnage->getAtk()?>">
                </div>
                <div>
                    <label for="maj">Maj</label>
                    <input id="maj" type="text" name="maj" value="<?php echo $personnage->getMaj()?>">
                </div>
                <div>
                    <label for="arm">Arm</label>
                    <input id="arm" type="text" name="arm" value="<?php echo $personnage->getArm()?>">
                </div>
                <div>
                    <label for="rmj">Rmj</label>
                    <input id="rmj" type="text" name="rmj" value="<?php echo $personnage->getRmj()?>">
                </div>
                <div>
                    <label for="soin">Soin</label>
                    <input id="soin" type="text" name="soin" value="<?php echo $personnage->getSoin()?>">
                </div>
                <div>
                    <label for="vit">Vit</label>
                    <input id="vit" type="text" name="vit" value="<?php echo $personnage->getVit()?>">
                </div>
                <div>
                    <label for="phrase">Phrase</label>
                    <textarea id="phrase" name="phrase" id="" cols="30" rows="3"><?php echo $personnage->getPhrase()?></textarea>
                </div>
                <div>
                    <label for="A1">Attaque 1</label>
                    <select name="A1" id="A1">
                        <?php
                        $allAttaque = $managerA->getList();
                    
                        foreach ($allAttaque as $obj){
                            $id = $obj->getId();
                            $name = $obj->getName();
                    
                            if ( $personnage->getA1() == $obj){
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            echo "<option value='$id' $selected>$name</option>";
                        }
                        ?>
                    </select>
                </div>

                <input type="hidden" name="id" value="<?php echo $personnage->getId()?>">

                <input type="submit" value="Modifier ?">


            </form>



        <?php
        }
        
        ?>


    
    


<?php


    }
} ?>

</body>
</html>


