<?php
#-------POO avancé

#--------------------------#
#------- Namespace --------#
#--------------------------#
# Définir un espace de nom : doit etre la premiere instruction (les commentaires sont permis)
//namespace monEspaceDeNom;
# il n'existe pas de norme pour les appelation mais il est préférable d'utiliser des convention tel que la PSR-4

# utiliser un espace de nom
require __DIR__ . '/nameSpace.php'; # on ajoute le fichier contenant l'espace de nom
$avion = new mySpace\Avion(500,345);
# $avion = new \mySpace\Avion(500,345); Si nous somme deja dans un espace de nom utiliser le chemin avec le \ devant
echo $avion. PHP_EOL;
// On peut également déclarer l'utilisation sans utiliser le nom pleinement qualifier
use mySpace\Avion; # On déclare l'utilisation de la class Avion du namespace mySpace
use const mySpace\MYSPACE_NAME; # ... et d'une constante
use function mySpace\multiplie; #... et d'une fonction
// ALIAS et syntaxe alternative pour importé plusieurs use
use mySpace\{
    Avion AS TrucQuiVole, # On pourra utiliser TrucQuiVole a la place d'avion
    MYSPACE_NAME AS MON_ESPACE,
    multiplie AS multiple
};
$avion2 = new TrucQuiVole(850,3); # On peux maintenant utiliser Avion sans utiliser le nom pleinement qualifié
echo $avion2 . PHP_EOL;

# Connaitre l'espace de nom courant
echo __NAMESPACE__ . PHP_EOL; # renvois l'espace de nom courant (chaine vide si namespace sur \

#--------------------------#
#------- Autoload ---------#
#--------------------------#
# le principe est de chargé automatiquement les class necessaire a l'execution du script dans un espace donnée

// Création d'une fonction d'auto chargement simple
function loadItem(string $className){
    require 'src/' . $className . '.php'; # On considere que les classe sont dans un dossier src
}
// On fournis notre fonction de chargement a PHP
spl_autoload_register('loadItem');
# spl_autoload_register(); # On peut également ne pas créer de fonction et appeler la méthode sans argument, le chargement sera automatique, DECONSEILLER par non compatible PSR-4
# spl_autoload_register('autreLoader'); # On peut mettre plusieurs callback de recherche qui seront utiliser l'un apres l'autre
// On peut maintenant utiliser l'autoloader
$test = new ClassTest();
echo $test . PHP_EOL;

#------------------------#
#-------- Trait ---------#
#------------------------#
// Un trait est un enssemble de méthodes pouvant etre "implémenter" dans une classe, les traits ne peuvent pas etre instancier
// Déclarer des traits
trait MonTrait1 {
    public function coucou(){ echo 'coucou';}
}

trait Montrait2 {
    public function salut(){ echo 'salut';}
}
// intégré des traits dans une classe
class TestTrait{
    use MonTrait1,Montrait2; # on déclare l'utilisation des traits avec use dans une classe
}

#----------------------------#
#-------- Iterateur ---------#
#----------------------------#
// Lors d'une itération d'un objet a l'aide de foreach par exemple, on est limité au attribut public, il faut donc utiliser des itérateurs pour pousser les possibilités
// un itérateur est un objet qui permet de parcourir un autre objet, on doit créer une class avec l'interface iterator
class ListUtilisateurIterator implements iterator{
    private $logins = [];
    private $uids = [];
    private $index = 0;

    public function __construct($logins, $uids){
        $this->uids = $uids;
        $this->logins = $logins;
    }

    public function current(){ # retourne le resultat courant : ici la valeur du login a l'index en cours
        return $this->logins[$this->index];
    }

    public function next(){ # positionne sur le prochain index
        $this->index += 1;
    }

    public function key(){ # retourne la clé du resultat courant : ici la valeur de uid a l'index en cours
        return $this->uids[$this->index];
    }

    public function valid(){ # vérifie si il reste des resultats a affiché : true/false
        return $this->index + 1 <= count($this->logins);
    }

    public function rewind(){ # premiere methode appeler, doit pointer sur le 1er element
        $this->index = 0;
    }
}
// création de la class sur laquel opere l'itérateur avec l'interface iteratorAggregate
class ListUtilisateur implements iteratorAggregate{
    private $logins = [];
    private $uids = [];

    public function ajouteUtilisateur(int $uid, $login){
        $this->uids[] = $uid;
        $this->logins[] = $login;
    }

    public function getIterator(){ # méthode a implémenter qui doit retourner l'iterator
        return new ListUtilisateurIterator($this->uids,$this->logins);
    }
}

// on initialise et on ajoute des valeurs
$liste = new ListUtilisateur();
$liste->ajouteUtilisateur(101,'Jean');
$liste->ajouteUtilisateur(102,'Phil');
$liste->ajouteUtilisateur(103,'Bill');
$liste->ajouteUtilisateur(104,'John');
$liste->ajouteUtilisateur(105,'Bob');

// on itere
foreach ($liste as $uid => $login){ # Lors du foreach ce sera l'itérateur que l'on as définie qui sera utiliser
    printf("User #%d : %s \n", $uid,$login);
}

# Générateur
// a voir aussi : yiel from, send()
// les generateur sont des itérateur a l'ecriture simplifier sous forme de fonction/methode
function listUserGenerator($uids, $logins){
    for ($i = 0; $i < count($logins); $i++){
        yield $uids[$i] => $logins[$i]; # génére une valeur a renvoyé lors de l'itération
    }
    return 'Fin'; # On PEUT utiliser un return en cas de besoin hors de l'itération
}
// on itere
$generateur = listUserGenerator([10,20,50,30],['Jean','Bob','Michel','Marc']);
foreach ($generateur as $uid => $login){
    printf("User #%d : %s \n", $uid, $login);
}
$generateur->getReturn(); # pour recupérer le return