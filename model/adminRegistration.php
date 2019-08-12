<?php

require_once "model.php";

class adminRegistration extends Model { 
    
    //Insertion dans la base de données des identifiants définis par l'Admin
    public function ajoutIdAdmin($name, $pass) {
        $sql = "INSERT INTO members SET id_group=1, name = :nom, pass = :password";
        $admin = $this->executerRequete($sql, array(":nom"=>$name,":password"=>$pass));   
    }

    public function verifRegistration() {
        $sql = "SELECT COUNT(*) AS nb FROM members";
        $verif = $this->executerRequete($sql);
        return $verif->fetch();
    }

}
