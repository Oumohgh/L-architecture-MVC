<?php
namespace App\Models;
use App\Core\Database;

class User{
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $phone;
    private string $email;
    private string $password;
    private string $role;

    public function __construct(){
        $this->db = Database::Conne();
    }

    public function setFirstName(string $firstName) { 
        $this->firstName = $firstName; 
        }
    public function setLastName(string $lastName){
         $this->lastName = $lastName; 
         }
    public function setPhone(string $phone){ 
        $this->phone = $phone;
         }
    public function setEmail(string $email){ 
        $this->email = $email; 
        }
    public function setPassword(string $password){
         $this->password = $password;
          }
    public function setRole(string $role){ 
        $this->role = $role;
         }

    public function save(){
        $sql = "INSERT INTO users (firstname,lastname,phone,email,password,role)
        VALUES (:firstname,:lastname,:phone,:email,:password,:role)";


        $stmt = $this->Database()->prepare($sql);
        $stmt->execute([
            ":firstname" => $this->firstName,
            ":lastname" => $this->lastName,
            ":phone"  => $this->phone,
            ":email"  => $this->email,
            ":password" => password_hash($this->password, PASSWORD_DEFAULT),
            ":role" => $this->role ?? 'user'
        ]);
    }

    public function geUserByEmail(){
        $sql = "SELECT * FROM users where email = :email";
        $stmt = $this->connec->prepare($sql);

        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, self::class);
        $stmt->execute([
            ':email'=> $this->email
        ]);
        return $stmt->fetch();
    }

    
}