<?php

class Personnage{

    protected $id;
    protected $name;
    protected $elem;
    protected $pvmax = 100;
    protected $pv = 100;
    protected $atk = 20;
    protected $maj = 20;
    protected $arm = 20;
    protected $rmj = 20;
    protected $soin = 20;
    protected $vit = 5;
    protected $phrase = "À la bataille !";
    protected $A1;

    const MAXPV = 500;
    const BASEPV = 150;
    const MAXVIT = 10;

    private static $compteur=0;
    
    // public function __construct($id,$name,Element $elem,$pvmax,$atk,$maj,$arm,$rmj,$soin,$vit,$phrase,Attaque $A1) {
    //     $this->setId($id);
    //     $this->setName($name);
    //     $this->setElem($elem);
    //     $this->setPvmax($pvmax);
    //     $this->setPv($pvmax);
    //     $this->setAtk($atk);
    //     $this->setMaj($maj);
    //     $this->setArm($arm);
    //     $this->setRmj($rmj);
    //     $this->setSoin($soin);
    //     $this->setVit($vit);
    //     $this->setPhrase($phrase);
    //     $this->setA1($A1);

    //     $this->setCompteur(1);
        
    // }

    public function __construct(array $donnees)
    {
        
        $this->hydrate($donnees);
        $this->setPv($this->getPvmax());
        $this->setCompteur(1);
    }


    public function hydrate(array $donnees){

        

        foreach ($donnees as $key => $value) {
            // On récupère le nom du setter correspondant à l'attribut.
            
            $method = 'set'.ucfirst($key);
            // Si le setter correspondant existe.
            if (method_exists($this, $method)) {
                // On appelle le setter.
                $this->$method($value);
            }
        }

    }


    public static function getCompteur()
    {
    return self::$compteur;
    }

    public static function setCompteur($x)
    {
    self::$compteur += $x;
    }


    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getElem(){
        return $this->elem;
    }
    public function getPvmax(){
        return $this->pvmax;
    }
    public function getPv(){
        return $this->pv;
    }
    public function getAtk(){
        return $this->atk;
    }
    public function getMaj(){
        return $this->maj;
    }
    public function getArm(){
        return $this->arm;
    }
    public function getRmj(){
        return $this->rmj;
    }
    public function getSoin(){
        return $this->soin;
    }
    public function getVit(){
        return $this->vit;
    }
    public function getPhrase(){
        return $this->phrase;
    }
    public function getA1(){
        return $this->A1;
    }

    public function setId($x){
        $this->id = $x;
    }
    public function setName($x){
        $this->name = $x;
    }
    // public function setElem(Element $x){
    //     $this->elem = $x;
    // }
    public function setElem($x){
        $this->elem = $x;
    }
    public function setPvmax($x){
        if ($x > self::MAXPV) {
            $this->pvmax = self::MAXPV;
            return "PV trop hauts";
           
        } else {
            $this->pvmax = $x;
            return "yes";
            
        }
    }
    public function setPv($x){
        if ($x > $this->getPvmax()){
            $this->pv = $this->getPvmax();
        } else{
            $this->pv = $x;
        }
    }
    public function setAtk($x){
        $this->atk = $x;
    }
    public function setMaj($x){
        $this->maj = $x;
    }
    public function setArm($x){
        $this->arm = $x;
    }
    public function setRmj($x){
        $this->rmj = $x;
    }
    public function setSoin($x){
        $this->soin = $x;
    }
    public function setVit($x){
        if ($x <= self::MAXVIT){
            $this->vit = $x;
        } else {
            $this->vit = 10;
        }
        
    }
    public function setPhrase($x){
        $this->phrase = $x ;
    }
    public function setA1($x){
        $this->A1 = $x;
    }
    
    public function crier(){
        echo "$this->name crie \"$this->phrase\" <br>";
    }

    public function regenerer(){
        $this->setPv(($this->getPv() + $this->getSoin()));
    }

    // public function regenDuProf(){

