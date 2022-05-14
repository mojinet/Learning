<?php
#------------------------#
#------ Formulaire ------#
#------------------------#

// Variable superglobal
# $_GET[] contiens les données envoyé via l'url en GET
# $_POST[] contiens les données envoyé via formulaire en POST
# $_FILES[] contient les informations sur les fichiers envoyés via POST
# $_REQUEST[] est une combinaison de $_GET[] et $_POST[]
# $_COOKIE[] contiens les cookie
# $_SESSION[]

// Recupération d'une données simple : NON RECOMMENDE : sujet a oublie
$nameInput = htmlspecialchars($_POST['userName']); # Recupere l'input dont le name est 'userName', on sécurise avec htmlspecialchars
$commentaire = nl2br(htmlspecialchars($_POST['commentaire'])); # Recupere un textarea en transformant les retour a la ligne par des <br>
$agree = $_POST['agree']; # Renvois 'on' si coché sinon renvois une erreur : il faut tester avec isset()

// Vérification et récupération des données : RECOMMENDE
// Il est préférable d'utiliser un filtre pour la récupération de données plutot que l'utilisation de super global
$nameInput = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_SPECIAL_CHARS); # Recupere l'input userName envoyé depuis POST et lui applique un filtre qui encode les caractere spéciaux
$userMail = filter_input(INPUT_POST, 'userMail', FILTER_VALIDATE_EMAIL); # Recupere l'input userMail envoyé depuis POST et lui applique un filtre vérifie le mail : si invalide renvois false

// Il existe 2 type de filtre, ceux qui valide les données sans les modifiers et ceux qui peuvent modifier pour que le format attendu sois respecter, la constante contiendra SANITIZE
// Filtre validation
# FILTER_VALIDATE_EMAIL, FILTER_VALIDATE_URL, FILTER_VALIDATE_REGEXP, FILTER_VALIDATE_INT, FILTER_VALIDATE_FLOAT, FILTER_VALIDATE_BOOLEAN, FILTER_VALIDATE_IP, FILTER_VALIDATE_MAC
// Filtre de conversion
# FILTER_SANITIZE_EMAIL, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_SANITIZE_NUMBER_INT, FILTER_SANITIZE_STRING, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_SANITIZE_URL etc..

// Vérifier l'existance d'une variable envoyé
if(filter_has_var(INPUT_POST,'userName')){ // Equivalent a isset()
    # instruction
}

// Recuperation des infos d'un fichier
$fichierName = $_FILES['userFile']['name']; # Nom du fichier
$fichierSize = $_FILES['userFile']['size']; # taille en Octet
$fichierTmp = $_FILES['userFile']['tmp_name']; # chemin temporaire
$fichierType = $_FILES['userFile']['type']; # type
$fichierError = $_FILES['userFile']['error']; # error, si 0 = aucune
echo "$fichierName $fichierSize $fichierTmp $fichierType $fichierError";

$dest = './files/'; # Definie le repertoire final
move_uploaded_file($fichierTmp,$dest); # Deplace le fichier depuis son emplacement temporaire vers le dossier final /!\ bien configurer les droits du dossier, desactivé l'execution des script etc..