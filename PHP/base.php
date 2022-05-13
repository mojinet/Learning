<?php
#------------------------#
#------ Commandes -------#
#------------------------#
# php -S localhost:8080 : pour lancer serveur PHP
# php nomDuFichier.php : pour lancer un script

#------------------------#
#------ Inclusion -------#
#------------------------#
// include 'nomdufichier.php'; # inclu le fichier, si il n'est pas trouver : warning
// include_once 'nomdufichier.php'; # inclu le fichier si il ne l'es pas deja, si il n'est pas trouver : warning
// require 'nomdufichier.php'; # inclu le fichier, si il n'est pas trouver : fatal error
// require_once 'nomdufichier.php'; # inclu le fichier si il ne l'es pas deja, si il n'est pas trouver : fatal error

#------------------------#
#------ Variables -------#
#------------------------#
// utilisation strict des types
declare(strict_types=1); # utilisation strict des type, renvois une erreur en cas de mauvais type

// Declaration et type
$maVariable = 5; # integer
$couleur = 0xFFF; # hexadecimal
$prix = 54.12; # float
$isAdmin = false; # booleen
$film = "robocop"; # string
$mesNotes = [18,15,16,17]; # tableau indéxé numériquement
$employees = ['nom' => 'Jean', 'prenom' => 'Baptiste']; # tableau associatif
$matrice = [[1,2,3],[4,5,6]]; # tableau multidimentionnel, $matrice[1][2] renverra 6

//  Constante et global
const PHP_VERSION = "7.4"; # constante
$GLOBALS['maVarGlobal'] = "une variable"; # Variable global

//  Variable dynamique
$robocop = "un film avec un méca-flic" . PHP_EOL; # PHP_EOL est un retour a la ligne équivalent a \n
echo $$film; # Affichage d'une variable dynamique, ici équivalent a echo $robocop

//  Methode sur variable
is_int($prix); # test si entier, il existe pour tout les type : is_array(), is_callable(), is_float(), is_double(), etc...
gettype($film); # retourne le type de la variable
isset($maVariable); # test si existe
empty($maVariable); # test si vide
unset($type); # detruit variable
var_dump($employees);

// Conversion de type
$chaineCarac = (string) 5; # convertie en chaine de caractere
settype($prix,'string'); # convertie en chaine de caractere
strval(5); # convertie en chaine de caractere, il existe aussi intval, boolval, floatval etc...

// Affectation par copie et reference
$i = $j = 1; # ici $j vaut 1 et $i vaut $j
$y =& $i; # ici $y est une référence à $i, la modification de l'une impactera la valeur de l'autre

//Opérateur ternaire et de nullité
$thisIsNul = null;
$name = $thisIsNul !== null ? $thisIsNul : 'default'; # $name vaut $thisIsNul si non nul sinon 'default'
$name = $thisIsNul ?? 'default'; # $name vaut $thisIsNul si cette valeur est définie, sinon vaudra 'default'

#--------------------#
#------ String ------#
#--------------------#

// Utilisation de masque : %s =chaine caractere, %d =entier signé, %u =entier non signé, %f =float, %b %o et %u entier a afficher binaire/ocatal et hexadeciaml
$masque = 'Bonjour %s, tu as bien %d ans ?'; # on définie un masque
printf($masque,'JB',34);
printf('%03d', 1); # affichera toujours 3 chiffres, sera complété par des 0, donc ici 001
$textFormat = sprintf($masque,'JB',34); # enregistre la chaine de caractere dans une variable
# on peut aussi utiliser vprintf('%d %s)',[12,'salut']) et svprintf('%d %s)',[12,'salut']) ou l'ont fournira un array plutot qu'un enssemble d'arguments

