<?php

class PersonnageManager{
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
        $query = $this->db->query("SELECT * FROM personnages ORDER BY id");
        $tempManager = new AttaqueManager($this->getDb());
        $tempElemManager = new ElemManager($this->getDb());

        while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
            $perso = new Personnage($donnees);
            $perso->setA1($tempManager->getOne($perso->getA1()));
            $perso->setElem($tempElemManager->getOne($perso->getElem()));
            $personnages[] = $perso;
        }
       
        return $personnages;
        
    }

    public function getOne($id)
    {
        $query = $this->db->query("SELECT * FROM personnages WHERE id = $id");
        $tempManager = new AttaqueManager($this->getDb());
        $tempElemManager = new ElemManager($this->getDb());

        $donnee = $query->fetch(PDO::FETCH_ASSOC);
        $personnage = new Personnage($donnee);
        $personnage->setA1($tempManager->getOne($personnage->getA1()));
        $personnage->setElem($tempElemManager->getOne($personnage->getElem()));
        

        return $personnage;
        
    }

    public function InsertPersonnage(Personnage $perso, $bool){

        
        $name = $perso->getName();
        $elem = $perso->getElem();
        $pvmax = $perso->getPvmax();
        $atk = $perso->getAtk();
        $maj = $perso->getMaj();
        $arm = $perso->getArm();
        $rmj = $perso->getRmj();
        $soin = $perso->getSoin();
        $vit = $perso->getVit();
        $phrase = $perso->getPhrase();
        $A1 = $perso->getA1();
        if ($bool == true){
            $id = $perso->getId();
            $this->db->query("INSERT INTO `personnages`(`id`, `name`, `elem`, `pvmax`, `atk`, `maj`, `arm`, `rmj`, `soin`, `vit`, `phrase`, `A1`) VALUES ('$id','$name','$elem','$pvmax','$atk','$maj','$arm','$rmj','$soin','$vit','$phrase','$A1')");
        } else {
            $this->db->query("INSERT INTO `personnages`(`id`, `name`, `elem`, `pvmax`, `atk`, `maj`, `arm`, `rmj`, `soin`, `vit`, `phrase`, `A1`) VALUES ('','$name','$elem','$pvmax','$atk','$maj','$arm','$rmj','$soin','$vit','$phrase','$A1')");
        }

        
        
    }

    public function ModifPerso(Personnage $perso){
        $name = $perso->getName();
        $elem = $perso->getElem();
        $pvmax = $perso->getPvmax();
        $atk = $perso->getAtk();
        $maj = $perso->getMaj();
        $arm = $perso->getArm();
        $rmj = $perso->getRmj();
        $soin = $perso->getSoin();
        $vit = $perso->getVit();
        $phrase = $perso->getPhrase();
        $A1 = $perso->getA1();

        $id = $perso->getId();

        $this->db->query("UPDATE `personnages` SET `id`='$id',`name`='$name',`elem`='$elem',`pvmax`='$pvmax',`atk`='$atk',`maj`='$maj',`arm`='$arm',`rmj`='$rmj',`soin`='$soin',`vit`='$vit',`phrase`='$phrase',`A1`='$A1' WHERE id= $id");
        
    }

    public function supprPersoById($id){
        $query = $this->db->query("DELETE FROM `personnages` WHERE id = $id");
        
    }

    public function getDb(){
        return $this->db;
    }


}



?>
