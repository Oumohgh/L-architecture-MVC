<?php


namespace App\Controllers;
use App\Core\Controller;

use App\Models\User;

class AuthController extends Controller {

    public function register(){
     
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $user = new User();

        $user->setFirstName($_POST['firstname']);
        $user->setLastName($_POST['lastname']);
        $user->setPhone($_POST['phone']);
        $user->setEmail($_POST['phone']);
        $user->setPassword($_POST['password']);
        $user->setRole($_POST['role']);
        

        try {
            $user->save();
            $this->view('auth/connexion');
            // header('location: /auth/connexion');
            exit;
        }catch(PDOException $e){
            $erreur = "Erreur lorsuqe l'inscription : ". $e->getMessage();
            $this->view('auth/inscription', ['erreur' => $erreur]);
            return;
        }
    }

     $this->view('auth/register');
    }


    public function login(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $email = $_POST['email'];
            $password = $_POST['password'];

            if(empty($email) || empty($passowrd)){
                $this->view('auth/connexion', [
                    'erreur' => 'les champs oblegatoire a remplie'
                ]);
                return;
            }

            $userAuth = new User();
            $userAuth->setEmail($email);

            $user = $userAuth->geUserByEmail();
            if(!$user){
                $this->view('auth/connexion', ['erreur'=>'acune utilisateur pour ce email']); 
                return;
            }

            if(!verify_password($password, $user->password)){
                $this->view('auth/connexion', ['erreur' => 'password ou email incorrect']);
                return;
            };

            session_start();
            $_SESSION['id'] = $user->id;
            
            $this->view('home/user', ['user'=>$user]);
        }

    

    }

   
}