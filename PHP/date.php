<?php
#------------------------------------#
#--------- Date : timestamp ---------#
#------------------------------------#
// timestamp basé sur le temps écouler depuis le 1 janvier 1970


/*
 * d jour du mois sur 2 chiffre (01 à 31)
 * g heure au format 12h sans 0 initial (1 à 12)
 * G heure au format 24h sans 0 initial (0 à 23)
 * h heure au format 12h avec 0 initial (01 à 12)
 * H heure au format 24h avec 0 initial (01 à 23)
 * i minute avec 0 initial
 * j jour du mois sans 0 initial (1 à 31)
 * m mois au format numerique avec 0 initial ( 01 à 12)
 * M mois en 3 lettre, en anglais
 * n mois sans 0 initial (1 à 12)
 * s seconde avec 0 initial 00 à 59
 * W numéro de la semaine dans l'année
 * Y année a 4 chiffre
 * y année a 2 chiffre
 * Z jour de l'année
 * */

// Afficher une date
$timestamp = time(); # Recupere la date actuel
echo date('Y-m-d H:i:s', $timestamp); # l'affiche sous le format Y-m-d H:i:s
echo date(mktime(0,0,0,5,7,1985)); # l'affiche sous le format Y-m-d H:i:s

// calculer un timestamp a partir d'une date
echo strtotime('7 May 1985');
echo strtotime('1985-05-07');
echo strtotime('+7 days', mktime(0,0,0,5,7,1985)); # ajoute 7 jours sur la date donnée
echo strtotime('next month'); # ajoute 1 mois a la date actuel

// Définir un fuseaux horaire
date_default_timezone_set('Europe/Paris'); # sur le fuseau horaire de paris
date_default_timezone_set('America/New_York'); # sur le fuseaux horaire de new york

// Définir la langue d'affichage et afficher
setlocale(LC_TIME, 'fr_FR.utf8');
echo strftime('%A %d %B %Y', $timestamp); # affichera la date du jour façon FR : dimanche 15 mai 2022
setlocale(LC_TIME, 'en_US.utf8');
echo strftime('%A %d %B %Y', $timestamp); # affichera la date du jour façon EN

// Vérifier validité d'une date
$anniversaire = '07/02/1988';
$parts = explode('/',$anniversaire); # créer un tableau avec 3 valeur : 07, 02 et 1988
checkdate($parts[1], $parts[0],$parts[2]); # renvois true si correct, attention on fournis au format month-day-year

// mesurer le temps d'execution d'instruction
$tps1 = microtime(true);
    // instruction
$tps2 = microtime(true);
$tps = $tps2 - $tps1; # donnera un float seconde.microseconde

#------------------------------------#
#--------- Date : DateTime ----------#
#------------------------------------#
// stocké sur 64bit (timestamps sur 32) ce qui permet des date allant de 292 billions d'années dans le passé et autant dans le futur

// Définir un fuseau horaire
$paris = new DateTimeZone('Europe/Paris');
$paris = new DateTimeZone('America/New_York');

// Créer un objet datetime
$dt = new DateTime(); # créer une date a l'instant ou elle est appeler
$dt2 = new DateTime('2016-01-01 12:35:15'); # créer une date au 1 janvier 2016
$dt3 = new DateTime('next friday'); # créer une date au prochain friday
$dt4 = new DateTime('2016-01-01 12:35:15', $paris); # date time accepte également en 2em parametre un fuseau horaire
$dt5 = new DateTime('@1454512118'); # fournis un timestamp, doit toujours etre preceder d'un @, on ne peux pas definir de fuseaux horaire

// Modifier une date
$dt->modify('+1 day 16:32'); # Ajoute 1 jour a la date et définie l'heure a 16:32:00.000000
$dt->add('P1M'); # ajoute 1 mois
$dt->sub('P4D'); # soustrait 4 jours

// Calculer la difference entre 2 dates
$diff = $dt2->diff($dt); # calcule la difference entre $dt2 et $dt
echo $diff->format('%y ans, %m mois et %d jours'); # affiche la différence sous un format personnalisé
echo $dt < $dt2; # si l'on souhaite simplement tester une différence supérieur ou inférieur

// Formater une date
echo $dt->format('%y ans, %m mois et %d jours'); # affiche la date sous un format personnalisé
echo $dt->format('c'); # format prédéfinie ex : 2016-02-01T11:41:13+01:00
echo $dt->format('r'); # format prédéfinie ex : Mon, 01 Feb 2016 11:41:13 +0100
echo $dt->format('U'); # format prédéfinie ex : 1454323273

$formater = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
echo $formater->format($dt); # Affichera la date sous un format Francais