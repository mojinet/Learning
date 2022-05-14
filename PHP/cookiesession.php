<?php
#------------------------#
#-------- Cookie --------#
#------------------------#
// Les cookies doivent etre envoyer avant toute instruction HTML
// Limite des cookies a 20/site et 4ko nom compris

// créer un cookie
setcookie('PHP',7); # Créer un cookie avec comme clé PHP et valeur 7, ici pas de date, ne sera pas stocker sur le disque dur utilisateur
setcookie('PHP',7,mktime(0,0,0,12,31,2037)); # Créer un cookie avec comme clé PHP et valeur 7, expiration 31/12/2037 a 0:0:0
setcookie('PHP',7,'/actu'); # ne sera disponible que sur www.mondomaine/actu
setcookie('PHP',7,'/','www.mondomain.fr'); # ne sera disponible que sur www.mondomaine.fr (et non sur un sous domaine par exemple www.domaine.mondomaine.fr)
setcookie('PHP',7, strtotime('+2 months')); # le cookie sera valable 2 mois
// lire un cookie
$_COOKIE['PHP']; # contient la valeur de notre cookie créer, un cookie créer ne sera lisible qu'apres le chargement d'une nouvelle page, attention il faut échaper les caractere aussi!
// supprimer un cookie
setcookie('PHP', '', 1); # créer un cookie avec une date d'expiration passé : le suprimera
unset($_COOKIE['PHP']); # Penser également a unset le cookie de $_COOKIE[] pour éviter de l'utiliser par la suite dans ce meme script

// serialisation : pour sauvegarder des données plus complexe, tableau, objet etc
$array = ['nom'=>'Bill','prenom'=>'Gates'];
$serialized_array = serialize($array);
setcookie('user', $serialized_array, mktime(0,0,0,12,31,2023));
// deserialisation
$array = unserialize($_COOKIE['user']);

#------------------------#
#-------- Session -------#
#------------------------#
// Les session sont des données stocké coté serveur le temps d'une visite

// Initialisation
session_start(); # Démarre la session, a placer avant toute instruction html

// Créer variable de session
$_SESSION['userName'] = 'bob';
$_SESSION['user'] = ['name'=>'jean','age'=>34]; # On peut directement stocker des objets "complexe" : tableau, objet etc..

// detruire la session
session_destroy(); # détruit la session mais pas les variable de session