<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<a href="login.php">Back office</a>
<a href="creer_personnage.php">Créer un pookemon</a>
<br><br>
<h1>Combat de POOkemons</h1>

<?php

session_start();


$db=new PDO('mysql:host=localhost;dbname=pookemongit;port=3306', 'root', '');
// include ("PersonnageManager.php");
// include "Personnage.php";


function chargerClasse($classe)
{
require $classe . '.php';
}
spl_autoload_register('chargerClasse');

$emanager = new ElemManager($db);
$amanager = new AttaqueManager($db);
$manager = new PersonnageManager($db);



// echo($manager->getList());



$tab = $manager->getList();
$tabA = $amanager->getList();
// var_dump($tabA);
// var_dump($tab);
if ((isset($_GET["p1"])) && (isset($_GET["p2"]))){
    echo "<div class='combat'";
    echo("<br><br> <input type='button' value='Rejouer le combat' onClick='window.location.reload()'> <br><br>");
    $p1 = $manager->getOne($_GET["p1"]);
    $p2 = $manager->getOne($_GET["p2"]);
    $r = 1;
    $rounds = true;

    while ($rounds == true){
        $rounds = rounds($r,$p1,$p2); 
        $r++;

        if ($rounds != true){
            if ($p1->isAlive() == true){
                $winner = "1, " . $p1->getName();
            } else if ($p2->isAlive() == true){
                $winner = "2, " . $p2->getName();
            }
            echo "<br><br><br>
            #################### <h3>Le joueur $winner est vainqueur !!!</h3> ####################
            <br><br><br>
            ";
        }
    
    }
    
    echo "</div>";
    

}




?>
<br><br>
<div class="choix">
<h2>Choisi tes Pookemons</h2>
<form action="" method="GET">

<?php if (!isset($_GET["p1"])){

    if (isset($_GET["p2"])){
        $p2 = $_GET["p2"];
        echo "<input type='hidden' name='p2' value='$p2'>";
    }

?>
<div>
<h3>Ton Pookemon</h3>



    
    <select name="p1" id="p1" onchange="fetchPerso(this.value,1)">
    <!-- <option value="">Faites un choix !</option> -->
        <?php
    
            $liste = $manager->getList();
    
            foreach ($liste as $obj){
                $value = $obj->getId();
                echo "<option value=\"$value\">";
                echo $obj->getName();
                echo "</option>";
            }
        ?>
    </select>
            
    <!-- <input type="submit" value="Selectionner"> -->

    <?php }
    if (!isset($_GET["p2"])){ if (isset($_GET["p1"])){
        $p1 = $_GET["p1"];
        echo "<input type='hidden' name='p1' value='$p1'>";
    } ?>

    <div class="zone1 zone"></div>
    </div>
    <div>
    <h3>Le Pookemon adverse</h3>
    
    <select name="p2" id="p2" onchange="fetchPerso(this.value,2)">
    <!-- <option value="">Faites un choix !</option> -->
    <?php
    
            $liste = $manager->getList();
    
            foreach ($liste as $obj){
                $value = $obj->getId();
                echo "<option value=\"$value\">";
                echo $obj->getName();
                echo "</option>";
            }
        ?>
    </select>
    <div class="zone2 zone"></div>
    </div>
    <!-- <input type="submit" value="Selectionner"> -->
    <br><br>

    <?php } ?>

    <div>
    <h5><input type="submit" value="<?php if ((!isset($_GET["p1"])) && (!isset($_GET["p2"]))){echo "jouer"; } else { echo "Reset"; } ?>"></h5>
    </div>
</form>

<form action="" method="GET">

</form>
</div>

<?php