    // }

    
    public function attaquer(Personnage $mechant){
       $type = $this->getA1()->getType();
       if ($type == 0){
        return $this->physique($mechant,$this->A1);
       } else {
        return $this->sort($mechant,$this->A1);
       }
    }

    public function physique(Personnage $mechant, Attaque $A){
        if ($this->getElem() == $A->getElem()){
            $stab = 1.5;
            $stabText = "STAB !";
        } else {
            $stab = 1;
            $stabText = "";
        }
        $pvBefore = $mechant->getPv();
        $crit = $this->crit();
        $modif = random_int(7,14) / 10;
        $dmgtot = round(((((($this->getAtk() * (1 + ($A->getPuissance() / 100))) * (1 - ($mechant->getArm() / 100))) * $stab ) * $crit * $modif)* $A->getElem()->getdmg_e($mechant->getElem()->getId())), 0, PHP_ROUND_HALF_UP);
        $mechant->setPv($mechant->getPv() - $dmgtot);
        $thisName = $this->getName();
        $mechantName = $mechant->getName();
        $atqname = $A->getName();
        $mechantPv = $mechant->getPv();

        if (($A->getElem()->getdmg_e($mechant->getElem()->getId())) == 2){
            $effi = "C'est super efficace !";
        } else if (($A->getElem()->getdmg_e($mechant->getElem()->getId())) == 0.5){
            $effi = "Ce n'est pas très efficace...";
        } else{
            $effi = "";
        }
        if ($crit == 1.5){
            $critTexte = "Coup critique !";
        } else {
            $critTexte ="";
        }
        $isAlive = $mechant->isAliveText($mechant->isAlive());
        $pvAfter = $pvBefore - $dmgtot;
        return "$thisName lance le sort $atqname à $mechantName, il lui reste $mechantPv PV. $effi $stabText. $critTexte<br>Dégats: $dmgtot: $pvBefore pv => $pvAfter pv: $isAlive  ";
    }

    public function sort(Personnage $mechant, Attaque $A){
        if ($this->getElem() == $A->getElem()){
            $stab = 1.5;
            $stabText = "STAB !";
        } else {
            $stab = 1;
            $stabText = "";
        } 
        $pvBefore = $mechant->getPv();
        $crit = $this->crit();
        $modif = random_int(7,14) / 10;
        $dmgtot = round(((((($this->getMaj() * (1 + ($A->getPuissance() / 100))) * (1 - ($mechant->getRmj() / 100))) * $stab ) * $crit * $modif)* $A->getElem()->getdmg_e($mechant->getElem()->getId())), 0, PHP_ROUND_HALF_UP);
        $mechant->setPv($mechant->getPv() - $dmgtot);
        $thisName = $this->getName();
        $mechantName = $mechant->getName();
        $atqname = $A->getName();
        $mechantPv = $mechant->getPv();
        if (($A->getElem()->getdmg_e($mechant->getElem()->getId())) == 2){
            $effi = "C'est super efficace !";
        } else if (($A->getElem()->getdmg_e($mechant->getElem()->getId())) == 0.5){
            $effi = "Ce n'est pas très efficace...";
        } else{
            $effi = "";
        }

        if ($crit == 1.5){
            $critTexte = "Coup critique !";
        } else {
            $critTexte ="";
        }
        $isAlive = $mechant->isAliveText($mechant->isAlive());
        $pvAfter = $pvBefore - $dmgtot;
        return "$thisName lance le sort $atqname à $mechantName, il lui reste $mechantPv PV. $effi $stabText. $critTexte<br>Dégats: $dmgtot: $pvBefore pv => $pvAfter pv: $isAlive  ";
    }

    public function isAlive(){
        if($this->getPv() > 0){
            return true;
        } else{
            return false;
        }
    }

    public function isAliveText(bool $bool){
        $nom = $this->getName();
        if ($bool == true){
            return "$nom est vivant !";
        } else{
            return "$nom est mort !";
        } 
    }

    // function db(){
    //     return include "pdo.php";
    // }

    function crit(){
        $num = random_int(1,100);
        if ($num >= 85){
            return 1.5;
        } else { return 1; }
    }

}


//fonction is_null() c'est sympa