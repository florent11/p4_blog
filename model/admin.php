<?php

require_once "model.php";

Class Admin extends Model 

{

	// Recuperation infos compte
	public function getAccountInfo($username)
	{
		$sql = "SELECT * FROM members WHERE name = ?";
		$admin = $this->executerRequete($sql, array($username));
		return $admin->fetch();
	}
	
	// Liste commentaires signalés
	public function getSignCom()
	{
		$sql = 'SELECT com_id as com_id, DATE_FORMAT(com_date, \'%d/%m/%Y à %Hh%imin%ss\') as date_fr, com_auteur as author, com_contenu as content 
		FROM `comments` WHERE COM_SIGNALER = 1';
		$signCom = $this->executerRequete($sql);
		return $signCom;
	}
	
	// Liste commentaires moderés
	public function getModCom()
	{
		$sql = "SELECT * FROM `comments` WHERE COM_SIGNALER = 0 AND COM_MODERE = 1";
		$modCom = $this->executerRequete($sql);
		return $modCom->fetchAll();
    }
    
	// Liste historique moderation 
	public function getLogs()
	{
		$sql = 'SELECT log_id as log_id, com_id as id, DATE_FORMAT(com_date, \'%d/%m/%Y à %Hh%imin%ss\') 
		AS date_fr, com_author AS author, com_content AS content, post_id AS post_id, mod_type as mod_type, DATE_FORMAT(log_date, \'%d/%m/%Y à %Hh%imin%ss\') AS log_date_fr FROM logs ORDER BY log_id DESC';
		$logs = $this->executerRequete($sql);
		return $logs->fetchAll();
	}
	
	// Liste historique commentaires Supprimés
	public function getLogsBetterDel()
	{
		$sql = 'SELECT log_id as log_id, com_id as id, DATE_FORMAT(com_date, \'%d/%m/%Y à %Hh%imin%ss\') 
		AS post_date_fr, com_author AS author, com_content AS oldcontent, post_id AS post_id, mod_type as mod_type, DATE_FORMAT(log_date, \'%d/%m/%Y à %Hh%imin%ss\') AS mod_date_fr 
		FROM logs WHERE mod_type = "deleted" ORDER BY log_id DESC';
		$logs = $this->executerRequete($sql);
		return $logs->fetchAll();
	}
	
	// Nombre commentaire à moderer
	public function countSignCom()
	{
		$sql = "select count(*) as nbsigncoms from comments where COM_SIGNALER = 1";
		$commentSignNumber = $this->executerRequete($sql);
	return $commentSignNumber->fetch();
	}
	
	// Modérer commentaire signalés
	public function modSignCom($contenus, $idCommentaire)
	{
		$sql = 'UPDATE comments SET COM_SIGNALER = 0, COM_MODERE = 1, COM_CONTENU = ? WHERE COM_ID = ?';
		$this->executerRequete($sql, array($contenus, $idCommentaire));
	}

	// Supprimer commentaire signalé 
	public function suppressCom($idCommentaire){
		$sql = "DELETE FROM comments WHERE COM_ID = ?";
		$this->executerRequete($sql, array($idCommentaire));
	}
	
	// Insertion logs moderation
	public function insertLogs($idCommentaire){
		$sql ="INSERT INTO logs(com_id, com_date, com_author, com_content, post_id) 
				SELECT com_id, com_date, com_auteur, com_contenu, bil_id FROM comments WHERE com_id = ?";
		$this->executerRequete($sql, array($idCommentaire));
	}
	
	// Insertion type "Supprimé" log Modération
	public function insertLogsSupp($idCommentaire){
		$sql ="UPDATE logs SET mod_type = 'deleted' WHERE com_id = ?";
		$this->executerRequete($sql, array($idCommentaire));
	}
	
	// Creation Billet
	public function create($titre, $content)
	{
		$sql = "INSERT INTO posts(BIL_DATE, BIL_TITRE, BIL_CONTENU) VALUES(NOW(), ?, ?)";
		$this->executerRequete($sql, array($titre, $content));
	}
	
	// Suppression Billet
	public function suppress($idBillet)
	{
		$sql = 'DELETE FROM posts WHERE bil_id = ?';
		$this->executerRequete($sql, array($idBillet));
	}
	
	// Modification Billet
	public function update($idBillet, $titreBillet, $contenuBillet)
	{
		$sql = "UPDATE posts SET bil_titre = ?, bil_contenu = ? WHERE bil_id = ?";
		$this->executerRequete($sql, array($titreBillet, $contenuBillet, $idBillet));
	}

}

