<?php

class Attaque{
    private $id;
    private $name;
    private $type;
    private $elem;
    private $puissance;

    // public function __construct($name,$type,Element $elem,$puissance) {
    //     $this->name = $name;
    //     $this->type = $type;
    //     $this->elem = $elem;
    //     $this->puissance = $puissance;
        
    // }


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

    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
        // $this->setCompteur(1);
    }


    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getType(){
        return $this->type;
    }
    public function getElem(){
        return $this->elem;
    }
    public function getPuissance(){
        return $this->puissance;
    }
    

    public function setId($x){
        $this->id =$x;
    }
    public function setName($x){
        $this->name = $x;
    }
    public function setType($x){
        $this->type = $x;
    }
    public function setElem($x){
        $this->elem = $x;
    }
    public function setPuissance($x){
        if ($x >= 200){
            $this->puissance = 200;
        } else {
            $this->puissance = $x;
        }
        
    }

    
}