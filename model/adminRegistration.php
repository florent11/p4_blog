<?php

require_once 'model.php';

class adminRegistration extends Model 
{ 
    // Insertion dans la base de données des identifiants définis par l'Admin
    public function ajoutIdAdmin($name, $pass) 
    {
        $sql = 'insert into members set id_group = 1, name = :nom, pass = :password';
        $admin = $this->executerRequete($sql, array(":nom"=>$name,":password"=>$pass));   
    }
    
    // Verification si une inscription de l'admin est déjà existante dans la base de données
    public function verifRegistration() 
    {
        $sql = "select count(*) as nb from members";
        $verif = $this->executerRequete($sql);
        return $verif->fetch();
    }
}
