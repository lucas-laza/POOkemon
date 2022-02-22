<?php

class Element{
    private $id;
    private $name;
    
    public $dmg_e1 = 1;
    public $dmg_e2 = 1;
    public $dmg_e3 = 1;
    public $dmg_e4 = 1;
    public $dmg_e5 = 1;
    public $dmg_e6 = 1;
    public $dmg_e7 = 1;
    

    // public function __construct($id,$name,$d1,$d2,$d3) {
    //     $this->setId($id);
    //     $this->setName($name);
    //     $this->setdmg_e1($d1);
    //     $this->setdmg_e2($d2);
    //     $this->setdmg_e3($d3);
        
    // }

    public function __construct(array $donnees)
    {
        
        $this->hydrate($donnees);
        
        
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

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getdmg_e($e){
        $tempdmg_e = "dmg_e".$e;
        // var_dump($tempdmg_e);
        return $this->$tempdmg_e;
    }


    


    public function setId($x){
        $this->id = $x;
    }

    public function setName($x){
        $this->name = $x;
    }

    public function setdmg_e1($x){
        $this->dmg_e1 = $x;
    }

    public function setdmg_e2($x){
        $this->dmg_e2 = $x;
    }

    public function setdmg_e3($x){
        $this->dmg_e3 = $x;
    }

}