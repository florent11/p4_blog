<?php

require_once "model.php";

class adminRegistration extends Model { 
    //Insertion des identifiants définis par l'Admin
    public function ajoutIdAdmin($name, $pass) {
        $sql = "INSERT INTO members SET id_group=1, name = :nom, pass = :password";
        $admin= $this->executerRequete($sql, array(":nom"=>$name,":password"=>$pass));   
    }
}


