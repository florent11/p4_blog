<?php

require_once 'model/model.php';

class Commentaire extends Model {

	// Renvoie la liste des commentaires associés à un billet
	public function getCommentaires($idBillet) {
		$sql = 'select COM_ID as id, DATE_FORMAT(COM_DATE, \'%d/%m/%Y à %Hh%imin%ss\') 
		AS date_fr, COM_AUTEUR as auteur, COM_CONTENU as contenu, COM_SIGNALER as signaler from comments where BIL_ID=? ORDER BY id ASC';
		$commentairest = $this->executerRequete($sql, array($idBillet));
	return $commentairest;
	}