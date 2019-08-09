<?php 

require_once 'model.php';

class Billet extends Model 
{
	// Renvoie la liste des billets du blog
	public function getBillets($order = 'desc')
	{
		if ($order == 'desc'){
			$sql = 'SELECT * from posts order by bil_id desc';
		} else {
			$sql = 'SELECT * from posts order by bil_id asc';

		}
		$billets = $this->executerRequete($sql);
		return $billets->fetchAll();
	}
	
	// Renvoie les infos sur un billet
	public function getBillet($idBillet)
	{
		$sql = 'select BIL_ID as id, DATE_FORMAT(BIL_DATE, \'%d/%m/%Y à %H:%i:%s\') as date_fr, BIL_TITRE as titre, BIL_CONTENU as contenu FROM posts where BIL_ID=?';
		$billet = $this->executerRequete($sql, array($idBillet));
		
		if($billet->rowCount() == 1) {
			return $billet->fetch(); // Accès a la première ligne de resultat
		} else {
			throw new Exception("Aucun billet ne correspond à l'identifiant '$idBillet'");
		}
	}
	
}