function whoIsFirst(Personnage $a, Personnage $b){
    $vitA = $a->getVit() + random_int(0,7);
    $vitB = $b->getVit() + random_int(0,7);

    $sorting = random_int(0,1);
    

    if ($vitA < $vitB){
        return $b;
    } else if ($vitA > $vitB){
        return $a;
    } else if ($vitA == $vitB){
        if (($vitA*$a->getVit()) > ($vitB*$b->getVit())){
            return $a;
        } else if (($vitA*$a->getVit()) < ($vitB*$b->getVit())){
            return $b;
        } else {
            $vitA = $a->getVit() * random_int(1,5) + random_int(10,50);
            $vitB = $b->getVit() * random_int(1,5) + random_int(10,50);

            if ($vitA > $vitB){
                return $a;
            } else if ($vitB > $vitA) {
                return $b;
            } else if ($sorting == 0){
                return $a;
            } else{
                return $b;
            }
        }
    }
    
}

function rounds($r,Personnage $p1, Personnage $p2){
    echo "<br><br>";
    echo "============== Round $r ! ==================== <br>";
    $first = whoIsFirst($p1,$p2);
    if ($first == $p1){
        echo($p1->attaquer($p2));
        echo "<br><br>  ";
        if ($p2->isAlive() == true){
            echo($p2->attaquer($p1));
            if ($p1->isAlive() == true){
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
          
    } else {
        echo($p2->attaquer($p1));
        echo "<br><br>  ";
        if ($p1->isAlive() == true){
            echo($p1->attaquer($p2));
            if ($p2->isAlive() == true){
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
        
    }
    
}

?>

<div class="footer">
    <h5>Site de Laza Lucas - projet en PHP orienté objet.</h5>
</div>

<script>
    let element = '';
    let img = '';

    fetchPerso(1,1)
    fetchPerso(1,2)


    function fetchPerso(id,zone){
        fetch(`API.php?id=${id}`)
            .then( resp => resp.json())
            .then(data => {
            
                if (data.img == 0){
                    img = '<br><br><div>***Pas de photo disponible***</div><br><br>';
                } else {
                    img = `<div class='img' style="background-image:url('img/perso/${data.id}.png')"></div>`;
                }
                document.querySelector(`.zone${zone}`).innerHTML =
                 `${img}
                 <table>
                 <tr>
                 <td>Element<td> <td class="leElem">${element.name}</td>
                 </tr>
                 <tr>
                 <td>Points de vie<td> <td>${data.pvmax}</td>
                 </tr>
                 <tr>
                 <td>Points d'attaque<td> <td>${data.atk}</td>
                 </tr>
                 <tr>
                 <td>Points de magie<td> <td>${data.maj}</td>
                 </tr>
                 <tr>
                 <td>Armure<td> <td>${data.arm}</td>
                 </tr>
                 <tr>
                 <td>Resitance magique<td> <td>${data.rmj}</td>
                 </tr>
                 <tr>
                 <td>Puissance de soins<td> <td>${data.soin}</td>
                 </tr>
                 <tr>
                 <td>Vitesse<td> <td>${data.vit}</td>
                 </tr>
                
                
                </table>
                `;
                fetchElem(data.elem,`.zone${zone} .leElem`);
                fetchAttq(data.A1,zone);
                // document.querySelector(`.zone${zone}`).innerHTML += `${data.name}`;
            })
    }

    function fetchElem(id,target){
        fetch(`APIelem.php?id=${id}`)
            .then( resp => resp.json())
            .then(data => {
                document.querySelector(`${target}`).innerHTML = data.name;
            })
    }

    let typeA1='';
    function fetchAttq(id,zone){
        fetch(`APIattaque.php?id=${id}`)
            .then( resp => resp.json())
            .then(data => {
                document.querySelector(`.zone${zone}`).innerHTML += `
                <br><br>
                <table class='atq'>
                <th><td>Attaque 1<td></th>
                <tr><td>Nom<td><td>${data.name}<td></tr>
                <tr><td>Elem<td><td class="elemAtq"><td></tr>
                <tr><td>Puissance<td><td>${data.puissance}<td></tr>
                <tr><td>Type<td><td class="type"><td></tr>

                </table>`;
                if (data.type == 0){
                     typeA1 = 'Physique';
                } else {
                     typeA1 = 'Magique';
                }
                document.querySelector(`.zone${zone} .type`).innerHTML = typeA1;
                fetchElem(data.elem,`.zone${zone} .elemAtq`);

            })

            
            
    }

    




</script>