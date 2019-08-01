<?php
ini_set('display_errors', 'on');
require_once 'view/viewClass.php';
require_once 'model/adminRegistration.php';

class ctrlAdminRegister {

    public function __construct() {
        $this->registration = new adminRegistration();
    }

   // Afficher formulaire d'inscription pour l'admin du blog
	public function createFormView(){
        $donnees=$this->registration->verifRegistration();
        if ($donnees["nb"]!=0) {
            echo "Vos identifiants sont déjà inscrits dans la base de donnée. Connectez-vous à votre espace d'administration";
        }

	    else { 
            $vue = new View("Registration");
            $vue->generer();
        }
    }

    // Inscription de l'admin du blog
    public function registration($name, $pass) { 
        $donnees=$this->registration->verifRegistration();
        if ($donnees["nb"]!=0) {
            echo "Vos identifiants sont déjà inscrits dans la base de donnée. Connectez-vous à votre espace d'administration";
        }
        else {
        $pass=password_hash($pass, PASSWORD_ARGON2I);
        $this->registration->ajoutIdAdmin($name, $pass);
        echo "Vous êtes inscrit. Vous pouvez désormais vous connecter à votre espace d'administration.";
        }
    }   
}
