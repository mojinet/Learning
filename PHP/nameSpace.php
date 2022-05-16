<?php
#Exemple de fichier avec nameSpace
namespace mySpace;

# constante, fonction, class
const MYSPACE_NAME = "Mon espace";

function multiplie(int $a, int $b):int{
    return $a * $b;
}

class Avion{
    private $puissance;
    private $place;

    public function __construct(int $puissance, int $place){
        $this->puissance = $puissance;
        $this->place = $place;
    }

    public function __toString()
    {
        return "Cette avion d'une puissance de $this->puissance possede $this->place places !";
    }
}
