<?php

require_once 'model.php';

class Commentaire extends Model 
{
	// Renvoie la liste des commentaires associés à un billet
	public function getCommentaires($idBillet) 
	{
		$sql = 'select COM_ID as id, DATE_FORMAT(COM_DATE, \'%d/%m/%Y à %Hh%imin%ss\') 
		AS date_fr, COM_AUTEUR as auteur, COM_CONTENU as contenu, COM_SIGNALER as signaler from comments where BIL_ID=? ORDER BY id ASC';
		$commentairest = $this->executerRequete($sql, array($idBillet));
		return $commentairest;
    }

	public function countComments($idBillet) 
	{
		$sql = "select count(*) as nbcomments from comments where BIL_ID=?";
		$commentNumber = $this->executerRequete($sql, array($idBillet));
		return $commentNumber->fetch();
	}
  
	// Ajouter un commentaire dans la base
	public function ajouterCommentaire($auteur, $contenu, $idBillet) 
	{
		$sql = 'insert into comments(COM_DATE, COM_AUTEUR, COM_CONTENU, BIL_ID) values(NOW(), ?, ?, ?)';
		$this->executerRequete($sql, array($auteur, $contenu, $idBillet));
	}
	
	// Signaler commentaire
	public function signalerCommentaire($idCommentaire) 
	{
		$sql = 'UPDATE comments SET COM_SIGNALER = 1 WHERE COM_ID = ?';
		$this->executerRequete($sql, array($idCommentaire));
	}
}