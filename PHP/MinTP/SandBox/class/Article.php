<?php

class Article{

    const SQL_ADD_ARTICLE = 'INSERT INTO article (title,content,id_author) VALUES(:title,:content,:id_author)';
    const SQL_GET_ARTICLES = 'SELECT * FROM article';

    public static function addArticle($title, $content){
        $db = null;
        $authorId = User::getID($_SESSION['name']);
        try{
            $db = new Connect();
            $res = $db->query(Article::SQL_ADD_ARTICLE, ['title'=>$title, 'content'=>$content, 'id_author' => $authorId]);
            if(count($res) !== 0){
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e){
            echo 'erreur : ' . $e->getMessage();
        } finally {
            unset($db);
        }
    }

    public static function getArticles(){
        $db = null;
        try{
            $db = new Connect();
            $res = $db->query(Article::SQL_GET_ARTICLES);
            if(count($res) !== 0){
                return $res;
            }else{
                return false;
            }
        }catch (PDOException $e){
            echo 'erreur : ' . $e->getMessage();
        } finally {
            unset($db);
        }
    }
}