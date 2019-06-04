<?php

abstract class Model {

	// Objet PDO d'accès à la BD
	protected $bdd;
	
	// Execute une requête SQL eventuellement paramatrée
	protected function executerRequete($sql, $params = null) {
		if ($params == null) 
		{
			$resultat = $this->getDb()->query($sql); // execution directe
		} else {
			$resultat = $this->getDb()->prepare($sql); // requête preparée
			$resultat->execute($params);
		}
		return $resultat;
	}
	
	private function getDb()
	{
		if($this->bdd == null) 
		{
			//Creation de la connexion
			$this->bdd = new PDO('mysql:host=localhost;port=8889;dbname=p4_blog;charset=utf8','root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}
    return $this->bdd;
  }
}
