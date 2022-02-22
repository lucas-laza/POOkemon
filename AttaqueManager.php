<?php

class AttaqueManager{
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
        $query = $this->db->query("SELECT * FROM attaques");
        $tempManager = new ElemManager($this->getDb());

        while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
            $attaque = new Attaque($donnees);
            
            // var_dump($tempManager->getOne($attaque->getElem()));
            $attaque->setElem($tempManager->getOne($attaque->getElem()));
            
            $attaques[] = $attaque;
            // var_dump($attaques);
        }
        return $attaques;
    }

    public function getOne($id)
    {
        $query = $this->db->query("SELECT * FROM attaques WHERE id = $id");
        $tempManager = new ElemManager($this->getDb());

        $donnee = $query->fetch(PDO::FETCH_ASSOC);
        $attaque = new Attaque($donnee);
        // var_dump($attaque);
        $attaque->setElem($tempManager->getOne($attaque->getElem()));
        

        return $attaque;
        
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
