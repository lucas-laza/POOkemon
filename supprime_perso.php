<?php

$id = $_GET["id"];
session_start();

if (isset($_GET["yes"])){
    if ($_GET["yes"] == "true"){
                function chargerClasse($classe)
        {
        require $classe . '.php';
        }
        spl_autoload_register('chargerClasse');

        $db=new PDO('mysql:host=localhost;dbname=pookemongit;port=3306', 'root', '');
        $manager = new PersonnageManager($db);
        if (isset($_SESSION["admin"])){
            if ($_SESSION["admin"] == 1){
                $manager->supprPersoById($id);
            }
        }
        header("Location: backOffice_perso.php");
    }
}

?>


<form action="" method="GET">
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <input type="hidden" name="yes" value="true">
    <h1>ETES VOUS SUR DE VOULOIR SUPPRIMER LE PERSONNAGE NUMERO <?php echo $id ?> ????</h1>
    <a href="backOffice_perso.php"><input type="button" value="NON"></a>
    <input type="submit" value="OUI">
</form>




