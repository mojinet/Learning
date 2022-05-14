<?php
#------------------------#
#------ POO : base ------#
#------------------------#

# ------------------------- #
#--------- Class ---------- #
# ------------------------- #

class Voiture{
    # attribut
    public $modele; # attribut public : accessible a l'exterieur de l'objet
    public $annee; # attribut public
    private $vitesse;
    private $plaqueImma; # attribut public : accessible uniquement par l'objet,
    protected $marque; # attribut protected : accessible uniquement par l'objet et les objet hérité
    const NB_ROUE = 4; # constante de class
    static public $count =0; # variable static
    # constructeur
    public function __construct(string $marque, string $modele, int $annee){
        $this->marque = $marque;
        $this->modele = $modele;
        $this->annee = $annee;
        self::$count++; # incremente de 1 la variable static
    }
    # méthode
    public function freiner(int $forceDeFreinage):void{ # reçois un attribut de type int et ne renvois rien
        echo "Freine d'une force de $forceDeFreinage sur une vitesse de $this->vitesse"; # this permet de faire reference a l'objet en cours
        self::NB_ROUE; # accede a une constante de l'objet
    }
    final public function klanon(){ # aucune class enfant ne peut modifier cette méthode
        echo 'BIPPPP';
    }
    static public function getCount(){
        return self::$count;
    }
    # methode generique
    public function __tostring():string{ # méthode qui retourne une string lors de l'affichage d'un objet
        return "vous roulez avec une $this->marque de modele $this->modele !";
    }
    public function __clone(){ # sera appeler en cas de clonage
        $this->marque = 'default'; # si l'objet est copié on donnera la valeur default a l'attribut marque
    }
}

// instanciation
$voiture = new Voiture('Audi','A4',2010);
// utiliser une methode
$voiture->freiner(4);
echo $voiture; # utilise la méthode __tostring() pour le rendu
// acceder a un element public
$voiture->modele; # acces a l'attribut modele de la voiture
$voiture::NB_ROUE; # acces a la valeur d'une constante

// vérifier qu'un objet est une instance d'une class
$voiture instanceof Voiture; # return true si $voiture est une instance de Voiture
get_class($voiture); # return le nom de la class de l'objet
get_parent_class($voiture); # return le nom de la class parente de la class de l'objet

// copie d'objet
$voiture2 = $voiture; # ici les deux variable font référence au meme espace mémoire
$voiture3 = clone $voiture; # ici $voiture3 est une copie de $voiture mais ne font pas référence au meme espace memoire

//appel methode et attribut static
Voiture::$count; # appel un attribut static
Voiture::getCount(); # appel une méthode static

# ------------------------- #
# ------- Heritage -------- #
# ------------------------- #

class VoitureElectrique extends Voiture{
    public function __construct(string $marque, string $modele, int $annee)
    {
        parent::__construct($marque, $modele, $annee); # fait appel au constructeur de la class mere
    }
    # redefinition de méthode avec appel a l'ancienne
    # attention si on redéfinie une méthode private créera une nouvelle méthode avec le meme nom
    # si c'est une méthode de la classe mere qui l'appel, elle fera appel a la méthode de la classe mere
    # tandis que si c'est une méthode de la classe hérité qui l'appel, fera appel a la méthode de la class hérité
    public function freiner(int $forceDeFreinage): void
    {
        parent::freiner($forceDeFreinage); #fait appel au instruction de la classe parente
        echo "Je freine bien car je suis electrique";
    }
}

# ------------------------- #
# ---- Class abstraite ---- #
# ------------------------- #
abstract class Vehicule{ # On fera hérité cette classe a une classe concrete et celle ci DOIT implémenter les méthode définie comme abstraite
    abstract public function avancer(); # Une class qui possede des méthode abstraite DOIT etre abstraite
    abstract public function arreter();
}

# ------------------------- #
# ------ Class final ------ #
# ------------------------- #
final class Audi{ # une classe final ne peut pas avoir de class enfant
    # instruction
}

# ------------------------- #
# ------- Interface ------- #
# ------------------------- #
interface PeutAvancer{ # les classe qui implémente ces méthode doivent les définir
    public function avancer(); # seul des méthode public sont possible
    public function arreter();
}

class Moto implements PeutAvancer{ # on peut mettre plusieurs interfaces

    public function avancer()
    {
        // TODO: Implement avancer() method.
    }

    public function arreter()
    {
        // TODO: Implement arreter() method.
    }
}