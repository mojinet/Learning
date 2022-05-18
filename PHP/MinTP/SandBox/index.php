<?php
// On charge le routeur
require 'router.php';

// On charge l'autoloader pour le dossier vendor
require __DIR__ . '/vendor/autoload.php';

// AutoLoader des classes
function loadItem(string $className){
    require 'class/' . $className . '.php';
}
spl_autoload_register('loadItem');

// On charge les variables d'environements
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// On démarre la session si elle ne l'est pas déjà
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

// Récupère l'adresse demandée par l'utilisateur
$uri = $_SERVER['REQUEST_URI'];

// On charge la génération du contenu principal via le routeur
$router = new Router($uri);
$router->render();