<?php

require_once 'model.php';

class Commentaire extends Model 
{
	// Renvoie la liste des commentaires associés à un billet
	public function getCommentaires($idBillet) 
	{
		$sql = 'select com_id as id, date_format(com_date, \'%d/%m/%Y à %Hh%imin%ss\') 
		as date_fr, com_auteur as auteur, com_contenu as contenu, com_signaler as signaler, com_modere from comments where com_a_valider = 1 and bil_id = ? order by id asc';
		$commentairest = $this->executerRequete($sql, array($idBillet));
		return $commentairest;
    }

	//Affiche le nombre de commentaires associés au billet
	public function countComments($idBillet) 
	{
		$sql = 'select count(*) as nbcomments from comments where bil_id = ?';
		$commentNumber = $this->executerRequete($sql, array($idBillet));
		return $commentNumber->fetch();
	}
  
	// Ajouter un commentaire dans la base
	public function ajouterCommentaire($auteur, $contenu, $idBillet) 
	{
		$sql = 'insert into comments(com_date, com_auteur, com_contenu, bil_id) values(now(), ?, ?, ?)';
		$this->executerRequete($sql, array($auteur, $contenu, $idBillet));
	}
	
	// Signaler commentaire
	public function signalerCommentaire($idCommentaire) 
	{
		$sql = 'update comments set com_signaler = 1 where com_id = ?';
		$this->executerRequete($sql, array($idCommentaire));
	}
}

