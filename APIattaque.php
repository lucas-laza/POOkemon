<?php

$db=new PDO('mysql:host=localhost;dbname=pookemongit;port=3306', 'root', '');





   
if (isset($_GET["id"])){
    $id = $_GET["id"];
    $stmt = $db->query("SELECT * FROM attaques WHERE id = $id ");
    $result = $stmt->fetch();
    echo json_encode($result);
} else {
    echo "entrer un id d'attaqye";
    ?>
    <form action="" method="GET">
        <label for="id">id</label>
        <input type="number" name="id" id="id" min="1" value="1">
        <input type="submit" value="valider">
    </form>

    <?php
}



?>