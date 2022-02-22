
<?php session_start();
if (isset($_SESSION["admin"])){
    if ($_SESSION["admin"] == true){
        header('Location: backOffice_perso.php');
    }
} 

if (isset($_GET["erreur"])){
    if ($_GET["erreur"] == true){
        echo "<br><div style='color:red'>mdp incorrect </div> <br>";
    }
}?>

<form action="traite_login.php" method="POST">

    
    <label for="mdp">Mot de passe pour admin</label>
    <input type="password" name="mdp" id="mdp">
    <input type="submit" value="login">





</form>



