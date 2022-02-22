<?php

class Legendaire extends Personnage {
    private $rarete = 2;
    private $hymne = false;
    const MAXRARETE = 5;


    private static $compteurL=0;

    public function __construct($id,$name,Element $elem,$pvmax,$atk,$maj,$arm,$rmj,$soin,$vit,$phrase,Attaque $A1,$rarete) {
        $this->setId($id);
        $this->setName($name);
        $this->setElem($elem);
        $this->setPvmax($pvmax);
        $this->setPv($pvmax);
        $this->setAtk($atk);
        $this->setMaj($maj);
        $this->setArm($arm);
        $this->setRmj($rmj);
        $this->setSoin($soin);
        $this->setVit($vit);
        $this->setPhrase($phrase);
        $this->setA1($A1);

        $this->setRarete($rarete);

        $this->setCompteurL(1);
        
    }

    public static function getCompteurL()
    {
    return self::$compteurL;
    }

    public static function setCompteurL($x)
    {
    self::$compteurL += $x;
    }

    public function getRarete(){
        return $this->rarete;
    }


    public function getHymne(){
        return $this->hymne;
    }

    public function setRarete($x){
        if ($x <= self::MAXRARETE){
            $this->rarete=$x;
        }
        
    }

    private function setHymne(){
        if ($this->hymne == false){
            $this->hymne=true;
        } else if ($this->hymne == true){
            $this->hymne = false;
        }
        
    }

    public function trueHymne(){
        if ($this->hymne == false){
            $this->setHymne();
        }
    }

    public function hymne(){
        if ($this->getHymne() == false){
            $this->trueHymne();
            $this->setPvmax($this->getPvmax() + ($this->getRarete() * 15));
            $this->setPv($this->getPv() + ($this->getRarete() * 15));
            $this->setAtk($this->getAtk() + ($this->getRarete() * 5));
            $this->setMaj($this->getMaj() + ($this->getRarete() * 5));
            $this->setArm($this->getArm() + ($this->getRarete() * 5));
            $this->setRmj($this->getRmj() + ($this->getRarete() * 5));
            $this->setSoin($this->getSoin() + ($this->getRarete() * 5));
            $this->setVit($this->getVit() + $this->getRarete());
        }
        
    }
}