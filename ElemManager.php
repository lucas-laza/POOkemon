<?php

class ElemManager{
    private $db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function setDb(PDO $db){
        $this->db = $db;
    }

    
    
    public function getList()
    {
        $query = $this->db->query("SELECT * FROM elems ORDER BY id");

        while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
            $elements[] = new Element($donnees);
        }

        return $elements;
        
    }

    public function getOne($id)
    {
        $query = $this->db->query("SELECT * FROM elems WHERE id = $id");

        $donnee = $query->fetch(PDO::FETCH_ASSOC);
        $element = new Element($donnee);
        

        return $element;
        
    }

    // public function InsertPersonnage(Personnage $perso, $bool){

        
    //     $name = $perso->getName();
    //     $elem = $perso->getElem();
    //     $pvmax = $perso->getPvmax();
    //     $atk = $perso->getAtk();
    //     $maj = $perso->getMaj();
    //     $arm = $perso->getArm();
    //     $rmj = $perso->getRmj();
    //     $soin = $perso->getSoin();
    //     $vit = $perso->getVit();
    //     $phrase = $perso->getPhrase();
    //     if ($bool == true){
    //         $id = $perso->getId();
    //         $this->db->query("INSERT INTO `personnages`(`id`, `name`, `elem`, `pvmax`, `atk`, `maj`, `arm`, `rmj`, `soin`, `vit`, `phrase`, `A1`) VALUES ('$id','$name','$elem','$pvmax','$atk','$maj','$arm','$rmj','$soin','$vit','$phrase','1')");
    //     } else {
    //         $this->db->query("INSERT INTO `personnages`(`id`, `name`, `elem`, `pvmax`, `atk`, `maj`, `arm`, `rmj`, `soin`, `vit`, `phrase`, `A1`) VALUES ('','$name','$elem','$pvmax','$atk','$maj','$arm','$rmj','$soin','$vit','$phrase','1')");
    //     }

        
        
    // }

    // public function supprPersoById($id){
    //     $query = $this->db->query("DELETE FROM `personnages` WHERE id = $id");
        
    // }


    public function getDb(){
        return $this->db;
    }

}



?>
