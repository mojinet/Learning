<?php
#------------------------#
#------ SIMPLEXML -------#
#------------------------#
// le Xml est un langage de balisage ou les balise contienne le nom de la clé et le contenu des balises leurs valeurs
// pour utiliser les élement <, >, " et & il faut utiliser des entités : respectivement &lt; &gt; &quote; &amp;

// Charger un document xml
$doc = simplexml_load_file('books.xml');
// recupérer des élements
$books = $doc->Book[0]; # On recupere la premiere balise Book
$books = $doc->Book[1]; # On recupere la deuxieme balise Book
$books = $doc->Book; # On recupere toute les balises Book
// boucle simple
foreach ($books as $book){
    var_dump($book);
}
// boucle avec recupération des balises enfant en les nommant
foreach ($books AS $book){ # On parcours ces balises
    echo '***********************' . PHP_EOL;
    echo $book->Author . PHP_EOL; # On recupere le contenu dans <Book><Author>contenu</Author></Book>
    echo $book->Title . PHP_EOL;
    echo $book->Genre . PHP_EOL;
    echo $book->Price . PHP_EOL;
}
// boucle en accedant a tout les element enfant sans les nommé
foreach ($books as $book){ # pour chaque livres
    foreach ($book->children() as $key => $value){ # Recupere tout les noeuds enfants
        echo "$key => $value \n";
    }
}
// Acces au attribut des balises
$firstBook = $doc->Book[0];
foreach ($firstBook->attributes() AS $key => $value){
    echo "$key => $value \n";
}

// Ecrire des données
$newBook = $doc->addChild('Book'); # Ajoute un noeud au document
$newBook->addChild('Autheur', 'Maurice'); # ajoute un noeud au noeud créer
$newBook->addChild('Title', 'La vie de Maurice');
$newBook->addAttribute('id', 'bk103'); # ajoute un attribut au noeud créer
echo $doc->asXML(); # affiche le XML

#--------------------------#
#------ DOMDocument -------#
#--------------------------#
// plus complet que le SIMPLEXML (qui sert surtout pour la lecture)

//charger un document
$document = new DOMDocument();
$document->load('books.xml');
# $document->loadHTMLFile('http://monsite/mondoc.html'); On peut aussi charger un fichier HTML
// sauvegarder le document
$document->save('output.xml');
# $document->saveHTML('output.html'); pour sauvegarder en HTML

// Lire un document
//$racine = $document->documentElement; # Recupere la racine du document
//$nodes = $racine->childNodes[0]->childNodes;
//var_dump($nodes);
//echo $racine->firstChild->nodeName; # nom du premier Node
//echo $racine->firstChild->nodeName; # Nom du premier enfant
//echo $racine->firstChild->nodeValue; # Valeur du premier enfant
//$noeud = $nodes->item(0); # acces a un element en particulier
//$noeud = $nodes->lenght; # nombre de noeuds

#------------------#
#------ JSON ------#
#------------------#

// encoder en JSON
$json1 = json_encode(['nom' => 'JBé', 'age' => 34]);
echo $json1; # encode en JSON : {"nom":"JB\u00e9","age":34} encode en UTF-8

// decoder du JSON
$jsonDecode = json_decode($json1, true); # Force a créer un tableau associatif, par defaut : false => transforme en objet
var_dump($jsonDecode);
echo $jsonDecode['nom'];

// serialisation d'objet en JSON
class MaClass implements  JsonSerializable{ # On implémente l'interface

    public $attr1 = 0; # Si on implémente pas l'interface lors du json_encode nous n'auront QUE les attribut public
    private $attr2 = 1;
    public function jsonSerialize()
    {
        return [ # On définie quel attribut seront serialisé
          'attr1' => $this->attr1,
          'attr2' => $this->attr2,
        ];
    }
}

$instance = new MaClass();
echo json_encode($instance); # Nous avons bien les attribut voulu


#------------------#
#------ API -------#
#------------------#
$url = 'http://monApi.fr/all';
$args = ['user' => 'bob44', 'user_id' => 1];
// requete avec cURL
$curl = curl_init(); # On initialise la requete
curl_setopt($curl, CURLOPT_URL,$url); # On définis les options, ici l'url
curl_setopt($curl, CURLOPT_POST,true); # définie si requete en POST pour sa résolution
curl_setopt($curl, CURLOPT_POSTFIELDS, $args); # on fournis un tableau associatif
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST'); # on définie la méthode PUT, GET, POST, CONNECT, HEAD etc
curl_exec($curl); # On execute la requete