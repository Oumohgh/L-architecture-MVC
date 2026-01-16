<?php
namespace App\config;

use PDO;
use PDOException;

class DatabaseConnection{
    function establishConnection(){
        try {
            $dsn = new PDO("mysql:host=localhost;dbname=gestion_users;", "root", "");
            $dsn->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo $dsn->errorCode();
        }
        return $dsn;
    }
}