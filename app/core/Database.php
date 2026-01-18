<?php
namespace App\core;
use PDO;
use PDOException;
class Database{
 private static ?PDO $pdo=null;

 public static function getInstance():PDO{
    if(self::$pdo===null){
        try {
            self::$pdo= new PDO ("mysql:host=localhost;dbname=MVC;charset=utf8",
            "root",
            "",
            [
                PDO::ATTR_ERRMODE -> PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE=> PDO::FETCH
            ]  ]
                );
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }

        return self::$pdo;
    }
}


  