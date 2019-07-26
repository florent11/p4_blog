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
		$vue = new View("Registration");
		$vue->generer();
    }

    public function registration($name, $pass) { 
        $pass=password_hash($pass, PASSWORD_ARGON2I);
        $this->registration->ajoutIdAdmin($name, $pass);
    }

    public function errors_proccessing(){
        // Création d'un tableau des erreurs
	    $errors_registration = array();

	    // Validation des champs suivant les règles en utilisant les données du tableau $_POST
	    if ($form_registration->is_valid($_POST)) {

	        // Si d'autres erreurs ne sont pas survenues
	        if (empty($errors_registration)) {

	            // Tentative d'ajout du membre dans la base de donnees
                list($name, $pass) =
                $form_registration->get_cleaned_data('nom', 'password');

                $id_admin = insert($name, $pass);

             }     else {

                // Changement de nom de variable (plus lisible)
                $error =& $id_admin;
                
                // On vérifie que l'erreur concerne bien un doublon
                if (23000 == $error[0]) { // Le code d'erreur 23000 siginife "doublon" dans le standard ANSI SQL
                
                    preg_match("`Duplicate entry '(.+)' for key \d+`is", $erreur[2], $valeur_probleme);
                    $valeur_probleme = $valeur_probleme[1];
		
	        	} else {
		
			        $errors_registration[] = "Erreur ajout SQL : doublon non identifié présent dans la base de données.";
		        }
        
             } 
        } 
    } 

}

