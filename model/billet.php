<?php 

require_once 'model.php';

class Billet extends Model 
{
	// Renvoie la liste des billets du blog
	public function getBillets($order = 'desc')
	{
		if ($order == 'desc'){
			$sql = 'select bil_id, date_format(bil_date, \'%d/%m/%Y à %H:%i:%s\') as date_fr, bil_titre, bil_contenu from posts order by bil_id desc';
		} 
		else {
			$sql = 'select bil_id, date_format(bil_date, \'%d/%m/%Y à %H:%i:%s\') as date_fr, bil_titre, bil_contenu from posts order by bil_id asc';
		}
		$billets = $this->executerRequete($sql);
		return $billets->fetchAll();
	}
	
	// Renvoie les infos sur un billet
	public function getBillet($idBillet)
	{
		$sql = 'select bil_id as id, date_format(bil_date, \'%d/%m/%Y à %H:%i:%s\') as date_fr, bil_titre as titre, bil_contenu as contenu from posts where bil_id = ?';
		$billet = $this->executerRequete($sql, array($idBillet));
		
		if($billet->rowCount() == 1) {
			return $billet->fetch(); // Accès à la première ligne de resultat
		} 
		else {
			throw new Exception("Aucun billet ne correspond à l'identifiant '$idBillet'");
		}
	}	
}