// fonction sur chaine
strlen('coucou'); # renvois la longeur de la chaine
str_word_count('bonjour je suis une phrase'); # renvois le nombre de mot
str_word_count('bonjour je suis une phrase',1); # renvois les mots dans un tableau
strpos('fromage',"j'aime le fromage"); # renvois la position de fromage dans la chaine, renvois false si non trouvé
# strspn() pour rechercher si une chaine contient un caractere specifique
htmlspecialchars('<b>GRAS</b>'); # conversion des caractere spéciaux pour eviter faille
htmlspecialchars_decode(); # opération inverse
nl2br('bonjour, \nComment allez vous ?'); # convertie les retours a la ligne en balise <br /> pour l'affichage HTML
strstr('nicolas','coucou nicolas ça va ?'); # retourne le reste de la chaine apres le mot trouver, ici renvois 'ça va ?'
substr('12/03/22 16:30', 9); # recupere la sous chaine de la position 9 jusqu'a la fin
substr('12/03/22 16:30', 9,2); # recupere la sous chaine de la position 9 avec une longeur de 2
str_replace('5','7','Php 5'); # remplace la chaine de caractere 5 par 7 dans la chaine Php 5
str_replace(['pomme','poire'],'fruit', "J'aime les pomme et les poire"); # remplace tous les mots du tableau par fruit
trim('  salut   '); # retire les espace avant et apres
str_pad('PHP',10); # ajoute des espaces a la fin pour avoir une longeur de 10
str_pad('PHP',10,'.'); # ajoute des . a la fin pour avoir une longeur de 10
str_pad('PHP',10,'.', STR_PAD_RIGHT); # ajoute des . au début pour avoir une longeur de 10
strtoupper('coucou'); # renvois en majuscule
strtolower('COUCOU'); # renvois en minuscule
ucfirst('salut'); # majuscule sur le premier caractere
ucwords('societe anonyme'); # majuscule sur la premiere lettre de chaques mots

#--------------------#
#------ Scope -------#
#--------------------#
# La porté d'une variable est local et n'est pas gardé en mémoire,
# pour utiliser une variable qui est hors de la fonction on utilise global
function test(){
    global $maVariable;
    echo $maVariable;
}
test();

#----------------------#
#------ foreach -------#
#----------------------#
foreach ($mesNotes as $note){} # boucle foreach
foreach ($mesNotes as $key => $note){} # boucle foreach clé valeur
foreach ($mesNotes as &$note){} # boucle foreach par reference : modifiera aussi le tableau sur lequel on opere

#----------------------#
#------ fonction ------#
#----------------------#
/**
 * Exemple de documentation PHPDoc
 * Cette fonction affiche valeur par default si aucun argument, sinon affiche l'argument fournis lors de l'appel
 * @param $arg1
 * @return void
 */
function maFonction(string $arg1 = 'valeur par default') :void{ # fonction avec un arg de type string qui possede une valeur par defaut, ne renvois rien (void)
    echo $arg1;
}
maFonction(); # affichera valeur par default
maFonction('coucou'); # affichera coucou

// Appel de fonction a nom dynamique
$nomFonction = 'maFonction';
call_user_func($nomFonction, 'salut !'); # appel d'une fonction avec nom dynamique, on fournis le nom puis les arguments

// variable static dans fonction : garde en mémoire la valeur, n'initialise que lors du 1er appel
function countCall() :int{
    static $count = 0;
    $count++;
    return $count;
}
echo countCall(); # affiche 1
echo countCall(); # affiche 2

// nombre d'arguments variable
function sum(int ...$args) :int{ # nombre d'arguments variable, on recupere un tableau de int
    $sum = 0;
    foreach ($args as $value){
        $sum += $value;
    }
    return $sum;
}
echo sum(10,15,489,456,879);

// fonction anonyme
$fonctionAnonyme = function(){echo 'je suis anonyme';}; # fonction anonyme dans variable
$fonctionAnonyme(); # affiche je suis anonyme
(function(){echo 'coucou';})(); # Fonction anonyme appeler immédiatement : penser aux () qui englobe la fonction

