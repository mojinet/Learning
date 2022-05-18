<?php
class Connect{
    private $dbName;
    private $dbUser;
    private $dbPassword;
    private $db;

    // On charge nos variables d'environment définie dans le .env
    public function __construct(){
        $this->dbName = $_ENV['DB_NAME'];
        $this->dbUser = $_ENV['DB_USER'];
        $this->dbPassword = $_ENV['DB_PASSWORD'];
        $this->getConexion();
    }

    public function __destruct(){
        $this->db = NULL;
    }

    // Se connecte à la base de données
    private function getConexion(){
        try {
            $bdd = new PDO(
                'mysql:host=localhost;dbname='.$this->dbName.';charset=utf8',
                $this->dbUser,
                $this->dbPassword
            );
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->db = $bdd;
        }
        catch (PDOException $e) {
            $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
            die($msg);
        }
    }

    // fonction de selection
    public function query(string $sql, array $args = NULL){
        try{
            $stmt = $this->db->prepare($sql);
            $stmt->execute($args);
            return $stmt->fetchAll();
        }catch (PDOException $e){
            echo "erreur : ", $e->getMessage();
        }
    }
}