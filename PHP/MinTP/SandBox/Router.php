<?php
class Router{
    private $uri;

    public function __construct($uri){
        $this->uri = $uri;
    }

    public function render(){
        switch ($this->uri){
            case '/' :
                $articles = Article::getArticles();
                $pageTitle = "Accueil";
                require_once 'page/accueil.php';
                break;

            case '/contact' :
                require_once 'page/contact.php';
                $pageTitle = "Contact";
                break;

            case '/compte' :
                require_once 'page/compte.php';
                $pageTitle = "Mon Compte";
                break;

            case '/ajoutArticle' :
                if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'){
                    require_once 'page/ajoutArticle.php';
                    $pageTitle = "Ajouter un article";
                }else{
                    require_once 'page/accueil.php';
                    $pageTitle = "Accueil";
                }
                break;

            case '/post_ajout_article' :
                $title = filter_input(INPUT_POST,'title', FILTER_SANITIZE_SPECIAL_CHARS);
                $content = filter_input(INPUT_POST,'content', FILTER_SANITIZE_SPECIAL_CHARS);
                Article::addArticle($title,$content);
                header('Location: /');
                break;

            case '/connection' :
                require_once 'page/connection.php';
                $pageTitle = "Connexion";
                break;

            case '/deconnection' :
                unset($_SESSION['connected']);
                unset($_SESSION['role']);
                unset($_SESSION['name']);
                break;

            case '/post_connection' :
                $name = filter_input(INPUT_POST,'name', FILTER_SANITIZE_SPECIAL_CHARS);
                $password = filter_input(INPUT_POST,'password', FILTER_SANITIZE_SPECIAL_CHARS);
                if(User::checkAcount($name,$password)){
                    header('Location: /');
                }else{
                    $error = 'Il y as eu une erreur';
                    require_once 'page/connection.php';
                }
                break;

            case '/inscription' :
                require_once 'page/inscription.php';
                $pageTitle = "Inscription";
                break;

            case '/post_inscription' :
                $name = filter_input(INPUT_POST,'name', FILTER_SANITIZE_SPECIAL_CHARS);
                $password = filter_input(INPUT_POST,'password', FILTER_SANITIZE_SPECIAL_CHARS);
                $password2 = filter_input(INPUT_POST,'password2', FILTER_SANITIZE_SPECIAL_CHARS);
                if(User::Inscription($name,$password,$password2)){
                    header('Location: /');
                }else{
                    $error = 'Il y as eu une erreur';
                    require_once 'page/inscription.php';
                }
                break;

            default :
                require_once 'page/404.php';
                $pageTitle = "Erreur 404";
        }
        require_once 'template/layout.php';
    }
}