// fonction interne math : pour plus de précision utiliser BCMath
max(12,45,78,654,4,21); // renvois 654 qui est la valeur max
min(12,45,78,654,4,21); # renvois 4 qui est la valeur min
round(54.5954); # renvois l'entier le plus proche
round(54.5954, 2); # renvois la valeur la plus proche avec une précision de 2 chiffre apres la virgule
ceil(54.01); # renvois l'entier immédiatement supérieur
floor(54.99); # renvois l'entier immédiatement inférieur
random_int(1,100); # renvois un nombre aléatoire entre 1 et 100 inclu
// Base
base_convert('5531',10,2); # convertie 5531 en base 10 vers une base 2 (binaire)
bindec('0110'); # binaire to decimal
decbin(15); # decimal to binaire
dechex(15); # decimal to hexa
// ASCII
ord('j'); # renvois la veleur decimal du charactere
chr(102); # renvois le charactere a partir d'une valeur decimal

#----------------------#
#------ tableaux ------#
#----------------------#
// création et ajout
$myArray = [54,59,87]; # créer un tableau de 3 valeurs
$myArray[3] = 84; # ajoute 84 a la 3em position
$myArray[] = 88; # ajoute 88 a la suite (4em)
$myArray[45] = 848; # ajoute 848 a l'indice 45

// test, longeur
count($myArray); # Compte le nombre d'entré dans le tableau
(isset($myArray) AND is_array($myArray)); # renvois true si c'est un tableau et qu'il existe

//recherche
in_array(84,$myArray); # renvois true si 84 est dans $myArray
array_search(84,$myArray); # renvois la clé et non la valeur (ici 3)
array_key_exists('nom',['prenom'=>'jean','nom'=>'coco']); # renvois true si la key 'nom' est dans le tableau
$countOcc = array_count_values(['bob','henrie','bob','marcel']); #renvois un tableau associatif avec le nombre d'occurence, par exemple $countOcc['bob'] renvois 2

//tri
sort($myArray); # tri par ordre croissant
rsort($myArray); # tri par ordre decroissant
asort(); # tri les valeurs mais garde les clé
arsort(); # idem mais decroissant
ksort(); # tri uniquement les clé
krsort(); # idem mais decroissant
natsort(); # tri plus "humain" par exemple t12 sera placer apres t2 alors que sort() fera l'inverse
// array_multisort() pour trier un tableau par rapport a un autre

// tri personnalisé
function cmp($a, $b){ return strlen($a) <=> strlen($b);} # la fonction de comparaison doit renvoyer 0,1 ou -1, ici on compare la longeur
usort($myArray, 'cmp'); # tri le tableau $myArray suivant la fonction personnalisé
// uksort() idem mais tri sur les clé

// extraction
array_slice($myArray,2,3); # extrait le tableau a partir de l'indice 2 pour une longeur max de 3
$auteur=[
  ['prenom' => 'jean', 'nom' => 'cochinard', id => 2],
  ['prenom' => 'bill', 'nom' => 'gates', id => 5],
];
array_column($auteur, 'prenom'); # renvois un tableau contenant les valeurs de prenom soit ['jean','bill']
array_column($auteur, 'prenom','id'); # renvois un tableau contenant les valeurs de prenom avec comme clé 'id' soit [2 => 'jean',5 => 'bill']

// fusion et separation
array_merge($tab1, $tab2); # fusionne les tableaux, on peut également faire la meme chose avec $tab1 + $tab2
array_chunk([1,2,8,6,4], 2); # Sépare les tableau en plusieurs tableaux de longeur 2

// explode et implode
$tab1 = explode(';','12;15;78;456;5'); # convertie la chaine en tableau
var_dump(($tab1)); # affichage pour debugage complet
$tabToString = implode(';', $tab1); # convertie le tableau en chaine
print_r($tabToString); # affichage pour debugage des valeurs