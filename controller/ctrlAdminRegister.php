<?php
require_once 'core/viewClass.php';
require_once 'model/adminRegistration.php';

class ctrlAdminRegister 
{
    public function __construct() 
    {
        $this->registration = new adminRegistration();
    }

   // Afficher formulaire d'inscription pour l'admin du blog
    public function createFormView()
    {
       $donnees=$this->registration->verifRegistration();
        if ($donnees["nb"]!=0){
            $vue = new View("ErrorRegistration");
            $vue->generer();
        }
	    else {
            $vue = new View("Registration");
            $vue->generer();
        }
    }

    // Inscription de l'admin du blog
    public function registration($name, $pass) 
    { 
        $donnees=$this->registration->verifRegistration();
        if ($donnees["nb"]!=0){
           $vue = new View("ErrorRegistration");
           $vue->generer();
        }
        else {
            $pass=password_hash($pass, PASSWORD_ARGON2I);
            $this->registration->ajoutIdAdmin($name, $pass);
            $vue = new View("ConfirmRegistration");
            $vue->generer();
        }
    }   
}
