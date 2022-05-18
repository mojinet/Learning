<?php

class User{
    private $name;
    private $password;
    private $role;
    private const SQL_GET_USER = 'SELECT * FROM user WHERE name=:name AND password=:password';
    private const SQL_GET_USER_ID = 'SELECT * FROM user WHERE name=:name';
    private const SQL_GET_USER_NAME = 'SELECT * FROM user WHERE id=:id';
    private const SQL_ADD_USER = 'INSERT INTO user(name,password,role) VALUES(:name,:password,:role)';

    public function __construct(string $name, string $password, string $role){
        $this->password = $password;
        $this->name = $name;
        $this->role = $role;
    }

    public static function checkAcount($name, $password){
        $db = null;
        try{
            $db = new Connect();
            $res = $db->query(User::SQL_GET_USER, ['name'=>$name, 'password'=>$password]);
            if(count($res) !== 0){
                $_SESSION['connected'] = true;
                $_SESSION['name'] = $name;
                $role = json_decode(json_encode($res,true),true)[0]['role'];
                $_SESSION['role'] = $role;
                return true;
            }else{
                $_SESSION['connected'] = false;
                return false;
            }
        }catch (PDOException $e){
            echo 'erreur : ' . $e->getMessage();
        } finally {
            unset($db);
        }
    }

    public static function Inscription($name, $password, $password2, $role = 'user'){
        $db = null;
        if($password === $password2 && strlen($name) <= 30 && strlen($password) <= 30){
            try{
                $db = new Connect();
                $res = $db->query(User::SQL_ADD_USER, ['name'=>$name, 'password'=>$password, 'role'=>$role]);
                if(count($res) !== 0){
                    $_SESSION['connected'] = true;
                    $_SESSION['name'] = $name;
                    $_SESSION['role'] = $role;
                    return true;
                }else{
                    $_SESSION['connected'] = false;
                    return false;
                }
            }catch (PDOException $e){
                echo 'erreur : ' . $e->getMessage();
            } finally {
                unset($db);
            }
        }else{
            return false;
        }
    }

    public static function getID($name){
        $db = null;
        try{
            $db = new Connect();
            $res = $db->query(User::SQL_GET_USER_ID, ['name'=>$name]);
            if(count($res) !== 0){
                return $res[0]['id'];
            }else{
                return false;
            }
        }catch (PDOException $e){
            echo 'erreur : ' . $e->getMessage();
        } finally {
            unset($db);
        }
    }

    public static function getUserName($id){
        $db = null;
        try{
            $db = new Connect();
            $res = $db->query(User::SQL_GET_USER_NAME, ['id'=>$id]);
            if(count($res) !== 0){
                return $res[0]['name'];
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