<?php
# ------------------------- #
# -------- Erreur --------- #
# ------------------------- #

#Type d'erreur
# E_PARSE : erreur de syntaxe pour la plupart des cas
# E_ERROR : erreur critique
# E_WARNING : erreur suite comportement anormal, ne met pas fin a l'execution
# E_NOTICE : faible importance, par exemple utilisation d'une variable non initialisé
# E_DEPRECATED : eviter d'utiliser car probablement non compatible futur version
# E_CORE_XXX et E_CORE_WARNING_XXX : erreur interne de PHP : ce n'est pas de "notre" faute mais du coeur PHP
# E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE et E_USER_DEPRECATED : erreur personnalisé

// lever une erreur
trigger_error('ceci est une erreur', E_USER_NOTICE); # Leve une erreur de type notice

// inscrire une ligne dans le journal d'erreur
error_log('ceci est un message pour le journal d\'erreur');
error_log('ceci est un message pour le journal d\'erreur',1,'jeanbaptiste.cochinard@gmail.com'); # envois un mail avec l'erreur
error_log('ceci est un message pour le journal d\'erreur',3,'errorLog.txt'); # inscrit une nouvelle ligne d'erreur dans le fichier spécifier

# ------------------------- #
# ------ Exception -------- #
# ------------------------- #

// créer une classe qui hérite d'exepction
class myExcep extends Exception{
    private $champsPerso;

    public function __construct($message, $champsPerso)
    {
        $this->champsPerso = $champsPerso;
        parent::__construct($message);
    }
}

// lever une exception
# $excep = new myExcep('wolala', 'ca va pas la'); # instancie l'exeption
# throw $excep; # leve l'exeption

//try catch
try{
    if (false){
        $excep = new myExcep('wolala', 'ca va pas la'); # instancie l'exeption
        throw $excep; # saute directement au bloc catch
    }
}catch (Exception $e){
    $e->getMessage();
}