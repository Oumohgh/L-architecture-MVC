<?php
namespace App\core;
use PDO;
use PDOException;
class DataBase{
    private static ?PDO $pdo = NULL;

    public static function Conne(){
        if(self::$pdo == NULL){
            try{
            self::$pdo = new PDO("pgsql:host=localhost;dbname=MVC","root","");
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        return self::$pdo;
    } 
}